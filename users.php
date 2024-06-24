<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    

// Sanitize and prepare data
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$contact = mysqli_real_escape_string($conn, $_POST['contact']);
$licensed_idno = mysqli_real_escape_string($conn, $_POST['licensed_idno']);
$badge_no = mysqli_real_escape_string($conn, $_POST['badge_no']);
$emailaddr = mysqli_real_escape_string($conn, $_POST['emailaddr']);
$userType = mysqli_real_escape_string($conn, $_POST['userType']);
$password = mysqli_real_escape_string($conn, $_POST['password']); 


// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into employee table
$employee_sql = "INSERT INTO employee (firstname, middlename, lastname, address, contact, licensed_idno, badge_no) VALUES ('$firstname', '$middlename', '$lastname', '$address', '$contact', '$licensed_idno', '$badge_no')";
if ($conn->query($employee_sql) === TRUE) {
    $empNo = $conn->insert_id; // Get the auto-generated empNo

    // Insert into users table with hashed password
    $users_sql = "INSERT INTO users (empNo, emailaddr, userType, password) VALUES ('$empNo', '$emailaddr', '$userType', '$hashed_password')";
    // After the users table insert query
    if ($conn->query($users_sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    // Handle error in inserting into employee table
    echo "Error: " . $conn->error;
}

$conn->close();
}

 // Database connection details
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "crimeleon2";

// Reopen the connection for fetching registered users
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch registered users
$sql = "SELECT e.empNo, e.firstname, e.middlename, e.lastname, e.address, e.contact, e.licensed_idno, e.badge_no, u.emailaddr, u.userType, u.status 
        FROM employee e 
        JOIN users u ON e.empNo = u.empNo";

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <title>CRIMELEON - User Management</title>

<!-- STATUS CSS -->
<style>
 #successUserTypeModal .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}

#successUserTypeModal .modal-content {
    background-color: #0a2242;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 30%;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.5);
    animation: animatetop 0.4s;
}

@keyframes animatetop {
    from {top: -300px; opacity: 0}
    to {top: 0; opacity: 1}
}
select.user-type-select {
    font-family: 'Lovelo', sans-serif;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #Adc3e8;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

select.user-type-select:hover {
    border-color: #888;
}

/* Style for options inside the dropdown */
select.user-type-select option {
    padding: 8px;
    background: white;
    color: #333;
}



.inline-label input[type="text1"] {
    width: 100%; /* Full width to match other fields */
    padding: 10px; /* Padding for aesthetics */
    padding-right: 110px; /* Extra padding on the right for the domain text */
    border: 1px solid #ccc; /* Standard border to match other inputs */
    border-radius: 4px; /* Rounded corners for aesthetics */
    box-sizing: border-box; /* Ensures padding doesn't affect overall width */
    background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="20"><text x="0" y="15" font-size="14" font-family="Arial" fill="%23666">@pnp.gov.ph</text></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center; /* Positioning the SVG inside the input */
    background-size: 100px 20px;
}

.inline-label input[type="email"]:focus {
    outline: none; /* Removes the outline to keep UI clean */
}

table td {
    padding-top: 0; /* Remove padding at the top of the cell if any */
    padding-bottom: 0; /* Remove padding at the bottom of the cell if any */
    vertical-align: middle; /* Align content of the cell to the middle vertically */
}

/* Styling for the status button */
.status-btn {
    position: relative; /* Relative positioning to move button within its normal position */
    top: -10px; /* Move button 10px up, adjust as necessary */
    font-family: 'Lovelo', sans-serif;
    padding: 5px 10px; /* Adjust padding to your preference */
    border: none;
    border-radius: 4px;
    color: white;
    cursor: pointer;
    font-size: 0.875em; /* Adjust size as necessary */
    outline: none;
    display: inline-block; /* To apply text-align from td */
    width: 100%; /* Adjust width as necessary */
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

.status-btn.active {
    background-color: #28a745; /* Green background for active status */
}

.status-btn.inactive {
    background-color: #dc3545; /* Red background for inactive status */
}

.status-btn:hover {
    opacity: 0.8;
}


</style>

<style>
    /* Success Notification Modal specific styles */
#successModal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 2; /* Sit on top, higher than other content */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0,0,0,0.4); /* Black with opacity */
}

#successModal .modal-content {
    background-color: #0a2242; 
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #e0e0e0; /* Light green border */
    width: 20%; /* Width can be adjusted */
    border-radius: 5px; /* Rounded corners */
}

#successModal .modal-content h2 {
    color: #e0e0e0; /* Dark green text */
}

#successModal .close {
    color: #000;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

#successModal .close:hover,
#successModal .close:focus {
    color: #3c763d; /* Dark green for close button on hover/focus */
    text-decoration: none;
    cursor: pointer;
}

</style>  

<!-- MODAL CSS -->
<style>
/* Ensuring the highest specificity for label color */
#registrationModal .modal-content label {
    color: white; /* White text for labels within the modal */
}

