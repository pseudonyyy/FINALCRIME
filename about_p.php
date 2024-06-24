<?php
session_start(); // Start the session at the very beginning
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>CRIMELEON -  About Us</title>

<style>
@import url('https://fonts.cdnfonts.com/css/lovelo?styles=25962');
body {
font-family: 'Lovelo', sans-serif;
background-color: #0a2242;
margin: 0;
padding: 0;
}

.header {
background-color: #bbc8e6;
padding: 20px 0;
display: flex;
align-items: center;
flex-wrap: nowrap;
}

.header img {
margin-left: 15px;
max-height: 80px;
}

.brand-text {
margin-left: 10px;
font-size: 50px;
color: #0a2242;
vertical-align: middle;
}

.header a,
.dropdown img {
color: #0a2242;
text-decoration: none;
margin: 0 15px;
font-weight: bold;
font-size: 25px;
transition: color 0.3s;
vertical-align: middle;
}

.header-links {
margin-left: auto;
color: #FFFFFF; /* White text color for navigation links */
padding: 10px 20px; /* Spacing around the link text, adjust as needed */
display: inline-block; /* Allows the application of padding and margins */
text-decoration: none; /* Remove any underline from links */
transition: background-color 0.3s; /
}

/* Styles to apply when a tab is active */
.header-links a.active {
color: #0e2547; /* Blue color for the active link text */
background-color: #748199; /* Blue background with low opacity */
opacity: 90%;
padding: 10px 15px; 
border-radius: 30px; /* Rounded corners for the background, adjust as needed */
}

.header a:hover {
color: #3274bc; /* Blue color for hover effect, can be adjusted */
}

.user-name {
font-family: 'Lovelo', sans-serif; /* or 'Grandiflora One', if preferred */
color: #FFFFFF; /* Assuming the text is white based on the image */
background-color: #0a2242; /* Match the background color of the element */
margin-right: -5px; /* Adjust margin as needed */
font-weight: bold;
font-size: 20px;
padding: 10px 20px 10px 20px; /* Adjust padding to match the image */
border-radius: 20px; /* Adjust the border-radius to match the image */
display: inline-flex; /* Use flex to align text and icon */
align-items: center; /* Center the text and icon vertically */
vertical-align: middle;
box-shadow: 0 2px 5px rgba(0,0,0,0.2); /* Optional shadow for depth */
position: relative; /* Position relative to allow absolute positioning of the icon */
}


.image-section {
background-image: url('cbg.png');
background-size: cover;
background-position: center;
position: relative;
height: 400px; /* You can adjust this according to your image's height or your preference */
display: flex;
align-items: center;
justify-content: center;
}

.image-section::before {
content: "";
background-image: url('logo2.png');
opacity: 0.9;  /* Adjust for desired opacity */
position: absolute;
top: 0;
right: 0;
bottom: 0;
left: 0;
background-size: cover;
background-position: center;
z-index: -1;  /* Makes sure it's behind the text */
}

.dropdown {
position: relative;
display: inline-block;
}

.dropdown-content {
display: none;
position: absolute;
right: 0;
background-color: #bbc8e6;
min-width: 100px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
}

.dropdown-content a {
color: #0a2242;
padding: 12px 16px;
text-decoration: none;
display: block;
}

.dropdown:hover .dropdown-content {
display: block;
}
.brand-text {
margin-left: 10px;
font-size: 50px;
color: #0a2242;
vertical-align: middle;
}

.content-section {
display: flex;
padding: 100px;
padding-top: 70px; /* Increased padding at the top */
}

.logo-container img {
margin-left: 20px;  /* Move the logo a bit to the left */
max-width: 50%;
margin-top: -30px;
}

.logo-container {
flex: 1;
}

.logo-container h1 {
font-size: 64px; 
margin-top: -10px;
color: #bbc8e6;
padding-left: -2px;  /* This will move the text a bit to the right */
}
.text-container {
flex: 2;
padding-left: 20px;
}

.text-container p {
margin-top: -20px;
font-size: 23px;
color: #bbc8e6;
text-align: justify;
}

.footer {
display: flex;
justify-content: space-between;
align-items: center;
background-color: #0a2242;
padding: 45px 60px 15px 220px;  
font-size: 18px;
color: #bbc8e6; 
margin-top: -140px; /* Moves the content up */
}

.footer img {
width: 50px; /* Adjust the size of the icons */
margin-right: 10px;
vertical-align: middle;
}

.footer-left {
flex: 1;
text-align: left;
}

.footer-middle, .footer-right {
flex: 1;
display: flex;
align-items: center;
}

.footer-right span {
text-align: right;
display: block;
}

.footer-bottom {
background-color: #0a2242;
text-align: center;
padding: 10px 0;
color: #bbc8e6;
margin-top: 12px; /* Moves the content up */
margin-right: 10px; /* Moves the content to the right */
}


</style>

    </head>
    <body>

    <div class="header">
        <img src="logo2.png" alt="Logo">
        <span class="brand-text">CRIMELEON</span>
        <div class="header-links">
            <a href="police.php">HOME</a>
            <a href="index_police.php">MAP</a>
            <!-- <a href="form.php">FORM</a> -->
            <a href="record.php">REPORT</a>
            <a href="about_p.php" class="active">ABOUT US</a>
            <span class="user-name"><?php echo htmlspecialchars($_SESSION['firstname'] . " " . $_SESSION['lastname']); ?></span>
            <div class="dropdown">
                <img src="logout.png" alt="Logout Icon" style="cursor: pointer; width: 50px; height: 50px;">
                <div class="dropdown-content">
                    <a href="logout.php">LOGOUT</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-section">
        <div class="logo-container">
            <img src="logo3.png" alt="Logo" style="max-width: 70%;">
            <h1>CRIMELEON</h1>
        </div>
        <div class="text-container">
            <p>The CriMeleon: Citizen's Complaints report management system is a web-based system that provides a facility for report with reporting crimes, complaints, missing person and wanted person details. It enables the general public to hold law enforcement officials responsible for their acts, identify patterns of misconduct within law enforcement agencies, reduce crime, and gain a more complete knowledge of the needs and concerns of the community by combining citizen complaints with crime profile data. This system can contribute to increasing accountability and transparency, identify patterns of misconduct within law enforcement agencies, reduce crime, and enhance public safety. A citizen's complaint system can help law enforcement authorities better understand community needs and concerns by enabling residents to report instances of misconduct or inappropriate behavior.</p>
            <p>CriMeleon: Citizen's Complaints report management system can serve to enhance public safety, increase openness and accountability, and improve the efficiency of law enforcement organizations.</p>
        </div>
    </div>
    <div class="footer">
        <div class="footer-left">
            Iloilo City Police Station 2<br>
            21 Huervana Street, La Paz<br>
            Iloilo City, Philippines 5000
        </div>
        <div class="footer-middle">
            <img src="call.png" alt="Phone Icon">
            <span>
                (033) 329 0904<br>
                +639985986244
            </span>
        </div>
        <div class="footer-right">
            <img src="email.png" alt="Email Icon">
            <span>
                cps2lapaz@pnp.gov.ph
            </span>
        </div>
    </div>
    <div class="footer-bottom">
        © 2023 CRIMELEON.PNP. All Rights Reserved | Terms of Use | Privacy Policy
    </div>



    </body>
    </html> 
            
