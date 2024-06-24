<?php
session_start();

// Redirect user to login page if they're not logged in or not an admin
if (!isset($_SESSION['userType']) || $_SESSION['userType'] != 'investigator') {
    header('Location: login.php');
    exit();
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crimeleon2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$incidentFilter = isset($_GET['incident']) ? $_GET['incident'] : null;
$monthFilter = isset($_GET['month']) ? $_GET['month'] : null;
$placeFilter = isset($_GET['place']) ? $_GET['place'] : null;

// Prepare the SQL query with filters
$whereClauses = [];
if ($incidentFilter) {
    $whereClauses[] = "type_of_incident = '" . $incidentFilter . "'";
}
if ($monthFilter) {
    $whereClauses[] = "MONTH(datetime_reported) = " . $monthFilter;
}
if ($placeFilter) {
    $whereClauses[] = "place_of_incident = '" . $placeFilter . "'";
}
$whereSql = !empty($whereClauses) ? " WHERE " . implode(' AND ', $whereClauses) : '';

$sql = "SELECT type_of_incident, COUNT(*) as count FROM report " . $whereSql . " GROUP BY type_of_incident";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRIMELEON - Home</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    #showChartBtn {
    font-family: 'Lovelo', sans-serif;
    padding: 10px 20px;
    font-size: 18px;
    margin-top: 10px;
    margin-left: 670px;
    background-color: #a4b7e4; /* Button background color */
    color: white; /* Button text color */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

#showChartBtn:hover {
    background-color: #2874a6; /* Darker color when hovered */
}

    .image-section {
    background-image: url('cbg.png');
    background-size: cover;
    background-position: center;
    position: relative;
    height: 550px; /* You can adjust this according to your image's height or your preference */
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
<style>
        @import url('https://fonts.cdnfonts.com/css/lovelo?styles=25962');
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


</style>
<style> 
.filters {
    margin-bottom: 20px; /* Space between filters and chart */
}

.filters select, .filters button {
    padding: 5px 10px;
    margin-right: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.filters button {
    cursor: pointer;
}

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1000; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto; /* 10% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Responsive width */
    max-width: 1000px; /* Maximum width, can adjust based on your requirement */
    border-radius: 5px; /* Optional: for rounded corners */
    overflow: auto; /* Allow scrolling if content is bigger than the modal */
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

/* Style adjustments for the Chart.js canvas */
#crimeChart {
    width: 100% !important; /* Force the chart to expand to the modal width */
    height: auto !important; /* Maintain aspect ratio */
    max-height: 600px; /* Maximum height before scrolling, can adjust based on your requirement */
}

</style>
</head>
<body>

<div class="header">
    <img src="logo2.png" alt="Logo">
    <span class="brand-text">CRIMELEON</span>
    <div class="header-links">
        <a href="investigator.php" class="active">HOME</a>
        <a href="index_inv.php">MAP</a>
        <a href="inv_record.php">REPORT</a>
        <a href="about_i.php">ABOUT US</a>
        <span class="user-name"><?php echo htmlspecialchars($_SESSION['firstname'] . " " . $_SESSION['lastname']); ?></span>
        <div class="dropdown">
            <img src="logout.png" alt="Logout Icon" style="cursor: pointer; width: 50px; height: 50px;">
            <div class="dropdown-content">
                <a href="logout.php">LOGOUT</a>
            </div>
        </div>
    </div>
</div>


<section class="image-section">
    <div class="overlay-text">
        <h1>CRIMELEON</h1>
        <p>Citizen's Complaints Record</p>
        <h2>Management System</h2>
        <section class="admin-section">
        <span>INVESTIGATOR</span>
        </section>
    </div>
</section>


<button id="showChartBtn">Show Chart</button>
<!-- Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
  <span class="close">&times;</span>
    <!-- Add this inside your modal-content div or where the chart should be displayed -->
<div class="filters">
    <select id="incidentTypeFilter">
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

    <select id="monthFilter">
        <option value="">All Months</option>
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">Novenber</option>
        <option value="12">December</option>

        <!-- Add options for each month -->
    </select>

    <select id="placeFilter">
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

    <button id="applyFiltersBtn">Apply Filters</button>
</div>


    <canvas id="crimeChart"></canvas> <!-- Canvas for Chart.js -->
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("myModal");
    var chart; // We'll use this variable to store the chart instance

    document.getElementById('showChartBtn').onclick = function() {
        modal.style.display = "block";
        if (!chart) { // Check if the chart is not already initialized
            fetchChart(); // Initial chart fetch with no filters
        }
    };

    // Fetch chart data with filters and redraw the chart
    document.getElementById('applyFiltersBtn').addEventListener('click', function() {
        fetchChart(); // Fetch and draw chart with filters when the button is clicked
    });

    function fetchChart() {
        const incidentType = document.getElementById('incidentTypeFilter').value;
        const month = document.getElementById('monthFilter').value;
        const place = document.getElementById('placeFilter').value;
        
        fetch(`graph_data.php?incident=${incidentType}&month=${month}&place=${place}`)
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.type_of_incident);
            const counts = data.map(item => item.count);
            
            var ctx = document.getElementById('crimeChart').getContext('2d');
            if (chart) { // If the chart instance already exists, destroy it before creating a new one
                chart.destroy();
            }
            chart = new Chart(ctx, { // Reassign the newly created chart to the chart variable
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Incidents',
                        data: counts,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching filtered data:', error));
    };

    // Close the modal
    var closeBtn = document.getElementsByClassName("close")[0];
    closeBtn.onclick = function() {
        modal.style.display = "none";
    };
});


</script>




</body>
</html>
</html>