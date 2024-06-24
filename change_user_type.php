<?php
session_start();
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['empNo']) && isset($_POST['userType'])) {
    $empNo = $_POST['empNo'];
    $userType = $_POST['userType'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET userType=? WHERE empNo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $userType, $empNo);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
