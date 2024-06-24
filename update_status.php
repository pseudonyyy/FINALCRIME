<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crimeleon2";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reportId = $_POST['reportId'];
    $status = $_POST['status'];

    // For debugging purposes:
    error_log("Updating report ID $reportId to status $status");

    $stmt = $conn->prepare("UPDATE report SET status = ? WHERE repID = ?");
    $stmt->bind_param("si", $status, $reportId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
        // For debugging purposes:
        error_log("Error updating record: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>
