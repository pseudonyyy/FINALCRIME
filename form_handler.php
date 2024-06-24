<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crimeleon2";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to insert a report and return its ID
function insertReport($conn) {
    $stmt = $conn->prepare("INSERT INTO report (type_of_incident, datetime_of_incident, datetime_reported, place_of_incident, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdd", $_POST['type_of_incident'], $_POST['datetime_of_incident'], $_POST['datetime_reported'], $_POST['place_of_incident'], $_POST['latitude'], $_POST['longitude']);
    $stmt->execute();
    $reportID = $conn->insert_id;
    $stmt->close();
    return $reportID;
}

// Function to insert data into item_a, item_b, item_c
function insertItemData($conn, $tableName, $personID, $reportID, $additionalData = null) {
    if ($tableName === 'item_b') {
        // Prepare the statement with the additional fields for item_b
        $stmt = $conn->prepare("INSERT INTO item_b (personID, repID, sRank, sAssign, sAffiliation, sCrimRecord, sStatus, Height, Weight, eyeColor, eyeDesc, hairColor, hairDesc, sInfluence, guardian_name, g_address, ghome_phone, gmob_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        // Bind the parameters for item_b
        $stmt->bind_param("iissssssssssssssss", $personID, $reportID, ...$additionalData);
    } else {
        // Prepare a standard statement for other items
        $stmt = $conn->prepare("INSERT INTO {$tableName} (personID, repID) VALUES (?, ?)");
        $stmt->bind_param("ii", $personID, $reportID);
    }
    $stmt->execute();
    $stmt->close();
}

// Begin transaction
$conn->begin_transaction();

try {
    // Insert the report and get its ID
    $reportID = insertReport($conn);

    // Insert items into their respective tables
    insertItemData($conn, 'item_a', $_POST['personID_a'], $reportID);
    
    // Collect additional data for item_b
    $additionalDataB = [
        $_POST['sRank'], $_POST['sAssign'], $_POST['sAffiliation'],
        $_POST['sCrimRecord'], $_POST['sStatus'], $_POST['Height'],
        $_POST['Weight'], $_POST['eyeColor'], $_POST['eyeDesc'],
        $_POST['hairColor'], $_POST['hairDesc'], $_POST['sInfluence'],
        $_POST['guardian_name'], $_POST['g_address'], $_POST['ghome_phone'],
        $_POST['gmob_phone']
    ];
    
    // Insert data for item_b with additional fields
    insertItemData($conn, 'item_b', $_POST['personID_b'], $reportID, $additionalDataB);

    // Insert data for item_c, similar to item_a
    insertItemData($conn, 'item_c', $_POST['personID_c'], $reportID);


    // Insert data into item_d
    $stmtD = $conn->prepare("INSERT INTO item_d (repID, narrative, administering_officer, rank_name_of_desk_officer, blotter_number, police_station_name, investigator_on_case, chief_head_of_office) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtD->bind_param("isssssss", $reportID, $_POST['narrative'], $_POST['administering_officer'], $_POST['rank_name_of_desk_officer'], $_POST['blotter_number'], $_POST['police_station_name'], $_POST['investigator_on_case'], $_POST['chief_head_of_office']);
    $stmtD->execute();
    $stmtD->close();

    // If successful, commit and send a JSON response
    $conn->commit();
    echo json_encode(["status" => "success", "message" => "Report submitted successfully."]);
} catch (Exception $e) {
    // If an error occurs, rollback and send a JSON response
    $conn->rollback();
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

// Close the database connection
$conn->close();
?>
