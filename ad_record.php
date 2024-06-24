<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crimeleon2";

// Establish database connection using PDO
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set the number of items per page
    $itemsPerPage = 15;

    // Get the current page number from the URL, defaulting to page 1 if not set
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Calculate the offset for the query
    $offset = ($page - 1) * $itemsPerPage;

    // Fetching the filter values
    $name_search = isset($_GET['name_search']) ? $_GET['name_search'] : '';
    $type_of_incident = isset($_GET['type_of_incident']) ? $_GET['type_of_incident'] : '';
    $location = isset($_GET['location']) ? $_GET['location'] : '';
    $date_reported = isset($_GET['date_reported']) ? $_GET['date_reported'] : '';
    $date_of_incident = isset($_GET['date_of_incident']) ? $_GET['date_of_incident'] : '';
    $status_filter = isset($_GET['status']) ? $_GET['status'] : '';



    // Start with the base SQL query
    $sql = "SELECT 
                r.repID, 
                r.type_of_incident, 
                r.place_of_incident,
                r.datetime_reported,
                r.datetime_of_incident,
                r.status,
                pd_r.family_name AS reporter_family_name, 
                pd_r.first_name AS reporter_first_name,
                pd_s.family_name AS suspect_family_name, 
                pd_s.first_name AS suspect_first_name,
                pd_v.family_name AS victim_family_name, 
                pd_v.first_name AS victim_first_name
            FROM report r
            LEFT JOIN item_a a ON r.repID = a.repID
            LEFT JOIN persons_data pd_r ON a.personID = pd_r.personID
            LEFT JOIN item_b b ON r.repID = b.repID
            LEFT JOIN persons_data pd_s ON b.personID = pd_s.personID
            LEFT JOIN item_c c ON r.repID = c.repID
            LEFT JOIN persons_data pd_v ON c.personID = pd_v.personID
            ";

    // Build the conditions array and params array dynamically based on the filters provided
    $conditions = [];
    $params = [];

    if (!empty($name_search)) {
        $name_condition = "(
            pd_r.family_name LIKE :name_search OR 
            pd_r.first_name LIKE :name_search OR
            pd_s.family_name LIKE :name_search OR 
            pd_s.first_name LIKE :name_search OR
            pd_v.family_name LIKE :name_search OR 
            pd_v.first_name LIKE :name_search
        )";
        $conditions[] = $name_condition;
        $params[':name_search'] = "%$name_search%";
    }
    
    if (!empty($type_of_incident)) {
        $conditions[] = "r.type_of_incident = :type_of_incident";
        $params[':type_of_incident'] = $type_of_incident;
    }

    if (!empty($location)) {
        $conditions[] = "r.place_of_incident = :location";
        $params[':location'] = $location;
    }

    if (!empty($date_reported)) {
        $conditions[] = "DATE(r.datetime_reported) = :date_reported";
        $params[':date_reported'] = $date_reported;
    }

    if (!empty($date_of_incident)) {
        $conditions[] = "DATE(r.datetime_of_incident) = :date_of_incident";
        $params[':date_of_incident'] = $date_of_incident;
    }

    if (!empty($status_filter)) {
        $conditions[] = "r.status = :status_filter";
        $params[':status_filter'] = $status_filter;
    }

    if ($conditions) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $sql .= " LIMIT $itemsPerPage OFFSET $offset";

    // Prepare and execute the SQL query
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calculate total number of reports for pagination
    $totalReportsQuery = "SELECT COUNT(*) AS total FROM report r
    LEFT JOIN item_a a ON r.repID = a.repID
    LEFT JOIN persons_data pd_r ON a.personID = pd_r.personID
    LEFT JOIN item_b b ON r.repID = b.repID
    LEFT JOIN persons_data pd_s ON b.personID = pd_s.personID
    LEFT JOIN item_c c ON r.repID = c.repID
    LEFT JOIN persons_data pd_v ON c.personID = pd_v.personID";
    
    if ($conditions) {
        $totalReportsQuery .= " WHERE " . implode(" AND ", $conditions);
    }
    
    $totalStmt = $pdo->prepare($totalReportsQuery);
    $totalStmt->execute($params);
    $totalReports = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalReports / $itemsPerPage);
    
    
    $queryParams = array_filter([
        'name_search' => $name_search,
        'type_of_incident' => $type_of_incident,
        'location' => $location,
        'date_reported' => $date_reported,
        'date_of_incident' => $date_of_incident,
        'status' => $status_filter, // Make sure this matches the name attribute of your status select field
    ]);
    
    $queryString = http_build_query($queryParams);

} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Record Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>

