<?php
session_start();
// Include your database configuration file
require 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $conn->prepare("UPDATE report SET 
            a_family_name = ?, a_first_name = ?, a_middle_name = ?, 
            a_qualifier = ?, a_nickname = ?, a_citizenship = ?, 
            a_gender = ?, a_civil_status = ?, a_date_of_birth = ?, 
            a_age = ?, a_place_of_birth = ?, a_home_phone = ?, 
            a_mobile_phone = ?, a_current_address = ?, 
            a_village_sitio_current = ?, a_barangay_current = ?, 
            a_town_city_current = ?, a_province_current = ?, 
            a_other_address = ?, a_village_sitio_other = ?, 
            a_barangay_other = ?, a_town_city_other = ?, 
            a_province_other = ?, a_highest_educational_attainment = ?, 
            a_occupation = ?, a_id_card_presented = ?, 
            a_email_address = ?, b_family_name = ?, 
            b_first_name = ?, b_middle_name = ?, b_qualifier = ?, 
            b_nickname = ?, b_citizenship = ?, b_gender = ?, 
            b_civil_status = ?, b_date_of_birth = ?, b_age = ?, 
            b_place_of_birth = ?, b_home_phone = ?, b_mobile_phone = ?, 
            b_current_address = ?, b_village_sitio_current = ?, 
            b_barangay_current = ?, b_town_city_current = ?, 
            b_province_current = ?, b_other_address = ?, 
            b_village_sitio_other = ?, b_barangay_other = ?, 
            b_town_city_other = ?, b_province_other = ?, 
            b_highest_educational_attainment = ?, b_occupation = ?, 
            b_id_card_presented = ?, b_email_address = ?, 
            b_rank = ?, b_unit_assignment = ?, b_group_affiliation = ?, 
            b_criminal_record = ?, b_status_of_previous_case = ?, 
            b_height = ?, b_weight = ?, b_built = ?, 
            b_color_of_eyes = ?, b_description_of_eyes = ?, 
            b_color_of_hair = ?, b_description_of_hair = ?, 
            b_guardian_name = ?, b_guardian_address = ?, 
            b_guardian_home_phone = ?, b_guardian_mobile_phone = ?, 
            c_family_name = ?, c_first_name = ?, c_middle_name = ?, 
            c_qualifier = ?, c_nickname = ?, c_citizenship = ?, 
            c_gender = ?, c_civil_status = ?, c_date_of_birth = ?, 
            c_age = ?, c_place_of_birth = ?, c_home_phone = ?, 
            c_mobile_phone = ?, c_current_address = ?, 
            c_village_sitio_current = ?, c_barangay_current = ?, 
            c_town_city_current = ?, c_province_current = ?, 
            c_other_address = ?, c_village_sitio_other = ?, 
            c_barangay_other = ?, c_town_city_other = ?, 
            c_province_other = ?, c_highest_educational_attainment = ?, 
            c_occupation = ?, c_id_card_presented = ?, 
            c_email_address = ?, type_of_incident = ?, 
            datetime_of_incident = ?, datetime_reported = ?, 
            place_of_incident = ?, narrative = ?,
            administering_officer = ?, rank_name_of_desk_officer = ?,
            blotter_number = ?, police_station_name = ?,
            investigator_on_case = ?, chief_head_of_office = ?
             WHERE data_id = ?");

        // Assuming all fields are strings; change the types accordingly if not
        $stmt->bind_param("ssssssssiisssssssssssssssssssssssssiisssssssssssssssssssssssssssssssssssssssssiissssssssssssssssssssssssssssi", 
        $_POST['a_family_name'], 
        $_POST['a_first_name'], 
        $_POST['a_middle_name'], 
        $_POST['a_qualifier'], 
        $_POST['a_nickname'], 
        $_POST['a_citizenship'], 
        $_POST['a_gender'], 
        $_POST['a_civil_status'], 
        $_POST['a_date_of_birth'], 
        $_POST['a_age'], 
        $_POST['a_place_of_birth'], 
        $_POST['a_home_phone'], 
        $_POST['a_mobile_phone'], 
        $_POST['a_current_address'], 
        $_POST['a_village_sitio_current'], 
        $_POST['a_barangay_current'], 
        $_POST['a_town_city_current'], 
        $_POST['a_province_current'], 
        $_POST['a_other_address'], 
        $_POST['a_village_sitio_other'], 
        $_POST['a_barangay_other'], 
        $_POST['a_town_city_other'], 
        $_POST['a_province_other'], 
        $_POST['a_highest_educational_attainment'], 
        $_POST['a_occupation'], 
        $_POST['a_id_card_presented'], 
        $_POST['a_email_address'], 
        $_POST['b_family_name'], 
        $_POST['b_first_name'], 
        $_POST['b_middle_name'], 
        $_POST['b_qualifier'], 
        $_POST['b_nickname'], 
        $_POST['b_citizenship'], 
        $_POST['b_gender'], 
        $_POST['b_civil_status'], 
        $_POST['b_date_of_birth'], 
        $_POST['b_age'], 
        $_POST['b_place_of_birth'], 
        $_POST['b_home_phone'], 
        $_POST['b_mobile_phone'], 
        $_POST['b_current_address'], 
        $_POST['b_village_sitio_current'], 
        $_POST['b_barangay_current'], 
        $_POST['b_town_city_current'], 
        $_POST['b_province_current'], 
        $_POST['b_other_address'], 
        $_POST['b_village_sitio_other'], 
        $_POST['b_barangay_other'], 
        $_POST['b_town_city_other'], 
        $_POST['b_province_other'], 
        $_POST['b_highest_educational_attainment'], 
        $_POST['b_occupation'], 
        $_POST['b_id_card_presented'], 
        $_POST['b_email_address'], 
        $_POST['b_rank'], 
        $_POST['b_unit_assignment'], 
        $_POST['b_group_affiliation'], 
        $_POST['b_criminal_record'], 
        $_POST['b_status_of_previous_case'], 
        $_POST['b_height'], 
        $_POST['b_weight'], 
        $_POST['b_built'], 
        $_POST['b_color_of_eyes'], 
        $_POST['b_description_of_eyes'], 
        $_POST['b_color_of_hair'], 
        $_POST['b_description_of_hair'], 
        $_POST['b_guardian_name'], 
        $_POST['b_guardian_address'], 
        $_POST['b_guardian_home_phone'], 
        $_POST['b_guardian_mobile_phone'], 
        $_POST['c_family_name'], 
        $_POST['c_first_name'], 
        $_POST['c_middle_name'], 
        $_POST['c_qualifier'], 
        $_POST['c_nickname'], 
        $_POST['c_citizenship'], 
        $_POST['c_gender'], 
        $_POST['c_civil_status'], 
        $_POST['c_date_of_birth'], 
        $_POST['c_age'], 
        $_POST['c_place_of_birth'], 
        $_POST['c_home_phone'], 
        $_POST['c_mobile_phone'], 
        $_POST['c_current_address'], 
        $_POST['c_village_sitio_current'], 
        $_POST['c_barangay_current'], 
        $_POST['c_town_city_current'], 
        $_POST['c_province_current'], 
        $_POST['c_other_address'], 
        $_POST['c_village_sitio_other'], 
        $_POST['c_barangay_other'], 
        $_POST['c_town_city_other'], 
        $_POST['c_province_other'], 
        $_POST['c_highest_educational_attainment'], 
        $_POST['c_occupation'], 
        $_POST['c_id_card_presented'], 
        $_POST['c_email_address'], 
        $_POST['type_of_incident'], 
        $_POST['datetime_of_incident'], 
        $_POST['datetime_reported'], 
        $_POST['place_of_incident'], 
        $_POST['narrative'], 
        $_POST['administering_officer'], 
        $_POST['rank_name_of_desk_officer'], 
        $_POST['blotter_number'], 
        $_POST['police_station_name'], 
        $_POST['investigator_on_case'], 
        $_POST['chief_head_of_office'], 
        $id);

        if ($stmt->execute()) {
            header("Location: record.php");
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Retrieve the record from the database for editing
        $selectSql = "SELECT * FROM report WHERE data_id = $id";
        $result = $conn->query($selectSql);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // You can use $row to populate the form fields for editing
        } else {
            echo "Record not found.";
        }
    }
}

