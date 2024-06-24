<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "crimeleon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the delete button is clicked, handle the deletion
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header('Location: users.php?message=User Deleted Successfully');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch user details
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
} else {
    die("Invalid User");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.content {
    max-width: 500px;
    margin: 50px auto;
    background: #fff;
    padding: 20px 40px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.content h2 {
    color: #007bff;
    margin-bottom: 20px;
}

p {
    font-size: 1.1em;
    margin-bottom: 20px;
}

button[type="submit"], 
a {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    margin-right: 10px;
    display: inline-block;
    cursor: pointer;
}

button[type="submit"]:hover, 
a:hover {
    background-color: #0056b3;
}

a {
    background-color: #ccc;
    color: #333;
}

a:hover {
    background-color: #aaa;
}

    </style>    
</head>
<body>
    <div class="content">
        <h2>Delete User</h2>
        <p>Are you sure you want to delete the user: <strong><?= $user['firstname'] ?></strong>?</p>
        <form method="post">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <button type="submit" name="delete">Delete</button>
            <a href="users.php">Cancel</a>
        </form>
    </div>
</body>
</html>