/* Basic Reset */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* Modal Content Styling */
.modal-content-report {
    background-color: #FFF;
    margin: 0% auto; /* Adjusted for better positioning */
    padding: 0px;
    border: 1px solid #000;
    width: 90%; /* Adjust width as needed */
    font-family: Arial, sans-serif;
    position: relative; /* For absolute positioning of the close button */
}

/* Close button style */
.close {
    position: absolute;
    right: 10px;
    top: 10px;
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

/* Modal sections styling */
.modal-section {
    border: 1px solid black;
    display: flex;
    justify-content: space-between; /* This will spread out the child elements */
    margin-bottom: -1px; /* Overlap borders */
}

/* Header style */
.modal-section-header {
font-family: 'Lovelo', sans-serif;
font-size: 30px;
text-align: center;
width: 100%; /* Full width */
padding: 10px;
background-color: #bfbfbf; /* Light grey background */
border-bottom: 1px solid black;
font-weight: bold; /* Make the text bold */
}


/* Field style */
.field-row {
    flex-grow: 1; /* Fields take up equal space */
    display: flex;
    flex-direction: column; /* Stack fields vertically */
    margin: -1px 0 0 -1px; /* Overlap borders */
    border: 1px solid black;
}

.field-label {
    font-weight: 650;
    font-size: 11px;
    padding: 5px;
}
.field-value {
    padding: 4px;
}

.field-label {
    background-color: #f2f2f2; /* Light grey background */
    border-bottom: 1px solid black; /* Separation line */
}

/* Ensure the print button is visible and positioned */
#printButton {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    background-color: #e7e7e7; /* Light grey */
    border: none;
    border-radius: 5px;
}

/* Removing extra margin-bottom from the last field-row */
.field-row:last-child {
    margin-bottom: 0;
}

/* Add more styling rules as needed */
</style>

<!-- SEARCH -->
<style>
.open-modal {
    font-family: 'Lovelo', sans-serif;
    padding: 8px 15px; /* Padding inside the button */
    background-color: #A4b7e4; /* Blue background */
    color: white; /* White text */
    border: none; /* No border */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 0.9em; /* Font size */
    text-align: center; /* Center text */
    text-decoration: none; /* No underline */
    display: inline-block; /* Allows for setting dimensions */
    transition: background-color 0.3s ease; /* Smooth background color transition on hover */
}

.open-modal:hover {
    background-color: #2874a6; /* Darker blue on hover */
}

.open-modal:focus {
    outline: none; /* Removes the default outline shown on focus */
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.5); /* Adds a light blue shadow for accessibility */
}

/* Styles for the form */
form {
    background-color: #0a2242; /* Dark background */
    color: white; /* White text */
    display: flex; /* Use flexbox for layout */
    flex-wrap: wrap; /* Allow elements to wrap */
    justify-content: center; /* Center elements */
    align-items: center; /* Align items vertically */
    padding: 0.5rem 0; /* Padding at the top and bottom */
}
/* Styles for each form field container */
.form-field {
    display: flex; /* Use flexbox for layout */
    flex-direction: column; /* Stack elements vertically */
    margin: 0 10px; /* Space to the right of each container */
    align-items: center; /* Center alignment for fields */
}


/* Style for the form field containers as a row */
.form-row {
    display: flex; /* Use flexbox for layout */
    justify-content: start; /* Align elements to the start of the container */
    flex-wrap: wrap; /* Allow elements to wrap to next line on small screens */
}

/* Style for the labels */
label {
    display: block; /* Labels take the full width */
    text-align: center; /* Center align text */
    margin-bottom: 5px; /* Space between label and input */
}

/* Styles for input fields and selects */
input[type=text],
input[type=date],
select {
    padding: 0.5rem;
    border: 1px solid #aaa; /* Light grey border */
    border-radius: 0; /* Square borders */
    background: white; /* White background for input and select */
    color: black; /* Black text for input and select */
}