// Close connection
$conn->close();
?>
<!-- HTML form for editing -->
<!DOCTYPE html>
<html>
<head>
    <title>CRIMELEON - User Management</title>
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
        }

        .header a:hover {
            color: #007bff; /* Blue color for hover effect, can be adjusted */
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


        .dashboard {
            text-align: right;
            padding: 10px;
        }

        .dashboard a {
            text-decoration: none;
            margin: 0 10px;
            color: #51a1e3;
        }

        .content {
            max-width: 1900px;
            margin: 40px auto;
            background: #c3d1e9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .content h2, .content h3 {
            color: #0a2242;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table, th, td {
            border: 1px solid #e0e0e0;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #0a2242;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #c3d1e9 ;
        }

        .user-name {
        color: #0a2242;
        margin: 0 15px;
        font-weight: bold;
        font-size: 25px;
        vertical-align: middle;
        }

    


    </style>
</head>
<body>
<div class="header">
    <img src="logo2.png" alt="Logo">
    <span class="brand-text">CRIMELEON</span>
    <div class="header-links">
        <a href="police.php">HOME</a>
        <a href="form.php">FORM</a>
        <a href="record.php">RECORD</a>
        <a href="about.php">ABOUT US</a>
        <span class="user-name"><?php echo htmlspecialchars($_SESSION['firstname'] . " " . $_SESSION['lastname']); ?></span>
        <div class="dropdown">
            <img src="logout.png" alt="Logout Icon" style="cursor: pointer; width: 50px; height: 50px;">
            <div class="dropdown-content">
                <a href="logout.php">LOGOUT</a>
            </div>
        </div>
    </div>
</div>
</head>
<body>
<div class="content">
    <h1>Edit Record</h1>
<h2>RECORD</h2> 
    <form method="POST" action="">
        <div class="form-group">
            <label for="type_of_incident">Type of Incident:</label>
            <input type="text" id="type_of_incident" name="type_of_incident" value="<?php echo $row['type_of_incident']; ?>">
        </div>
        <div class="form-group">
            <label for="datetime_of_incident">Date and Time of Incident:</label>
            <input type="text" id="datetime_of_incident" name="datetime_of_incident" value="<?php echo $row['datetime_of_incident']; ?>">
        </div>
        <div class="form-group">
            <label for="datetime_reported">Date and Time Reported:</label>
            <input type="text" id="datetime_reported" name="datetime_reported" value="<?php echo $row['datetime_reported']; ?>">
        </div>
        <div class="form-group">
            <label for="place_of_incident">Place of Incident:</label>
            <input type="text" id="place_of_incident" name="place_of_incident" value="<?php echo $row['place_of_incident']; ?>">
        </div>

<h2>ITEM "A" - REPORTING PERSON</h2>    
            <div class="form-group">
                <label for="a_family_name">Family Name:</label>
                <input type="text" id="a_family_name" name="a_family_name" value="<?php echo $row['a_family_name']; ?>">
            </div>
            <div class="form-group">
                <label for="a_first_name">First Name:</label>
                <input type="text" id="a_first_name" name="a_first_name" value="<?php echo $row['a_first_name']; ?>">
            </div>
            <div class="form-group">
                <label for="a_middle_name">Middle Name:</label>
                <input type="text" id="a_middle_name" name="a_middle_name" value="<?php echo $row['a_middle_name']; ?>">
            </div>
            <div class="form-group">
                <label for="a_qualifier">Qualifier:</label>
                <input type="text" id="a_qualifier" name="a_qualifier" value="<?php echo $row['a_qualifier']; ?>">
            </div>
            <div class="form-group">
                <label for="a_nickname">Nickname:</label>
                <input type="text" id="a_nickname" name="a_nickname" value="<?php echo $row['a_nickname']; ?>">
            </div>
            <div class="form-group">
                <label for="a_citizenship">Citizenship:</label>
                <input type="text" id="a_citizenship" name="a_citizenship" value="<?php echo $row['a_citizenship']; ?>">
            </div>
            <div class="form-group">
                <label for="a_gender">Gender:</label>
                <input type="text" id="a_gender" name="a_gender" value="<?php echo $row['a_gender']; ?>">
            </div>
            <div class="form-group">
                <label for="a_civil_status">Civil Status:</label>
                <input type="text" id="a_civil_status" name="a_civil_status" value="<?php echo $row['a_civil_status']; ?>">
            </div>
            <div class="form-group">
                <label for="a_date_of_birth">Date of Birth:</label>
                <input type="text" id="a_date_of_birth" name="a_date_of_birth" value="<?php echo $row['a_date_of_birth']; ?>">
            </div>
            <div class="form-group">
                <label for="a_age">Age:</label>
                <input type="text" id="a_age" name="a_age" value="<?php echo $row['a_age']; ?>">
            </div>
            <div class="form-group">
                <label for="a_place_of_birth">Place of Birth:</label>
                <input type="text" id="a_place_of_birth" name="a_place_of_birth" value="<?php echo $row['a_place_of_birth']; ?>">
            </div>
            <div class="form-group">
                <label for="a_home_phone">Home Phone:</label>
                <input type="text" id="a_home_phone" name="a_home_phone" value="<?php echo $row['a_home_phone']; ?>">
            </div>
            <div class="form-group">
                <label for="a_mobile_phone">Mobile Phone:</label>
                <input type="text" id="a_mobile_phone" name="a_mobile_phone" value="<?php echo $row['a_mobile_phone']; ?>">
            </div>
            <div class="form-group">
                <label for="a_current_address">Current Address:</label>
                <input type="text" id="a_current_address" name="a_current_address" value="<?php echo $row['a_current_address']; ?>">
            </div>
            <div class="form-group">
                <label for="a_village_sitio_current">Village/Sitio (Current):</label>
                <input type="text" id="a_village_sitio_current" name="a_village_sitio_current" value="<?php echo $row['a_village_sitio_current']; ?>">
            </div>
            <div class="form-group">
                <label for="a_barangay_current">Barangay (Current):</label>
                <input type="text" id="a_barangay_current" name="a_barangay_current" value="<?php echo $row['a_barangay_current']; ?>">
            </div>
            <div class="form-group">
                <label for="a_town_city_current">Town/City (Current):</label>
                <input type="text" id="a_town_city_current" name="a_town_city_current" value="<?php echo $row['a_town_city_current']; ?>">
            </div>
            <div class="form-group">
                <label for="a_province_current">Province (Current):</label>
                <input type="text" id="a_province_current" name="a_province_current" value="<?php echo $row['a_province_current']; ?>">
            </div>
            <div class="form-group">
                <label for="a_other_address">Other Address:</label>
                <input type="text" id="a_other_address" name="a_other_address" value="<?php echo $row['a_other_address']; ?>">
            </div>
            <div class="form-group">
                <label for="a_village_sitio_other">Village/Sitio (Other):</label>
                <input type="text" id="a_village_sitio_other" name="a_village_sitio_other" value="<?php echo $row['a_village_sitio_other']; ?>">
            </div>
            <div class="form-group">
                <label for="a_barangay_other">Barangay (Other):</label>
                <input type="text" id="a_barangay_other" name="a_barangay_other" value="<?php echo $row['a_barangay_other']; ?>">
            </div>
            <div class="form-group">
                <label for="a_town_city_other">Town/City (Other):</label>
                <input type="text" id="a_town_city_other" name="a_town_city_other" value="<?php echo $row['a_town_city_other']; ?>">
            </div>
            <div class="form-group">
                <label for="a_province_other">Province (Other):</label>
                <input type="text" id="a_province_other" name="a_province_other" value="<?php echo $row['a_province_other']; ?>">
            </div>
            <div class="form-group">
                <label for="a_highest_educational_attainment">Highest Educational Attainment:</label>
                <input type="text" id="a_highest_educational_attainment" name="a_highest_educational_attainment" value="<?php echo $row['a_highest_educational_attainment']; ?>">
            </div>
            <div class="form-group">
                <label for="a_occupation">Occupation:</label>
                <input type="text" id="a_occupation" name="a_occupation" value="<?php echo $row['a_occupation']; ?>">
            </div>
            <div class="form-group">
                <label for="a_id_card_presented">ID Card Presented:</label>
                <input type="text" id="a_id_card_presented" name="a_id_card_presented" value="<?php echo $row['a_id_card_presented']; ?>">
            </div>
            <div class="form-group">
                <label for="a_email_address">Email Address:</label>
                <input type="text" id="a_email_address" name="a_email_address" value="<?php echo $row['a_email_address']; ?>">
            </div>


<h2>ITEM "B" - SUSPECT'S DATA</h2>
        <div class="form-group">
            <label for="b_family_name">Family Name:</label>
            <input type="text" id="b_family_name" name="b_family_name" value="<?php echo $row['b_family_name']; ?>">
        </div>
        <div class="form-group">
            <label for="b_first_name">First Name:</label>
            <input type="text" id="b_first_name" name="b_first_name" value="<?php echo $row['b_first_name']; ?>">
        </div>
        <div class="form-group">
            <label for="b_middle_name">Middle Name:</label>
            <input type="text" id="b_middle_name" name="b_middle_name" value="<?php echo $row['b_middle_name']; ?>">
        </div>
        <div class="form-group">
            <label for="b_qualifier">Qualifier:</label>
            <input type="text" id="b_qualifier" name="b_qualifier" value="<?php echo $row['b_qualifier']; ?>">
        </div>
        <div class="form-group">
            <label for="b_nickname">Nickname:</label>
            <input type="text" id="b_nickname" name="b_nickname" value="<?php echo $row['b_nickname']; ?>">
        </div>
        <div class="form-group">
            <label for="b_citizenship">Citizenship:</label>
            <input type="text" id="b_citizenship" name="b_citizenship" value="<?php echo $row['b_citizenship']; ?>">
        </div>
        <div class="form-group">
            <label for="b_gender">Gender:</label>
            <input type="text" id="b_gender" name="b_gender" value="<?php echo $row['b_gender']; ?>">
        </div>
        <div class="form-group">
            <label for="b_civil_status">Civil Status:</label>
            <input type="text" id="b_civil_status" name="b_civil_status" value="<?php echo $row['b_civil_status']; ?>">
        </div>
        <div class="form-group">
            <label for="b_date_of_birth">Date of Birth:</label>
            <input type="text" id="b_date_of_birth" name="b_date_of_birth" value="<?php echo $row['b_date_of_birth']; ?>">
        </div>
        <div class="form-group">
            <label for="b_age">Age:</label>
            <input type="text" id="b_age" name="b_age" value="<?php echo $row['b_age']; ?>">
        </div>
        <div class="form-group">
            <label for="b_place_of_birth">Place of Birth:</label>
            <input type="text" id="b_place_of_birth" name="b_place_of_birth" value="<?php echo $row['b_place_of_birth']; ?>">
        </div>
        <div class="form-group">
            <label for="b_home_phone">Home Phone:</label>
            <input type="text" id="b_home_phone" name="b_home_phone" value="<?php echo $row['b_home_phone']; ?>">
        </div>
        <div class="form-group">
            <label for="b_mobile_phone">Mobile Phone:</label>
            <input type="text" id="b_mobile_phone" name="b_mobile_phone" value="<?php echo $row['b_mobile_phone']; ?>">
        </div>
        <div class="form-group">
            <label for="b_current_address">Current Address:</label>
            <input type="text" id="b_current_address" name="b_current_address" value="<?php echo $row['b_current_address']; ?>">
        </div>
        <div class="form-group">
            <label for="b_village_sitio_current">Village/Sitio (Current):</label>
            <input type="text" id="b_village_sitio_current" name="b_village_sitio_current" value="<?php echo $row['b_village_sitio_current']; ?>">
        </div>
        <div class="form-group">
            <label for="b_barangay_current">Barangay (Current):</label>
            <input type="text" id="b_barangay_current" name="b_barangay_current" value="<?php echo $row['b_barangay_current']; ?>">
        </div>
        <div class="form-group">
            <label for="b_town_city_current">Town/City (Current):</label>
            <input type="text" id="b_town_city_current" name="b_town_city_current" value="<?php echo $row['b_town_city_current']; ?>">
        </div>
        <div class="form-group">
            <label for="b_province_current">Province (Current):</label>
            <input type="text" id="b_province_current" name="b_province_current" value="<?php echo $row['b_province_current']; ?>">
        </div>
        <div class="form-group">
            <label for="b_other_address">Other Address:</label>
            <input type="text" id="b_other_address" name="b_other_address" value="<?php echo $row['b_other_address']; ?>">
        </div>
        <div class="form-group">
            <label for="b_village_sitio_other">Village/Sitio (Other):</label>
            <input type="text" id="b_village_sitio_other" name="b_village_sitio_other" value="<?php echo $row['b_village_sitio_other']; ?>">
        </div>
        <div class="form-group">
            <label for="b_barangay_other">Barangay (Other):</label>
            <input type="text" id="b_barangay_other" name="b_barangay_other" value="<?php echo $row['b_barangay_other']; ?>">
        </div>
        <div class="form-group">
            <label for="b_town_city_other">Town/City (Other):</label>
            <input type="text" id="b_town_city_other" name="b_town_city_other" value="<?php echo $row['b_town_city_other']; ?>">
        </div>
        <div class="form-group">
            <label for="b_province_other">Province (Other):</label>
            <input type="text" id="b_province_other" name="b_province_other" value="<?php echo $row['b_province_other']; ?>">
        </div>
        <div class="form-group">
            <label for="b_highest_educational_attainment">Highest Educational Attainment:</label>
            <input type="text" id="b_highest_educational_attainment" name="b_highest_educational_attainment" value="<?php echo $row['b_highest_educational_attainment']; ?>">
        </div>
        <div class="form-group">
            <label for="b_occupation">Occupation:</label>
            <input type="text" id="b_occupation" name="b_occupation" value="<?php echo $row['b_occupation']; ?>">
        </div>
        <div class="form-group">
            <label for="b_id_card_presented">ID Card Presented:</label>
            <input type="text" id="b_id_card_presented" name="b_id_card_presented" value="<?php echo $row['b_id_card_presented']; ?>">
        </div>
        <div class="form-group">
            <label for="b_email_address">Email Address:</label>
            <input type="text" id="b_email_address" name="b_email_address" value="<?php echo $row['b_email_address']; ?>">
        </div>
        <div class="form-group">
            <label for="b_rank">Rank:</label>
            <input type="text" id="b_rank" name="b_rank" value="<?php echo $row['b_rank']; ?>">
        </div>
        <div class="form-group">
            <label for="b_unit_assignment">Unit Assignment:</label>
            <input type="text" id="b_unit_assignment" name="b_unit_assignment" value="<?php echo $row['b_unit_assignment']; ?>">
        </div>
        <div class="form-group">
            <label for="b_group_affiliation">Group Affiliation:</label>
            <input type="text" id="b_group_affiliation" name="b_group_affiliation" value="<?php echo $row['b_group_affiliation']; ?>">
        </div>
        <div class="form-group">
            <label for="b_criminal_record">Criminal Record:</label>
            <input type="text" id="b_criminal_record" name="b_criminal_record" value="<?php echo $row['b_criminal_record']; ?>">
        </div>
        <div class="form-group">
            <label for="b_status_of_previous_case">Status of Previous Case:</label>
            <input type="text" id="b_status_of_previous_case" name="b_status_of_previous_case" value="<?php echo $row['b_status_of_previous_case']; ?>">
        </div>
        <div class="form-group">
            <label for="b_height">Height:</label>
            <input type="text" id="b_height" name="b_height" value="<?php echo $row['b_height']; ?>">
        </div>
        <div class="form-group">
            <label for="b_weight">Weight:</label>
            <input type="text" id="b_weight" name="b_weight" value="<?php echo $row['b_weight']; ?>">
        </div>
        <div class="form-group">
            <label for="b_built">Built:</label>
            <input type="text" id="b_built" name="b_built" value="<?php echo $row['b_built']; ?>">
        </div>
        <div class="form-group">
            <label for="b_color_of_eyes">Color of Eyes:</label>
            <input type="text" id="b_color_of_eyes" name="b_color_of_eyes" value="<?php echo $row['b_color_of_eyes']; ?>">
        </div>
        <div class="form-group">
            <label for="b_description_of_eyes">Description of Eyes:</label>
            <input type="text" id="b_description_of_eyes" name="b_description_of_eyes" value="<?php echo $row['b_description_of_eyes']; ?>">
        </div>
        <div class="form-group">
            <label for="b_color_of_hair">Color of Hair:</label>
            <input type="text" id="b_color_of_hair" name="b_color_of_hair" value="<?php echo $row['b_color_of_hair']; ?>">
        </div>
        <div class="form-group">
            <label for="b_description_of_hair">Description of Hair:</label>
            <input type="text" id="b_description_of_hair" name="b_description_of_hair" value="<?php echo $row['b_description_of_hair']; ?>">
        </div>


<h2>FOR CHILDREN IN CONFLICT WITH THE LAW</h2>
        <div class="form-group">
            <label for="b_guardian_name">Guardian Name:</label>
            <input type="text" id="b_guardian_name" name="b_guardian_name" value="<?php echo $row['b_guardian_name']; ?>">
        </div>
        <div class="form-group">
            <label for="b_guardian_address">Guardian Address:</label>
            <input type="text" id="b_guardian_address" name="b_guardian_address" value="<?php echo $row['b_guardian_address']; ?>">
        </div>
        <div class="form-group">
            <label for="b_guardian_home_phone">Guardian Home Phone:</label>
            <input type="text" id="b_guardian_home_phone" name="b_guardian_home_phone" value="<?php echo $row['b_guardian_home_phone']; ?>">
        </div>
        <div class="form-group">
            <label for="b_guardian_mobile_phone">Guardian Mobile Phone:</label>
            <input type="text" id="b_guardian_mobile_phone" name="b_guardian_mobile_phone" value="<?php echo $row['b_guardian_mobile_phone']; ?>">
        </div>

<h2>ITEM “C” – VICTIM’S DATA</h2>
        <div class="form-group">
            <label for="c_family_name">Family Name:</label>
            <input type="text" id="c_family_name" name="c_family_name" value="<?php echo $row['c_family_name']; ?>">
        </div>
        <div class="form-group">
            <label for="c_first_name">First Name:</label>
            <input type="text" id="c_first_name" name="c_first_name" value="<?php echo $row['c_first_name']; ?>">
        </div>
        <div class="form-group">
            <label for="c_middle_name">Middle Name:</label>
            <input type="text" id="c_middle_name" name="c_middle_name" value="<?php echo $row['c_middle_name']; ?>">
        </div>
        <div class="form-group">
            <label for="c_qualifier">Qualifier:</label>
            <input type="text" id="c_qualifier" name="c_qualifier" value="<?php echo $row['c_qualifier']; ?>">
        </div>
        <div class="form-group">
            <label for="c_nickname">Nickname:</label>
            <input type="text" id="c_nickname" name="c_nickname" value="<?php echo $row['c_nickname']; ?>">
        </div>
        <div class="form-group">
            <label for="c_citizenship">Citizenship:</label>
            <input type="text" id="c_citizenship" name="c_citizenship" value="<?php echo $row['c_citizenship']; ?>">
        </div>
        <div class="form-group">
            <label for="c_gender">Gender:</label>
            <input type="text" id="c_gender" name="c_gender" value="<?php echo $row['c_gender']; ?>">
        </div>
        <div class="form-group">
            <label for="c_civil_status">Civil Status:</label>
            <input type="text" id="c_civil_status" name="c_civil_status" value="<?php echo $row['c_civil_status']; ?>">
        </div>
        <div class="form-group">
            <label for="c_date_of_birth">Date of Birth:</label>
            <input type="text" id="c_date_of_birth" name="c_date_of_birth" value="<?php echo $row['c_date_of_birth']; ?>">
        </div>
        <div class="form-group">
            <label for="c_age">Age:</label>
            <input type="text" id="c_age" name="c_age" value="<?php echo $row['c_age']; ?>">
        </div>
        <div class="form-group">
            <label for="c_place_of_birth">Place of Birth:</label>
            <input type="text" id="c_place_of_birth" name="c_place_of_birth" value="<?php echo $row['c_place_of_birth']; ?>">
        </div>
        <div class="form-group">
            <label for="c_home_phone">Home Phone:</label>
            <input type="text" id="c_home_phone" name="c_home_phone" value="<?php echo $row['c_home_phone']; ?>">
        </div>
        <div class="form-group">
            <label for="c_mobile_phone">Mobile Phone:</label>
            <input type="text" id="c_mobile_phone" name="c_mobile_phone" value="<?php echo $row['c_mobile_phone']; ?>">
        </div>
        <div class="form-group">
            <label for="c_current_address">Current Address:</label>
            <input type="text" id="c_current_address" name="c_current_address" value="<?php echo $row['c_current_address']; ?>">
        </div>
        <div class="form-group">
            <label for="c_village_sitio_current">Village/Sitio (Current):</label>
            <input type="text" id="c_village_sitio_current" name="c_village_sitio_current" value="<?php echo $row['c_village_sitio_current']; ?>">
        </div>
        <div class="form-group">
            <label for="c_barangay_current">Barangay (Current):</label>
            <input type="text" id="c_barangay_current" name="c_barangay_current" value="<?php echo $row['c_barangay_current']; ?>">
        </div>
        <div class="form-group">
            <label for="c_town_city_current">Town/City (Current):</label>
            <input type="text" id="c_town_city_current" name="c_town_city_current" value="<?php echo $row['c_town_city_current']; ?>">
        </div>
        <div class="form-group">
            <label for="c_province_current">Province (Current):</label>
            <input type="text" id="c_province_current" name="c_province_current" value="<?php echo $row['c_province_current']; ?>">
        </div>
        <div class="form-group">
            <label for="c_other_address">Other Address:</label>
            <input type="text" id="c_other_address" name="c_other_address" value="<?php echo $row['c_other_address']; ?>">
        </div>
        <div class="form-group">
            <label for="c_village_sitio_other">Village/Sitio (Other):</label>
            <input type="text" id="c_village_sitio_other" name="c_village_sitio_other" value="<?php echo $row['c_village_sitio_other']; ?>">
        </div>
        <div class="form-group">
            <label for="c_barangay_other">Barangay (Other):</label>
            <input type="text" id="c_barangay_other" name="c_barangay_other" value="<?php echo $row['c_barangay_other']; ?>">
        </div>
        <div class="form-group">
            <label for="c_town_city_other">Town/City (Other):</label>
            <input type="text" id="c_town_city_other" name="c_town_city_other" value="<?php echo $row['c_town_city_other']; ?>">
        </div>
        <div class="form-group">
            <label for="c_province_other">Province (Other):</label>
            <input type="text" id="c_province_other" name="c_province_other" value="<?php echo $row['c_province_other']; ?>">
        </div>
        <div class="form-group">
            <label for="c_highest_educational_attainment">Highest Educational Attainment:</label>
            <input type="text" id="c_highest_educational_attainment" name="c_highest_educational_attainment" value="<?php echo $row['c_highest_educational_attainment']; ?>">
        </div>
        <div class="form-group">
            <label for="c_occupation">Occupation:</label>
            <input type="text" id="c_occupation" name="c_occupation" value="<?php echo $row['c_occupation']; ?>">
        </div>
        <div class="form-group">
            <label for="c_id_card_presented">ID Card Presented:</label>
            <input type="text" id="c_id_card_presented" name="c_id_card_presented" value="<?php echo $row['c_id_card_presented']; ?>">
        </div>
        <div class="form-group">
            <label for="c_email_address">Email Address:</label>
            <input type="text" id="c_email_address" name="c_email_address" value="<?php echo $row['c_email_address']; ?>">
        </div>
    <h2>ITEM “D” – NARRATIVE</h2>
        <div class="form-group">
            <label for="narrative">Narrative:</label>
            <input type="text" id="narrative" name="narrative" value="<?php echo $row['narrative']; ?>">
        </div>
        <div class="form-group">
            <label for="administering_officer">Administering Officer:</label>
            <input type="text" id="administering_officer" name="administering_officer" value="<?php echo $row['administering_officer']; ?>">
        </div>
        <div class="form-group">
            <label for="rank_name_of_desk_officer">Rank Name of Desk Officer:</label>
            <input type="text" id="rank_name_of_desk_officer" name="rank_name_of_desk_officer" value="<?php echo $row['rank_name_of_desk_officer']; ?>">
        </div>
        <div class="form-group">
            <label for="blotter_number">Blotter Number:</label>
            <input type="text" id="blotter_number" name="blotter_number" value="<?php echo $row['blotter_number']; ?>">
        </div>
        <div class="form-group">
            <label for="police_station_name">Police Station Name:</label>
            <input type="text" id="police_station_name" name="police_station_name" value="<?php echo $row['police_station_name']; ?>">
        </div>
        <div class="form-group">
            <label for="investigator_on_case">Investigator on Case:</label>
            <input type="text" id="investigator_on_case" name="investigator_on_case" value="<?php echo $row['investigator_on_case']; ?>">
        </div>
        <div class="form-group">
            <label for="chief_head_of_office">Chief Head of Office:</label>
            <input type="text" id="chief_head_of_office" name="chief_head_of_office" value="<?php echo $row['chief_head_of_office']; ?>">
        </div>

        <div class="form-group">
            <button type="submit" name="submit">Update Record</button>
        </div>
    </form>
</div>
        </form>
    </div>
</body>
</html>
