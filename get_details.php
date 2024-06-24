<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crimeleon2";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if repID is provided
if(isset($_POST['repID'])){
    $repID = $_POST['repID'];
    
    // Initialize an array to hold all the details
    $detailsArray = [];

    // Begin transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Fetch report details
        $reportStmt = $conn->prepare("SELECT * FROM report WHERE repID = ?");
        $reportStmt->bind_param("i", $repID);
        $reportStmt->execute();
        $result = $reportStmt->get_result();
        if($report = $result->fetch_assoc()){
            $detailsArray['report'] = $report;
        }
        $reportStmt->close();

        // Fetch item A details
        $itemAStmt = $conn->prepare("SELECT * FROM item_a WHERE repID = ?");
        $itemAStmt->bind_param("i", $repID);
        $itemAStmt->execute();
        $result = $itemAStmt->get_result();
        while($itemA = $result->fetch_assoc()){
            $detailsArray['item_a'][] = $itemA;
        }
        $itemAStmt->close();

        // Fetch item B details
        $itemBStmt = $conn->prepare("SELECT * FROM item_b WHERE repID = ?");
        $itemBStmt->bind_param("i", $repID);
        $itemBStmt->execute();
        $result = $itemBStmt->get_result();
        while($itemB = $result->fetch_assoc()){
            $detailsArray['item_b'][] = $itemB;
        }
        $itemBStmt->close();

        // Fetch item C details
        $itemCStmt = $conn->prepare("SELECT * FROM item_c WHERE repID = ?");
        $itemCStmt->bind_param("i", $repID);
        $itemCStmt->execute();
        $result = $itemCStmt->get_result();
        while($itemC = $result->fetch_assoc()){
            $detailsArray['item_c'][] = $itemC;
        }
        $itemCStmt->close();

        // Fetch item D details
        $itemDStmt = $conn->prepare("SELECT * FROM item_d WHERE repID = ?");
        $itemDStmt->bind_param("i", $repID);
        $itemDStmt->execute();
        $result = $itemDStmt->get_result();
        while($itemD = $result->fetch_assoc()){
            $detailsArray['item_d'][] = $itemD;
        }
        $itemDStmt->close();

        // Commit the transaction
        $conn->commit();

        // Echo the details in JSON format
        echo json_encode($detailsArray);

    } catch(Exception $e) {
        // An error occurs, roll back the transaction
        $conn->rollback();
        echo "Error fetching details: " . $e->getMessage();
    }

    // Close the database connection
    $conn->close();

} else {
    echo "No report ID provided.";
}
?>