/* Styles for the submit button */
input[type=submit] {
    font-family: 'Lovelo', sans-serif;
    padding: 0.5rem 1rem; /* Reduced vertical padding to make button shorter */
    background-color: #A4b7e4; /* Custom blue background */
    border: none;
    color: white;
    cursor: pointer;
    height: 40%;
    width: auto; /* Width as per content */
    margin: 26px 4px; /* Space to the right of the button */
}

input[type=submit]:hover {
    background-color: #2874a6; /* Darker blue on hover */
}
/* Media query for responsive layout */
@media (max-width: 768px) {
    .form-field {
        margin: 0 0 10px 0; /* Remove right margin and add bottom margin on small screens */
        width: 100%; /* Full width for smaller screens */
    }

    input[type=submit] {
        width: calc(100% - 20px); /* Full width for the submit button on small screens */
        margin-top: 0.1rem; /* Space above the button */
    }

    label {
        text-align: center; /* Center align labels */
        width: auto; /* Auto width for labels */
    }
}
</style>

<!-- PAGINATION -->
<style>
.pagination {
  display: flex;
  justify-content: center; /* Centers the pagination horizontally */
  margin-top: 10px; /* Adjust as needed for space below the table */
}

.pagination a {
  border: 1px solid #ddd;
  padding: 5px 10px;
  text-decoration: none;
  color: #333;
  background-color: #bbc8e6; /* Change as needed */
  margin: 0 4px;
  transition: background-color 0.3s;
}

.pagination a.active, .pagination a:hover {
  background-color: #2a7aaf;
  color: white;
  border-color: #2a7aaf; /* Ensures the border color matches the background */
}

.pagination a.active {
  font-weight: bold;
  border-radius: 50%;
}

.pagination a.prev, .pagination a.next {
  font-weight: bold;
}
</style>

<style>
@import url('https://fonts.cdnfonts.com/css/lovelo?styles=25962');

.modal {
display: none;
position: fixed;
z-index: 1;
left: 0;
top: 0;
width: 100%;
height: 100%;
overflow: auto;
background-color: rgb(0,0,0);
background-color: rgba(0,0,0,0.4);
}

.modal-content {
background-color: #fefefe;
margin: 15% auto;
padding: 20px;
border: 1px solid #888;
width: 80%;
}

.close {
color: #aaa;
float: right;
font-size: 28px;
font-weight: bold;
}

.close:hover,
.close:focus {
color: black;
text-decoration: none;
cursor: pointer;
}


table {
width: 100%;
border-collapse: collapse;
margin-top: 20px;
}

table, th, td {
border: 2px solid #8392B8;
}

th, td {
text-align: left;
padding: 8px;
color: white;
}

th {
background-color: #647494;
color: white;
}

tr:nth-child(even) {
background-color: #3b4e68;
}

tr:hover {
background-color: #8392B8;
}

/* Style the no results message */
.no-results {
text-align: center;
padding: 20px;
background-color: #f9f9f9;
border: 1px solid #ddd;
border-radius: 4px;
margin-top: 20px;
}




    body {
        font-family: 'Lovelo', sans-serif;
        background-color: #0a2242;
        margin: 0;
        padding: 0;
    }

    .header {
    background-color: #bbc8e6;
    padding: 20px 0;
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
    }

    .header img {
        margin-left: 15px;
        max-height: 80px;
    }

    .brand-text {
        margin-left: 10px;
        font-size: 50px;
        color: #0a2242;
        vertical-align: middle;
    }

    .header a,
    .dropdown img {
        color: #0a2242;
        text-decoration: none;
        margin: 0 15px;
        font-weight: bold;
        font-size: 25px;
        transition: color 0.3s;
        vertical-align: middle;
    }

    .header-links {
margin-left: auto;
color: #FFFFFF; /* White text color for navigation links */
padding: 10px 20px; /* Spacing around the link text, adjust as needed */
display: inline-block; /* Allows the application of padding and margins */
text-decoration: none; /* Remove any underline from links */
transition: background-color 0.3s; /
}

/* Styles to apply when a tab is active */
.header-links a.active {
color: #0e2547; /* Blue color for the active link text */
background-color: #748199; /* Blue background with low opacity */
opacity: 90%;
padding: 10px 15px; 
border-radius: 30px; /* Rounded corners for the background, adjust as needed */
}

