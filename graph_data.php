<?php
session_start();
header('Content-Type: application/json');


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

// Get the filter parameters from the query string
$incidentFilter = isset($_GET['incident']) ? $_GET['incident'] : null;
$monthFilter = isset($_GET['month']) ? $_GET['month'] : null;
$placeFilter = isset($_GET['place']) ? $_GET['place'] : null;

// Prepare the SQL query with filters
$whereClauses = [];
if ($incidentFilter) {
    $whereClauses[] = "type_of_incident = '" . $conn->real_escape_string($incidentFilter) . "'";
}
if ($monthFilter) {
    $whereClauses[] = "MONTH(datetime_reported) = '" . $conn->real_escape_string($monthFilter) . "'";
}
if ($placeFilter) {
    $whereClauses[] = "place_of_incident = '" . $conn->real_escape_string($placeFilter) . "'";
}
$whereSql = !empty($whereClauses) ? " WHERE " . implode(' AND ', $whereClauses) : '';

$sql = "SELECT type_of_incident, COUNT(*) as count FROM report" . $whereSql . " GROUP BY type_of_incident";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

echo json_encode($data);
?>