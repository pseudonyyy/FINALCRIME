<?php
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

// Fetch registered users
$sql = "SELECT e.empNo, e.firstname, e.middlename, e.lastname, e.address, e.contact, e.licensed_idno, e.badge_no, u.emailaddr, u.userType 
        FROM employee e 
        JOIN users u ON e.empNo = u.empNo";
$result = $conn->query($sql);

$users = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

echo json_encode($users);

$conn->close();
?>