.header a:hover {
color: #3274bc; /* Blue color for hover effect, can be adjusted */
}

.user-name {
font-family: 'Lovelo', sans-serif; /* or 'Grandiflora One', if preferred */
color: #FFFFFF; /* Assuming the text is white based on the image */
background-color: #0a2242; /* Match the background color of the element */
margin-right: -5px; /* Adjust margin as needed */
font-weight: bold;
font-size: 20px;
padding: 10px 20px 10px 20px; /* Adjust padding to match the image */
border-radius: 20px; /* Adjust the border-radius to match the image */
display: inline-flex; /* Use flex to align text and icon */
align-items: center; /* Center the text and icon vertically */
vertical-align: middle;
box-shadow: 0 2px 5px rgba(0,0,0,0.2); /* Optional shadow for depth */
position: relative; /* Position relative to allow absolute positioning of the icon */
}

    #searchBarContainer {
        margin: 100px;
    }

    #searchInput {
        width: 100%;
        padding: 20px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 10px;
    }



    .details {
        display: none;
        padding: 10px;
        background-color: #f9f9f9;
        border-top: 1px solid #eee;
    }


.image-section {
    background-image: url('cbg.png');
    background-size: cover;
    background-position: center;
    position: relative;
    height: 450px; /* You can adjust this according to your image's height or your preference */
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-section::before {
content: "";
background-image: url('logo2.png');
opacity: 0.9;  /* Adjust for desired opacity */
position: absolute;
top: 0;
right: 0;
bottom: 0;
left: 0;
background-size: cover;
background-position: center;
z-index: -1;  /* Makes sure it's behind the text */
}

.overlay-text {
    text-align: center;
    color: #d9e4ff; 
    z-index: 1;
}

.overlay-text h1, .overlay-text p, .overlay-text h2 {
    margin: 1px 0;
}

.overlay-text h1 {
    font-size: 130px; /* Adjust font size as needed */
}

.overlay-text p {
    font-size: 32px; /* Adjust font size as needed */
}

.overlay-text h2 {
    font-size: 32px; /* Adjust font size as needed */
}
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #bbc8e6;
    min-width: 100px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: #0a2242;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.admin-section {
display: flex;
align-items: center;
justify-content: center;
height: auto; /* Removing the fixed height */
font-size: 50px; 
font-weight: bold;
background-color: #617392; /* Color similar to the one in the image */
border-radius: 50px; /* Making it rounded. Adjust as necessary. */
padding: 15px 30px; /* Adding some padding to give space between the text and the circle's edge */
width: max-content; /* Making the width just large enough for the content */
margin: 0 auto; /* Centering the circle horizontally */
margin-top: 50px; /* Adjusts the space above the button */
box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); /* Optional: Add a subtle shadow for depth */
}

.admin-section span {
color: #d9e4ff; /* Text color similar to the one in the image */
}   
</style>

</head>
<body>

<div class="header">
    <img src="logo2.png" alt="Logo">
    <span class="brand-text">CRIMELEON</span>
    <div class="header-links">
        <a href="admin.php">HOME</a> 
        <a href="index_admin.php">MAP</a>
        <a href="users.php">USERS</a> 
        <a href="ad_record.php" class="active">REPORT</a>
        <a href="about_a.php">ABOUT US</a>
        <span class="user-name"><?php echo htmlspecialchars($_SESSION['firstname'] . " " . $_SESSION['lastname']); ?></span>
        <div class="dropdown">
            <img src="logout.png" alt="Logout Icon" style="cursor: pointer; width: 50px; height: 50px;">
            <div class="dropdown-content">
                <a href="logout.php">LOGOUT</a>
            </div>
        </div>
    </div>
</div>

<form action="record.php" method="GET">

<div class="form-row">
<div class="form-field">
    <label for="name_search">Name Search:</label>
    <input type="text" id="name_search" name="name_search" placeholder="Enter name...">
