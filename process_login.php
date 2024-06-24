<?php
// Start session to store user data once they are logged in
session_start();

// Database configuration
$host = "localhost";
$dbname = "crimeleon2";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Prepare a select statement to include the status
    $sql = "SELECT u.userID, u.empNo, u.emailaddr, u.userType, u.password, u.status, e.firstname, e.lastname 
            FROM users u 
            INNER JOIN employee e ON u.empNo = e.empNo 
            WHERE u.emailaddr = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $email);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Store result
            $stmt->store_result();

            // Check if email exists, if yes then verify password
            if ($stmt->num_rows == 1) {
                // Bind result variables
                $stmt->bind_result($id, $empNo, $emailaddr, $userType, $hashed_password, $status, $firstname, $lastname);
                if ($stmt->fetch()) {
                    if($status == 'inactive') {
                        // If status is inactive, redirect back to login with error
                        header("location: login.php?error=inactiveaccount");
                        exit;
                    }
                    // Check if the password is correct
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, so start a new session and
                        // store data in session variables
                        $_SESSION['userID'] = $id;
                        $_SESSION['firstname'] = $firstname;
                        $_SESSION['lastname'] = $lastname;
                        $_SESSION['emailaddr'] = $emailaddr;
                        $_SESSION['userType'] = $userType;

                        // Redirect user to respective page based on user type
                        switch ($userType) {
                            case 'admin':
                                header("location: admin.php");
                                break;
                            case 'investigator':
                                header("location: investigator.php");
                                break;
                            case 'police':
                                header("location: police.php");
                                break;
                            default:
                                // Redirect to login page with error message
                                header("location: login.php?error=invalidusertype");
                                break;
                        }
                    } else {
                        // Password is not valid, display an error message
                        header("location: login.php?error=incorrectpassword");
                        exit;
                    }
                }
            } else {
                // Email doesn't exist, display an error message
                header("location: login.php?error=nouser");
                exit;
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
}

// Close connection
$conn->close();
?>
