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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['empNo']) && isset($_POST['currentStatus'])) {
    $empNo = $_POST['empNo'];
    $currentStatus = $_POST['currentStatus'];
    $newStatus = ($currentStatus === 'active') ? 'inactive' : 'active';
    
    // Prepare an update statement
    $sql = "UPDATE users SET status = ? WHERE empNo = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("si", $newStatus, $empNo);
    
    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Status updated successfully.";
    } else {
        $_SESSION['message'] = "Error updating status: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
    
    // Redirect to the users page with a message
    header("Location: users.php");
    exit();
}
?>