</div>
<div class="form-field">
    <label for="type_of_incident">Type of Incident:</label>
    <select id="type_of_incident" name="type_of_incident">
        <option value="">All Types</option>
        <option value="Theft">Theft</option>
        <option value="Burglary">Burglary</option>
        <option value="Vandalism">Vandalism</option>
        <option value="Assault">Assault</option>
        <option value="Robbery">Robbery</option>
        <option value="Arson">Arson</option>
        <option value="Homicide">Homicide</option>
        <option value="Fraud">Fraud</option>
        <option value="Drug Offense">Drug Offense</option>
        <option value="Traffic Violation">Traffic Violation</option>
        <option value="DUI">DUI (Driving Under the Influence)</option>
        <option value="Public Disturbance">Public Disturbance</option>
        <option value="Cybercrime">Cybercrime</option>
        <option value="Domestic Violence">Domestic Violence</option>
        <option value="Harassment">Harassment</option>
        <option value="Kidnapping">Kidnapping</option>
        <option value="Extortion">Extortion</option>
        <option value="Terrorism">Terrorism</option>
        <option value="Smuggling">Smuggling</option>
        <option value="Forgery">Forgery</option>
        <option value="Illegal Gambling">Illegal Gambling</option>
        <option value="Illegal Possession of Weapon">Illegal Possession of Weapon</option>
        <option value="Environment Crime">Environment Crime</option>
        <option value="Trafficking">Trafficking</option>
        <option value="Piracy">Piracy</option>
        <option value="Money Laundering">Money Laundering</option>
        <option value="Corruption">Corruption</option>
        <option value="Human Abuse/Maltreatment">Human Abuse/Maltreatment</option>
        <option value="Loitering">Loitering</option>
        <option value="Trespassing">Trespassing</option>
        <option value="Jaywalking">Jaywalking</option>
        <option value="Conspiracy">Conspiracy</option>
        <option value="Racketeering">Racketeering</option>
        <option value="Embezzlement">Embezzlement</option>
        <option value="Obstruction of Justice">Obstruction of Justice</option>
        <option value="Perjury">Perjury</option>
        <option value="Juvenile Delinquency">Juvenile Delinquency</option>
        <option value="Cult Activity">Cult Activity</option>
        <option value="Tax Evasion">Tax Evasion</option>
    </select>
</div>
   
<div class="form-field">
    <label for="location">Location:</label>
    <select id="location" name="location">
        <option value="">All Locations</option>
        <option value="Aguinaldo">Aguinaldo</option>
        <option value="Baldoza">Baldoza</option>
        <option value="Bantud">Bantud</option>
        <option value="Banuyao">Banuyao</option>
        <option value="Burgos-Mabini-Plaza">Burgos-Mabini-Plaza</option>
        <option value="Caingin">Caingin</option>
        <option value="Divinagracia">Divinagracia</option>
        <option value="Gustilo">Gustilo</option>
        <option value="Hinactacan">Hinactacan</option>
        <option value="Ingore">Ingore</option>
        <option value="Jereos">Jereos</option>
        <option value="Laguda">Laguda</option>
        <option value="Lopez Jaena Norte">Lopez Jaena Norte</option>
        <option value="Lopez Jaena Sur">Lopez Jaena Sur</option>
        <option value="Luna">Luna</option>
        <option value="MacArthur">MacArthur</option>
        <option value="Magdalo">Magdalo</option>
        <option value="Magsaysay Village">Magsaysay Village</option>
        <option value="Nabitasan">Nabitasan</option>
        <option value="Railway">Railway</option>
        <option value="Rizal">Rizal</option>
        <option value="San Isidro">San Isidro</option>
        <option value="San Nicolas">San Nicolas</option>
        <option value="Tabuc Suba">Tabuc Suba</option>
        <option value="Ticud">Ticud</option>
    </select>
</div>     
<div class="form-field">
    <label for="date_reported">Date Reported:</label>
    <input type="date" id="date_reported" name="date_reported">
</div>   
<div class="form-field">   
    <label for="date_of_incident">Date of Incident:</label>
    <input type="date" id="date_of_incident" name="date_of_incident">
</div> 
<div class="form-field">  
    <label for="status">Status:</label>
    <select id="status" name="status">
        <option value="">All Status</option>
        <option value="Pending">Pending</option>
        <option value="Approved">Approved</option>
        <option value="Declined">Declined</option>
    </select>
</div> 
    
    <input type="submit" value="Search">
</div> 
</form>



