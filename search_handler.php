<?php
// search_handler.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crimeleon2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

//
// Your query should join the necessary tables to fetch all relevant report details
$query = "SELECT personID, family_name, first_name, reportDetails FROM persons_data WHERE family_name LIKE '%{$searchTerm}%' OR first_name LIKE '%{$searchTerm}%'";

$result = $conn->query($query);

$suggestions = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // For each record, prepare an array with the name and the details
        $suggestions[] = [
            "fullName" => $row["first_name"] . " " . $row["family_name"],
            "reportDetails" => $row["reportDetails"] // Assume this is a field with report details
        ];
    }
}

// Return the suggestions as JSON
echo json_encode($suggestions);

$conn->close();
