<?php
session_start();

// Check if the user is logged in and is an Admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crimeleon";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store user details
$user = null;

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data based on the ID provided
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
    $stmt->close();
}

// Handle form submission to update user details
if (isset($_POST['update_user'])) {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $licensed_id_number = $_POST['licensed_id_number'];
    $position = $_POST['position'];
    $government_email = $_POST['government_email'];
    $badge_number = $_POST['badge_number'];
    $id = $_POST['id'];

    // Update user data in the database
    $stmt = $conn->prepare("UPDATE users SET firstname=?, middlename=?, lastname=?, address=?, contact=?, licensed_id_number=?, position=?, government_email=?, badge_number=? WHERE id=?");
    $stmt->bind_param("sssssssssi", $firstname, $middlename, $lastname, $address, $contact, $licensed_id_number, $position, $government_email, $badge_number, $id);

    if ($stmt->execute()) {
        header("Location: users.php?msg=User%20updated%20successfully");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
        @import url('https://fonts.cdnfonts.com/css/lovelo?styles=25962');
    </style>
    <style>
        body {
            font-family: 'Lovelo', sans-serif;
            background-color: #0a2242;
            margin: 0;
            padding: 0;
}

.header {
    text-align: right;
    padding: 12px; /* A little more padding */
    background-color: #f8f8f8; /* Background to make it stand out */
}

.dashboard {
    text-align: right;
    padding: 12px;
}

.dashboard a {
    text-decoration: none;
    margin: 0 12px; /* Slightly larger margin */
    color: #0062cc; /* Darker blue for a change */
}

.content {
    max-width: 800px;
    margin: 20px auto; /* Increased margin for better spacing */
    background: #ffffff;
    padding: 25px;
    border-radius: 6px; /* Increased border-radius */
    box-shadow: 0 0 12px rgba(0, 0, 0, 0.08); /* Softer shadow */
}

.content h2 {
    color: #0062cc; /* Matching the color with dashboard links */
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #ccc; /* A bit lighter border color */
}

th, td {
    padding: 12px; /* A bit more padding for comfort */
    text-align: left;
}

th {
    background-color: #0062cc; /* Again, matching the color scheme */
    color: #ffffff;
}

tr:nth-child(even) {
    background-color: #e6e6e6; /* Slightly different shade for even rows */
}

form {
    margin-top: 25px; /* More top margin for clarity */
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 6px; /* Tiny increase for better spacing */
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 50%;
    padding: 11px; /* More padding for input fields */
    margin-bottom: 12px;
    border: 1px solid #b0b0b0; /* Lighter border */
    border-radius: 6px; /* Consistent with content border-radius */
}

select {
    width: 50%;
    padding: 11px;
    margin-bottom: 12px;
    border: 1px solid #b0b0b0;
    border-radius: 6px;
}

button[type="submit"] {
    background-color: #0062cc;
    color: #ffffff;
    border: none;
    padding: 11px 22px;
    border-radius: 6px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #004699; /* Darker blue for hover */
}

    </style>    
</head>
<body>
    <div class="content">
        <?php if ($user): ?>
            <h2>Edit User: <?= $user['firstname'] . ' ' . $user['lastname'] ?></h2>
            <form method="post" action="edit_user.php">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">

            <label>First Name:</label>
            <input type="text" name="firstname" value="<?= $user['firstname'] ?>" required>

            <label>Middle Name:</label>
            <input type="text" name="middlename" value="<?= $user['middlename'] ?>">

            <label>Last Name:</label>
            <input type="text" name="lastname" value="<?= $user['lastname'] ?>" required>

            <label>Address:</label>
            <input type="text" name="address" value="<?= $user['address'] ?>" required>

            <label>Contact:</label>
            <input type="text" name="contact" value="<?= $user['contact'] ?>" required>

            <label>Licensed ID Number:</label>
            <input type="text" name="licensed_id_number" value="<?= $user['licensed_id_number'] ?>" required>

            <label>Position:</label>
            <input type="text" name="position" value="<?= $user['position'] ?>" required>

            <label>Government Email:</label>
            <input type="email" name="government_email" value="<?= $user['government_email'] ?>" required>

            <label>Badge Number:</label>
            <input type="text" name="badge_number" value="<?= $user['badge_number'] ?>" required>

                <button type="submit" name="update_user">Update User</button>
            </form>
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