<table border="1">
    <tr>
        <th>Report ID</th>
        <th>Type of Incident</th>
        <th>Location</th>
        <th>Reporting Person</th>
        <th>Suspect</th>
        <th>Victim</th>
        <th>Status</th>
        <th>Details</th>
    </tr>
    <?php foreach ($reports as $report): ?>
        <tr>
            <td><?php echo htmlspecialchars($report['repID']); ?></td>
            <td><?php echo htmlspecialchars($report['type_of_incident']); ?></td>
            <td><?php echo htmlspecialchars($report['place_of_incident']); ?></td>
            <td><?php echo htmlspecialchars($report['reporter_family_name']) . ', ' . htmlspecialchars($report['reporter_first_name']); ?></td>
            <td><?php echo htmlspecialchars($report['suspect_family_name']) . ', ' . htmlspecialchars($report['suspect_first_name']); ?></td>
            <td><?php echo htmlspecialchars($report['victim_family_name']) . ', ' . htmlspecialchars($report['victim_first_name']); ?></td>
            <td><?php echo htmlspecialchars($report['status']); ?></td> 
            <td><button class="open-modal" data-id="<?php echo $report['repID']; ?>">View Details</button></td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Pagination Links -->
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?<?php echo $queryString; ?>&page=<?php echo $page - 1; ?>" class="prev">&laquo; Back</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?<?php echo $queryString; ?>&page=<?php echo $i; ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?<?php echo $queryString; ?>&page=<?php echo $page + 1; ?>" class="next">Next &raquo;</a>
    <?php endif; ?>
</div>



<!-- Modal Structure -->
<div id="myModal" class="modal">
    <div class="modal-content-report">

        <div class="modal-body-report">
            <!-- The content of the report will be dynamically loaded here -->
            <div id="reportDetails" class="report-details">
                <!-- Your PHP code will dynamically load report details here -->
            </div>
        </div>
        <div class="modal-footer-report">
            <button id="printButton">Print Report</button>
        </div>
        <span class="close" onclick="closeModal()">&times;</span>
    </div>
</div>

<script>
  // Modal script
  var modal = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];

  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  // Print function
  document.getElementById('printButton').addEventListener('click', function() {
    var printContents = document.getElementById('reportDetails').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  });
</script>

<!-- MODAL SCRIPT -->
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btns = document.getElementsByClassName("open-modal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal and load the report details
for (var i = 0; i < btns.length; i++) {
    btns[i].onclick = function() {
        var id = this.getAttribute('data-id');
        // Fetch report details using AJAX or another method
        loadReportDetails(id);
        modal.style.display = "block";
    }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Function to load report details into the modal
function loadReportDetails(reportId) {
    // Clear any previous details
    document.getElementById('reportDetails').innerHTML = '';

    // Create an XMLHttpRequest object
    var xhttp = new XMLHttpRequest();

    // Define the function to be executed when the server response is ready
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // The request is complete and response is received
            // Display the fetched data in the modal's content container
            document.getElementById('reportDetails').innerHTML = this.responseText;
        } else if (this.readyState == 4) {
            // There was a problem with the request
            // For example, the response status code was 200
            document.getElementById('reportDetails').innerHTML = 'Error loading details.';
        }
    };

    // Configure the request and include the reportId
    xhttp.open("GET", "reportdetails.php?reportId=" + reportId, true);

    // Send the request to the server
    xhttp.send();
}


</script>

<script>
window.onload = function() {
    var params = new URLSearchParams(window.location.search);

    if (params.get('name_search')) {
        document.getElementById('name_search').value = params.get('name_search');
    }
    
    if (params.get('type_of_incident')) {
        document.getElementById('type_of_incident').value = params.get('type_of_incident');
    }
    if (params.get('location')) {
        document.getElementById('location').value = params.get('location');
    }
    if (params.get('date_reported')) {
        document.getElementById('date_reported').value = params.get('date_reported');
    }
    if (params.get('date_of_incident')) {
        document.getElementById('date_of_incident').value = params.get('date_of_incident');
    }
};
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
  // Function to print report details
  function printReport() {
    html2canvas(document.getElementById('reportDetails')).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const doc = new jsPDF();

        doc.addImage(imgData, 'PNG', 10, 10);
        doc.save('report-details.pdf');
    });
}

  
  // Attach the function to a button inside the modal
  document.getElementById('printButton').addEventListener('click', printReport);
</script>


</body>
</html> 