/* Additional styling for form elements inside the modal for consistency */
#registrationModal .modal-content input[type="text"],
#registrationModal .modal-content input[type="email"],
#registrationModal .modal-content input[type="password"],
#registrationModal .modal-content select {
    color: black; /* White text for input content */
    background-color: white; /* Dark background for the inputs for contrast */
    border: 1px solid #777;
}

/* CSS for the submit button wrapper */
.submit-wrapper {
    text-align: right;
    padding-right: 15px;
}

/* Styling for the submit button itself */
#registrationModal .modal-content .submit-wrapper input[type="submit"] {
    font-family: 'Lovelo', sans-serif;
    background-color: #88afee;
    color: white;
    padding: 10px 10px;
    font-size: 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    
}

#registrationModal .modal-content .submit-wrapper input[type="submit"]:hover {
    background-color: #274575;
}




/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity, adds dimming effect */
}

/* Modal Content */
.modal-content {
    color: white;
    position: relative;
    background-color: #0a2242;
    margin: 10% auto; /* 10% from the top and centered */
    padding: 20px;
    border: 2px solid #e0e0e0;
    width: 80%; /* You can adjust this value */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    animation-name: animatetop;
    animation-duration: 0.4s;
}

/* Add Animation */
@keyframes animatetop {
    from {top: -300px; opacity: 0}
    to {top: 0; opacity: 1}
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

/* Style adjustments for your form inputs, labels, and buttons */
input[type="text"],
input[type="email"],
input[type="password"],
select {
    width: calc(100% - 22px); /* Adjust input width, considering padding */
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button[type="submit"] {
    width: auto;
    background-color: #4CAF50; /* Green */
    color: white;
    padding: 14px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}


</style>

<!-- ORIGINAL CSS -->
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


    .image-section {
    background-image: url('cbg.png');
    background-size: cover;
    background-position: center;
    position: relative;
    height: 400px; /* You can adjust this according to your image's height or your preference */
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


    .dashboard {
        text-align: right;
        padding: 10px;
    }

    .dashboard a {
        text-decoration: none;
        margin: 0 10px;
        color: #51a1e3;
    }

    .content {
        max-width: 90%;
        margin: 40px auto;
        background: #c3d1e9;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .content h2, .content h3 {
        color: #0a2242;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table, th, td {
        border: 1px solid #e0e0e0;
    }

    th, td {
        padding: 5px;
        text-align: left;
    }

    th {
        background-color: #0a2242;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #b0bcd2 ;
    }

    form {
        margin-top: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 8px;
        color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 98%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }


.button-container {
  text-align: right; /* Keeps the button aligned to the right */
  padding-right: 10px; /* Reduced padding moves the button a bit to the left */
}

.button-container:hover {
    opacity: 0.8;
}

#showRegistrationFormBtn {
    font-family: 'Lovelo', sans-serif;
    background-color: #0a2242;
    color: white;
    padding: 10px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.button-container {
  width: auto; /* Adjusting to 'auto' may allow for more natural spacing */
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
        <a href="users.php" class="active">USERS</a>
        <a href="ad_record.php">REPORT</a>
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


<div class="content">

<div class="button-container">
  <button id="showRegistrationFormBtn">
    Register New User
    <img src="plus.png" alt="add" style="vertical-align: middle; margin-left: 8px; width: 24px; height: 24px;">
  </button>
</div>


<h1>Registered Users</h1>
<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Emp No</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>License ID No</th>
                <th>Badge No</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["empNo"]; ?></td>
                    <td><?php echo htmlspecialchars($row["firstname"]); ?></td>
                    <td><?php echo htmlspecialchars($row["middlename"]); ?></td>
                    <td><?php echo htmlspecialchars($row["lastname"]); ?></td>
                    <td><?php echo htmlspecialchars($row["address"]); ?></td>
                    <td><?php echo htmlspecialchars($row["contact"]); ?></td>
                    <td><?php echo htmlspecialchars($row["licensed_idno"]); ?></td>
                    <td><?php echo htmlspecialchars($row["badge_no"]); ?></td>
                    <td><?php echo htmlspecialchars($row["emailaddr"]); ?></td>
                    <!-- <td><?php echo htmlspecialchars($row["userType"]); ?></td> -->
                    <td>
                    <select class="user-type-select" onchange="changeUserType(<?php echo $row['empNo']; ?>, this.value)">
                        <option value="admin" <?php if($row["userType"] == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="police" <?php if($row["userType"] == 'police') echo 'selected'; ?>>Police</option>
                        <option value="investigator" <?php if($row["userType"] == 'investigator') echo 'selected'; ?>>Investigator</option>
                    </select>
                    </td>
                    <td><?php echo htmlspecialchars($row["status"]); ?></td>
                    <td>
                        <form action="change_status.php" method="post">
                            <input type="hidden" name="empNo" value="<?php echo $row["empNo"]; ?>">
                            <input type="hidden" name="currentStatus" value="<?php echo $row["status"]; ?>">
                            <input type="submit" class="status-btn <?php echo ($row["status"] === 'active') ? 'inactive' : 'active'; ?>" 
                            value="<?php echo ($row["status"] === 'active') ? 'Deactivate' : 'Activate'; ?>">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No registered users found.</p>
<?php endif; ?>


</div>

<!-- User Registration Form in Modal -->
<div id="registrationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>User Registration</h2>
        <form id="registrationForm" action="" method="post">
            <label for="userType">User Type:</label>
            <select name="userType">
                <option value="admin">Admin</option>
                <option value="police">Police</option>
                <option value="investigator">Investigator</option>
            </select><br>
            
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" required><br>

            <label for="middlename">Middle Name:</label>
            <input type="text" name="middlename"><br>

            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" required><br>

            <label for="address">Address:</label>
            <input type="text" name="address" required><br>

            <label for="contact">Contact:</label>
            <input type="text" name="contact" required><br>

            <label for="licensed_idno">Licensed ID No:</label>
            <input type="text" name="licensed_idno" required><br>

            <label for="badge_no">Badged No:</label>
            <input type="text" name="badge_no" required><br>

            <label for="email" class="inline-label">Email:
            <input type="text1" id="email" name="emailaddr">
            </label>

            <script>
            document.getElementById('registrationForm').addEventListener('submit', function(event) {
                var emailInput = document.getElementById('email');
                var domain = "@pnp.gov.ph";
                if (!emailInput.value.includes(domain)) {
                    emailInput.value += domain;
                }
            });
            </script>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <div class="submit-wrapper">
            <input type="submit" value="Register">
            </div>
        </form>
    </div>
</div>

<!-- Correctly Defined Success Message Modal -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <span class="close successClose">&times;</span>
        <h2>Registration Successful</h2>
        <p>User registered successfully!</p>
    </div>
</div>

<!-- Success Message Modal for User Type Change -->
<div id="successUserTypeModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="$('#successUserTypeModal').fadeOut();">&times;</span>
        <h2>Success</h2>
        <p>User type was successfully updated.</p>
    </div>
</div>


<!-- MODAL SCRIPT -->
<script>
// JavaScript for handling modal display
document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById('registrationModal');
    var btn = document.getElementById('showRegistrationFormBtn');
    var span = document.getElementsByClassName('close')[0]; // Adjust this if you have more close buttons

    btn.onclick = function() {
        modal.style.display = 'block';
    }

    span.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
});

// jQuery for AJAX form submission
$(document).ready(function() {
    $('#registrationForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                if (response.includes("success")) {
                    $('#successModal').show();
                    setTimeout(function() {
                        $('#successModal').hide();
                    }, 2000);
                } else {
                    alert("Registration failed. Please try again.");
                }
            }
        });
    });
});

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('#registrationForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                // Assuming 'response' includes a success indication
                if (response.includes("success")) {
                    // Show the success modal
                    $('#successModal').show();

                    // Close the success modal when the user clicks on <span> (x)
                    $('.successClose').click(function() {
                        $('#successModal').hide();
                    });

                    // Hide the modal after 2 seconds and reload the page
                    setTimeout(function() {
                        $('#successModal').hide();
                        window.location.reload(); // Reload the page
                    }, 2000);
                } else {
                    // Handle failure or show an error message
                    alert("Registration failed. Please try again.");
                }
            }
        });
    });

    // Handle closing the success modal if the user clicks anywhere outside of the modal
    window.onclick = function(event) {
        if (event.target == document.getElementById('successModal')) {
            $('#successModal').hide();
        }
    }
});


