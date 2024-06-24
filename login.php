<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
 
    <style>
.password-container {
    position: relative;
    width: 75%;
    margin: 0 auto 16px auto;
}

.password-container input {
    width: calc(100% - 40px); /* Adjust the width of the input to make space for the icon */
    padding: 10px;
    margin-bottom: 0; /* Align input with the icon */
    border-radius: 4px;
    font-size: 16px;
}

.password-container i {
    color: #61696c;
    position: absolute;
    right: 18px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}


@import url('https://fonts.cdnfonts.com/css/lovelo?styles=25962');
    body {
        font-family: 'Lovelo', sans-serif;
        background-color: #bbc8e6;
        margin: 0;
        overflow: hidden; /* Prevent scrolling */
    }

    .container {
        display: flex;
        width: 100vw; /* Take the full viewport width */
        height: 100vh; /* Take the full viewport height */
    }

    .logo-container {
        flex: 1; 
        background-color: #bbc8e6;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logo-container img {
        width: 80%;
        max-height: 80%;
    }

    .login-container {
        flex: 1; 
        padding: 50px;
        background-color: #0a2242;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    h2 {
    text-align: center;
    margin-bottom: 24px;
    color: #bbc8e6;
    font-size: 50px; /* Increase the font size */
    font-weight: bold; /* Make the text bold */
    }

    label {
    display: block;
    text-align: center; /* Center the label text */
    margin-bottom: 10px; /* Adjust margin to move the label closer to the input */
    color: #bbc8e6;
    font-weight: bold; /* Make the label text bold for emphasis */
    }

    input {
    width: 70%; /* Reduced width of the input fields */
    padding: 10px; /* Reduced padding for a more compact look */
    margin: 0 auto 16px auto; /* Center the input fields and provide margin at the bottom */
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    display: block; /* To make use of the automatic margins for centering */
    }
    button {
    width: 20%;
    padding: 12px 20px;
    background-color: #bbc8e6;
    color: #0a2242;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: block;
    margin: 20px auto;
    font-size: 18px;
    font-weight: bold;
    font-family: 'Lovelo', sans-serif; /* Apply the Lovelo font here */
    transition: background-color 0.3s, transform 0.2s;
}
    button:hover {
    background-color: #003366;
    }

    .error-message {
        text-align: center; /* Center text within the div */
        color: red;
        margin: 0 auto; /* Center the div itself */
        width: 100%; /* Take full width to maintain center alignment */
        padding: 10px 0; /* Optional padding for styling */
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="finallogo.png" alt="Logo">
        </div>
        <div class="login-container">
            <h2>LOG-IN</h2>
            <form method="post" action="process_login.php">
                <label>Email/Username</label>
                <input type="email" name="email" required>
                <label>Password</label>
                <div class="password-container">
                <input type="password" id="password" name="password" required>
                <i id="togglePassword" class="fas fa-eye"></i>
                </div>
                <button type="submit" name="login">LOGIN</button>

<?php if(isset($_GET['error'])): ?>
    <div class="error-message">
        <?php
            if($_GET['error'] == 'incorrectpassword') {
                echo "The password you entered was not valid.";
            } elseif($_GET['error'] == 'nouser') {
                echo "No user found with that email address.";
            } elseif($_GET['error'] == 'inactiveaccount') {
                echo "This account is inactive.";
            } else {
                echo "An unknown error occurred. Please try again.";
            }
        ?>
    </div>
<?php endif; ?>


            </form>
        </div>
    </div>

<script>
document.getElementById('togglePassword').addEventListener('click', function (e) {
    const password = document.getElementById('password');
    if (password.type === 'password') {
        password.type = 'text';
        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
    } else {
        password.type = 'password';
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
    }
});

</script>   

</body>
</html>
