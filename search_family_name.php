<?php
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

$query = $conn->real_escape_string($_POST['query']);
$sql = "SELECT personID, family_name, first_name, middle_name, qualifier, nickname, citizenship, sex, civil_status, doBirth, age, poBirth, hPhone, mPhone, cHouseNo, cSitio, cBrgy, cTown, cProvince, oHouseNo, oSitio, oBrgy, oTown, oProvince, heAttain, occupation, idCard, email FROM persons_data WHERE family_name LIKE '%$query%' LIMIT 10";
$result = $conn->query($sql);

$suggestions = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $suggestions[] = $row;
  }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($suggestions);