</script>

<!-- STATUS SCRIPT -->
<script>
function toggleStatus(empNo, currentStatus) {
    var newStatus = (currentStatus === 'active') ? 'inactive' : 'active';
    
    $.ajax({
        type: "POST",
        url: "change_status.php", // the PHP file to handle the request
        data: { empNo: empNo, currentStatus: newStatus },
        success: function(response) {
            if(response.includes("success")) {
                // Update the status in the table without reloading the page
                var btns = document.querySelectorAll('.status-btn');
                var texts = document.querySelectorAll('.status-text');
                for(var i = 0; i < btns.length; i++) {
                    if(btns[i].getAttribute('onclick').includes(empNo)) {
                        texts[i].textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                        btns[i].textContent = (newStatus === 'active') ? 'Deactivate' : 'Activate';
                        btns[i].setAttribute('onclick', 'toggleStatus('+empNo+', \''+newStatus+'\')');
                    }
                }
            } else {
                alert("Status update failed. Please try again.");
            }
        }
    });
}
</script>

<script>
function changeUserType(empNo, newUserType) {
    $.ajax({
        type: "POST",
        url: "change_user_type.php",
        data: { empNo: empNo, userType: newUserType },
        success: function(response) {
            if (response.includes("success")) {
                // Display the success modal
                $('#successUserTypeModal').fadeIn();
                setTimeout(function() {
                    $('#successUserTypeModal').fadeOut();
                }, 2000);
            } else {
                alert("Error updating user type.");
            }
        },
        error: function() {
            alert("Error updating user type.");
        }
    });
}


function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}
</script>




</body>
</html>
