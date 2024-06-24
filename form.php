<?php
session_start();

// Database connection details
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

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign posted values to variables
    $family_name = $_POST['family_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $qualifier = $_POST['qualifier'];
    $nickname = $_POST['nickname'];
    $citizenship = $_POST['citizenship'];
    $sex = $_POST['sex'];
    $civil_status = $_POST['civil_status'];
    $doBirth = $_POST['doBirth'];
    $age = $_POST['age'];
    $poBirth = $_POST['poBirth'];
    $hPhone = $_POST['hPhone'];
    $mPhone = $_POST['mPhone'];
    $cHouseNo = $_POST['cHouseNo'];
    $cSitio = $_POST['cSitio'];
    $cBrgy = $_POST['cBrgy'];
    $cTown = $_POST['cTown'];
    $cProvince = $_POST['cProvince'];
    $oHouseNo = $_POST['oHouseNo'];
    $oSitio = $_POST['oSitio'];
    $oBrgy = $_POST['oBrgy'];
    $oTown = $_POST['oTown'];
    $oProvince = $_POST['oProvince'];
    $heAttain = $_POST['heAttain'];
    $occupation = $_POST['occupation'];
    $idCard = $_POST['idCard'];
    $email = $_POST['email'];

    // Check for duplicates before insertion
    $checkDuplicate = $conn->prepare("SELECT COUNT(*) FROM persons_data WHERE family_name = ? AND first_name = ? AND middle_name = ? AND doBirth = ?");
    $checkDuplicate->bind_param("ssss", $family_name, $first_name, $middle_name, $doBirth);
    $checkDuplicate->execute();
    $checkDuplicate->bind_result($count);
    $checkDuplicate->fetch();
    $checkDuplicate->close();

    if ($count > 0) {
        echo "Duplicate entry detected. Please check your input.";
    } else {
        // Prepare an INSERT statement
        $stmt = $conn->prepare("INSERT INTO persons_data (family_name, first_name, middle_name, qualifier, nickname, citizenship, sex, civil_status, doBirth, age, poBirth, hPhone, mPhone, cHouseNo, cSitio, cBrgy, cTown, cProvince, oHouseNo, oSitio, oBrgy, oTown, oProvince, heAttain, occupation, idCard, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind the variables to the statement as parameters
        $stmt->bind_param("sssssssssisssssssssssssssss", $family_name, $first_name, $middle_name, $qualifier, $nickname, $citizenship, $sex, $civil_status, $doBirth, $age, $poBirth, $hPhone, $mPhone, $cHouseNo, $cSitio, $cBrgy, $cTown, $cProvince, $oHouseNo, $oSitio, $oBrgy, $oTown, $oProvince, $heAttain, $occupation, $idCard, $email);

        // Execute the statement
        $stmt->execute();

        // Check for success/failure
        if ($stmt->affected_rows > 0) {
            $personID = $stmt->insert_id;

            // Sanitize and assign the additional form fields
            $sRank = $_POST['sRank'] ?? '';
            $sAssign = $_POST['sAssign'] ?? '';
            $sAffiliation = $_POST['sAffiliation'] ?? '';
            $sCrimRecord = $_POST['sCrimRecord'] ?? '';
            $sStatus = $_POST['sStatus'] ?? '';
            $Height = $_POST['Height'] ?? '';
            $Weight = $_POST['Weight'] ?? '';
            $eyeColor = $_POST['eyeColor'] ?? '';
            $eyeDesc = $_POST['eyeDesc'] ?? '';
            $hairColor = $_POST['hairColor'] ?? '';
            $hairDesc = $_POST['hairDesc'] ?? '';
            $sInfluence = $_POST['sInfluence'] ?? '';
            $guardian_name = $_POST['guardian_name'] ?? '';
            $g_address = $_POST['g_address'] ?? '';
            $ghome_phone = $_POST['ghome_phone'] ?? '';
            $gmob_phone = $_POST['gmob_phone'] ?? '';

            // Prepare an INSERT statement for the second table
            $stmt_b = $conn->prepare("INSERT INTO item_b (personID, sRank, sAssign, sAffiliation, sCrimRecord, sStatus, Height, Weight, eyeColor, eyeDesc, hairColor, hairDesc, sInfluence, guardian_name, g_address, ghome_phone, gmob_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Bind the variables to the statement as parameters
            $stmt_b->bind_param("issssssssssssssss", $personID, $sRank, $sAssign, $sAffiliation, $sCrimRecord, $sStatus, $Height, $Weight, $eyeColor, $eyeDesc, $hairColor, $hairDesc, $sInfluence, $guardian_name, $g_address, $ghome_phone, $gmob_phone);

            // Execute the second statement
            if ($stmt_b->execute()) {
                // Success for second table
                echo "New record created successfully in both tables";
            } else {
                // Error handling for the second table
                echo "Error inserting additional data: " . $stmt_b->error;
            }

            $stmt_b->close();
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>CRIMELEON - Records</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style> 
 @import url('https://fonts.cdnfonts.com/css/lovelo?styles=25962');

 #map {
  height: 500px;
  width: 90%;
  margin-top: 10px;
  margin-left: auto;
  margin-right: auto;
  display: none;
  background-color: #f0f0f0; /* Set the background color */
}


 #narrative {
  width: 100%; /* Makes the textarea full width of its container */
  height: 200px; /* Sets a default height */
  padding: 10px; /* Optional: Adds some padding inside the textarea */
  border: 1px solid #ccc; /* Optional: Adds a border around the textarea */
  border-radius: 4px; /* Optional: Rounds the corners of the textarea */
  box-sizing: border-box; /* Ensures padding and border are included in the width and height */
  resize: vertical; /* Allows the user to vertically resize the textarea; remove if not needed */
}

.toggle-map-container {
    display: inline-block; /* Display as inline block to keep them next to each other */
    margin-right: 10px; /* Adjust margin between the icon and the select box */
}
#toggleMapButton {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
  transition: transform 0.3s ease;
  object-fit: cover;
  position: absolute; /* Position the icon */
  top: 43%; /* Align vertically */
  transform: translateY(-50%); /* Center vertically */
  right: -0px; /* Adjust the distance from the right side */
}



#toggleMapButton:hover {
  transform: scale(1.3) translateY(-30%); /* Reduce the translateY value */
}

#toggleMapButton:active {
  transform: scale(0.9) translateY(-30%); /* Reduce the translateY value */
}



 .modal-content {
    max-width: 1000px; /* Maximum width of modal content */
    margin: 0 auto; /* Centering modal content */
    background: #fff; /* Background color for modal content */
    padding: 20px; /* Padding inside the modal content */
    padding-top: 20px; /* Adjust the padding as necessary */
    border-radius: 5px; /* Rounded corners for modal content */
    box-shadow: 0 5px 15px rgba(0,0,0,0.3); /* Shadow effect for modal content */
    overflow: auto; /* Enable scrolling if content is larger than the modal */
    box-sizing: border-box; /* Include padding and border in the width and height */
    max-height: 90vh; /* 90% of the viewport height */
  overflow-y: auto; /* Allows scrolling on the y-axis */
}


/* This is the parent container that would cover the entire screen */
.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: auto; /* Allows the modal to scroll */
  z-index: 1000; /* High z-index to ensure the modal is on top */
  background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
}


 .modal-message {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 10; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    justify-content: center;
    align-items: center;
}

.modal-content-message {
    background-color:#bbc8e6;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 30%; /* Could be more or less, depending on screen size */
    text-align: center;
}

.success-message {
    color: green;
}

.error-message {
    color: red;
}


.suggestions-container {
  display: none; /* Hidden by default */
  position: absolute;
  background-color: #0a2242;
  border: 2px solid #ddd;
  z-index: 1000;
  width: 300px; /* Adjust to match the width of your input field */
  max-height: 300px;
  overflow-y: auto; /* Enable scroll if too many items */
}

.suggestions-container div {
  padding: 10px;
  cursor: pointer;
  border-bottom: 1px solid #ddd;
}

.suggestions-container div:hover {
  background-color: #54647b;
}

    body {
        font-family: 'Lovelo', sans-serif;
        background-color: #0a2242;
        color: #ffffff;
        margin: 0;
        padding: 20;
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


    tr:hover {
    background-color: rgba(232, 232, 232, 0.4); /* 0.7 is 70% opacity */
    }

    h1 {
    font-size: 30px; /* Adjust as needed */
    color: #ffffff; /* White color for headers */
    text-align: center;
    margin-bottom: 20px;
    }


    label {
    display: inline-block; /* Aligns labels next to inputs */
    color: #ffffff; /* White text color for labels */
    margin-right: 10px; /* Space between label and input field */
    width: 140px; /* Fixed width for labels */
    text-align: left; /* Right aligns the text in the label */
    }

    input[type="text"],
    input[type="tel"],
    input[type="email"],
    input[type="date"],
    input[type="number"],
    input[type="datetime-local"],
    select, 
    textarea {
        width: 100%; /* Full width of the tab content area */
        padding: 8px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box; /* Includes padding in the width */
    }

    /* Style for the submit button */
    #submitButton {
        font-family: 'Lovelo', sans-serif;
        background-color: #bbc9eb; /* Green background for submit button */
        color: white; /* White text color for submit button */
        padding: 10px 20px;
        border: none;
        border-radius: px;
        cursor: pointer;
    }

    /* Style for the submit button on hover */
    #submitButton:hover {
        background-color: #2874a6; /* Darker green for hover effect */
    }

.notification {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    text-align: center;
    padding: 10px;
    box-shadow: 0px 2px 4px rgba(0,0,0,0.2);
    z-index: 1000;
}

.notification.success {
    background-color: #4CAF50; /* Green for success */
    color: white;
}

.notification.error {
    background-color: #f44336; /* Red for error */
    color: white;
}

html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #map {
        height: 80%;
    }
    .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
    }
    #pac-input:focus {
        border-color: #4d90fe;
    }

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0,0,0,0.8); /* Dim the background */
}

/* Modal Content */
.modal-content {
  background-color: #0a2242; /* Your form's dark blue background */
  margin: 5% auto; /* 5% from the top and centered */
  padding: 30px;
  border: 1px solid #888;
  width: 80%; /* Adjust as needed to match your form width */
  border-radius: 5px; /* Rounded corners like your form fields */
  box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Optional: Adds a shadow around the modal */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #ddd; /* Lighter grey for close button hover effect */
  text-decoration: none;
  cursor: pointer;
}

/* Input fields styling to match your form */
.modal input[type="text"],
.modal input[type="email"],
.modal input[type="number"],
.modal input[type="date"],
.modal select {
  width: 30%; /* Full width */
  padding: 10px; /* Padding for input fields */
  margin: 8px 0; /* Margin for spacing */
  display: inline-block; /* Allows elements to be inline */
  border: 1px solid #ccc; /* Border similar to your form */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Box sizing for proper padding handling */
}

/* Button styling to match your form */
.modal button { 
  background-color: #4CAF50; /* Green background */
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 100%;
}

.modal button:hover {
  background-color: #45a049; /* Darker green on hover */
}

/* Labels to match your form */
.modal label {
  color: #ffffff; /* White color to match your form's labels */
  padding: 12px 12px 12px 0;
  display: inline-block;
}

.success-message {
  color: #4CAF50; /* Green color for success */
}

.error-message {
  color: #f44336; /* Red color for errors */
}
      
</style>

<!-- FORM FIELDS -->
<style>
  .disclaimer {
    font-size: 0.9em; /* Makes the font size smaller */
    color: #a9a9a9; /* Optional: changes the color to grey */
    font-style: italic; /* Optional: makes the font italic */
}


.form-row {
  display: flex;
  justify-content: space-between;
  margin-left: 10%;
  margin-right: 10%;
  flex-wrap: wrap; /* Ensures responsiveness */
}

.form-group {
  position: relative; /* Establishes a positioning context */
  width: calc(50% - 0px); /* Adjust the width as needed, accounting for margins */
  margin-bottom: 20px; /* Spacing below each form group */
  flex-basis: 48%;
}

.form-group label {
  position: absolute; /* Absolutely position the label */
  top: -1em; /* Raise the label to the top of the input */
  left: 0; /* Align label to the left of the input */
  font-size: 0.85em; /* Smaller font size for the label */
  color: white; /* Label text color */
  white-space: nowrap; /* Keeps the text in a single line */

}

.form-group input[type="text"],
.form-group input[type="datetime-local"],
.form-group select {
  width: 89%; /* Full width of the form-group */
  padding: 10px 10px; /* Padding inside the input */
  border: 1px solid #ccc; /* Border styling */
  border-radius: 4px; /* Rounded corners */
  box-sizing: border-box; /* Box sizing to include padding and border */
}

/* Adjusts for the placeholder text color and style */
.form-group input::placeholder,
.form-group select::placeholder {
  color: #aaa; /* Placeholder text color */
  font-style: italic; /* Placeholder text style */
}

/* Additional responsive adjustments can be added as needed */
@media (max-width: 768px) {
  .form-group {
    width: 100%; /* Each form group takes full width on smaller screens */
  }
}
</style>

<!-- TABULAR -->
<style>
  /* Layout Styles */
  .tabular-form {
    display: grid;
    grid-template-columns: 250px auto; /* Fixed sidebar width and remaining space for content */
    height: 100vh;
    overflow: hidden; /* Prevents scrollbars from appearing */
}

.tabs {
    background: #0a2242;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start; /* Align tabs to the top */
}

.tab-link {
    font-family: 'Lovelo', sans-serif;
    font-size: 15px;
    background: none;
    border: none;
    padding: 10px;
    margin-bottom: 4px; /* Spacing between buttons */
    text-align: left;
    transition: background 0.3s ease;
    cursor: pointer;
    color: white;
    white-space: nowrap; /* Prevents text from wrapping */
}


.tab-link:hover,
.active-link {
    background-color: #bbcbe3; /* Highlights on hover and active */
}

.tab-content {
    background: #0a2242;
    padding: 20px;
    display: none; /* Hide content by default */
    overflow-y: auto; /* Allows scrolling within the tab content */
    border-left: 3px solid #ddd; /* Separator line between tabs and content */
}

/* Active class styles */
.active-tab {
    display: block; /* Show active tab content */
}

</style>
</head>

<div class="header">
    <img src="logo2.png" alt="Logo">
    <span class="brand-text">CRIMELEON</span>
    <div class="header-links">
        <a href="police.php">HOME</a>
        <a href="index_police.php">MAP</a>
        <!-- <a href="form.php">FORM</a> -->
        <a href="record.php" class="active">REPORT</a>
        <a href="about_p.php">ABOUT US</a>
        <span class="user-name"><?php echo htmlspecialchars($_SESSION['firstname'] . " " . $_SESSION['lastname']); ?></span>
        <div class="dropdown">
            <img src="logout.png" alt="Logout Icon" style="cursor: pointer; width: 50px; height: 50px;">
            <div class="dropdown-content">
            <a href="logout.php">LOGOUT</a>
                </div>
            </div>
        </div>
</div>

<!-- MAP -->
<script>
// Function to toggle the visibility of the map
function toggleMap() {
    var map = document.getElementById('map');
    var toggleButton = document.getElementById('toggleMapButton');
    if (map.style.display === 'none') {
        map.style.display = 'block';
        toggleButton.innerHTML = 'Close Map';
    } else {
        map.style.display = 'none';
        toggleButton.innerHTML = 'Show Map';
    }
}

</script>



<!-- SEARCH FAMILY NAME A -->
<script>
function searchFamilyName(input) {
  if (input.length < 1) {
    $('#familyNameSuggestions').hide();
    return;
  }

  $.ajax({
    url: 'search_family_name.php', // Point this to your PHP script that handles the search.
    type: 'POST',
    dataType: 'json',
    data: { query: input },
    success: function(data) {
      var suggestionsContainer = $('#familyNameSuggestions');
      suggestionsContainer.empty().show();

      data.forEach(function(item) {
        var suggestionItem = $('<div>').text(item.personID + ' - ' + item.family_name + ' - ' + item.first_name+ ' - ' + item.middle_name);
        suggestionItem.click(function() {
        $('#personID_a').val(item.personID);
        $('#family_name_a').val(item.family_name); 
        $('#autoFirstName').val(item.first_name);
        $('#autoMiddleName').val(item.middle_name);
        $('#autoQualifier').val(item.qualifier);
        $('#autoNickname').val(item.nickname);
        $('#autoCitizenship').val(item.citizenship);
        $('#autoSex').val(item.sex);
        $('#autoCivilStatus').val(item.civil_status);
        $('#autoDateOfBirth').val(item.doBirth);
        $('#autoAge').val(item.age);
        $('#autoPlaceOfBirth').val(item.poBirth);
        $('#autoHomePhone').val(item.hPhone);
        $('#autoMobilePhone').val(item.mPhone);
        $('#autoCurrentHouseNo').val(item.cHouseNo);
        $('#autoCurrentSitio').val(item.cSitio);
        $('#autoCurrentBarangay').val(item.cBrgy);
        $('#autoCurrentTown').val(item.cTown);
        $('#autoCurrentProvince').val(item.cProvince);
        $('#autoOtherHouseNo').val(item.oHouseNo);
        $('#autoOtherSitio').val(item.oSitio);
        $('#autoOtherBarangay').val(item.oBrgy);
        $('#autoOtherTown').val(item.oTown);
        $('#autoOtherProvince').val(item.oProvince);
        $('#autoHighestEducationalAttainment').val(item.heAttain);
        $('#autoOccupation').val(item.occupation);
        $('#autoIdCard').val(item.idCard);
        $('#autoEmail').val(item.email);
        $('#familyNameSuggestions').hide();
        });
        suggestionsContainer.append(suggestionItem);
      });
    },
    error: function(xhr, status, error) {
      console.error("Error in searchFamilyName: " + error);
    }
  });
}

// To hide the suggestion box if clicked outside
$(document).click(function(e) {
  if (!$(e.target).closest('#family_name').length && !$(e.target).is('#familyNameSuggestions div')) {
    $('#familyNameSuggestions').hide();
  }
});

</script>

<!-- SEARCH FAMILY NAME B -->
<script>
function searchFamilyNameB(input) {
  if (input.length < 1) {
    $('#familyNameSuggestionsB').hide();
    return;
  }

  // AJAX call to get suggestions for Item B
  $.ajax({
    url: 'search_family_name.php', // Make sure the URL points to the correct PHP file.
    type: 'POST',
    dataType: 'json',
    data: { query: input },
    success: function(data) {
      var suggestionsContainerB = $('#familyNameSuggestionsB');
      suggestionsContainerB.empty().show();

      data.forEach(function(item) {
        var suggestionItemB = $('<div>')
          .text(item.personID + ' - ' + item.family_name + ' - ' + item.first_name+ ' - ' + item.middle_name)
          .click(function() {
            // Fill the Item B fields
          $('#personID_b').val(item.personID);
          $('#family_name_b').val(item.family_name);
          $('#autoFirstNameB').val(item.first_name);
          $('#autoMiddleNameB').val(item.middle_name);
          $('#autoQualifierB').val(item.qualifier);
          $('#autoNicknameB').val(item.nickname);
          $('#autoCitizenshipB').val(item.citizenship);
          $('#autoSexB').val(item.sex);
          $('#autoCivilStatusB').val(item.civil_status);
          $('#autoDateOfBirthB').val(item.doBirth);
          $('#autoAgeB').val(item.age);
          $('#autoPlaceOfBirthB').val(item.poBirth);
          $('#autoHomePhoneB').val(item.hPhone);
          $('#autoMobilePhoneB').val(item.mPhone);
          $('#autoCurrentHouseNoB').val(item.cHouseNo);
          $('#autoCurrentSitioB').val(item.cSitio);
          $('#autoCurrentBarangayB').val(item.cBrgy);
          $('#autoCurrentTownB').val(item.cTown);
          $('#autoCurrentProvinceB').val(item.cProvince);
          $('#autoOtherHouseNoB').val(item.oHouseNo);
          $('#autoOtherSitioB').val(item.oSitio);
          $('#autoOtherBarangayB').val(item.oBrgy);
          $('#autoOtherTownB').val(item.oTown);
          $('#autoOtherProvinceB').val(item.oProvince);
          $('#autoHighestEducationalAttainmentB').val(item.heAttain);
          $('#autoOccupationB').val(item.occupation);
          $('#autoIdCardB').val(item.idCard);
          $('#autoEmailB').val(item.email);
          $('#sRank').val(item.sRank);
          $('#sAssign').val(item.sAssign);
          $('#sAffiliation').val(item.sAffiliation);
          $('#sCrimRecord').val(item.sCrimRecord);
          $('#sStatus').val(item.sStatus);
          $('#Height').val(item.Height);
          $('#Weight').val(item.Weight);
          $('#eyeColor').val(item.eyeColor);
          $('#eyeDesc').val(item.eyeDesc);
          $('#hairColor').val(item.hairColor);
          $('#hairDesc').val(item.hairDesc);
          $('#sInfluence').val(item.sInfluence);
          $('#guardian_name').val(item.guardian_name);
          $('#g_address').val(item.g_address);
          $('#ghome_phone').val(item.ghome_phone);
          $('#gmob_phone').val(item.gmob_phone);
          $('#familyNameSuggestionsB').hide();
          });
        suggestionsContainerB.append(suggestionItemB);
      });
    },
    error: function(xhr, status, error) {
      console.error("Error in searchFamilyNameB: " + error);
    }
  });
}

$(document).ready(function() {
  // To hide the suggestion box if clicked outside
  $(document).click(function(e) {
    if (!$(e.target).closest('#family_name_b').length && !$(e.target).closest('#familyNameSuggestionsB').length) {
      $('#familyNameSuggestionsB').hide();
    }
  });

  // You will also need to define the 'oninput' event for the '#family_name_b' input if not using the inline 'oninput' attribute in your HTML.
  $('#family_name_b').on('input', function() {
    searchFamilyNameB(this.value);
  });
});
</script>

<!-- SEARCH FAMILY NAME C -->
<script>
// Function for searching and populating the suggestions for Item C
function searchFamilyNameC(input) {
  if (input.length < 1) {
    $('#familyNameSuggestionsC').hide();
    return;
  }

  // AJAX call to get suggestions for Item C
  $.ajax({
    url: 'search_family_name.php', // Adjust this to the correct PHP file for Item C
    type: 'POST',
    dataType: 'json',
    data: { query: input },
    success: function(data) {
      var suggestionsContainerC = $('#familyNameSuggestionsC');
      suggestionsContainerC.empty().show();

      data.forEach(function(item) {
        var suggestionItemC = $('<div>')
          .text(item.personID + ' - ' + item.family_name + ' - ' + item.first_name+ ' - ' + item.middle_name)
          .click(function() {
          // Populate the Item C fields
          $('#personID_c').val(item.personID);
          $('#family_name_c').val(item.family_name);
          $('#autoFirstNameC').val(item.first_name);
          $('#autoMiddleNameC').val(item.middle_name);
          $('#autoQualifierC').val(item.qualifier);
          $('#autoNicknameC').val(item.nickname);
          $('#autoCitizenshipC').val(item.citizenship);
          $('#autoSexC').val(item.sex);
          $('#autoCivilStatusC').val(item.civil_status);
          $('#autoDateOfBirthC').val(item.doBirth);
          $('#autoAgeC').val(item.age);
          $('#autoPlaceOfBirthC').val(item.poBirth);
          $('#autoHomePhoneC').val(item.hPhone);
          $('#autoMobilePhoneC').val(item.mPhone);
          $('#autoCurrentHouseNoC').val(item.cHouseNo);
          $('#autoCurrentSitioC').val(item.cSitio);
          $('#autoCurrentBarangayC').val(item.cBrgy);
          $('#autoCurrentTownC').val(item.cTown);
          $('#autoCurrentProvinceC').val(item.cProvince);
          $('#autoOtherHouseNoC').val(item.oHouseNo);
          $('#autoOtherSitioC').val(item.oSitio);
          $('#autoOtherBarangayC').val(item.oBrgy);
          $('#autoOtherTownC').val(item.oTown);
          $('#autoOtherProvinceC').val(item.oProvince);
          $('#autoHighestEducationalAttainmentC').val(item.heAttain);
          $('#autoOccupationC').val(item.occupation);
          $('#autoIdCardC').val(item.idCard);
          $('#autoEmailC').val(item.email);
          $('#familyNameSuggestionsC').hide();
          });
        suggestionsContainerC.append(suggestionItemC);
      });
    },
    error: function(xhr, status, error) {
      console.error("Error in searchFamilyNameC: " + error);
    }
  });
}

$(document).ready(function() {
  // Hide the suggestions box if clicked outside
  $(document).click(function(e) {
    if (!$(e.target).closest('#family_name_c').length && !$(e.target).closest('#familyNameSuggestionsC').length) {
      $('#familyNameSuggestionsC').hide();
    }
  });

  // Bind the input event to the family name field for Item C
  $('#family_name_c').on('input', function() {
    searchFamilyNameC(this.value);
  });
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>
  window.onload = function() {
    // Function to update the input field with the current date and time
    function updateDateTime() {
      var now = new Date();
      var dateTimeNow = new Date(now.getTime() - (now.getTimezoneOffset() * 60000)).toISOString().slice(0,16);
      document.getElementById('datetime_reported').value = dateTimeNow;
    }

    // Call the function initially
    updateDateTime();

    // Update the input field every second
    setInterval(updateDateTime, 1000);
  };
</script>


<!-- SUCCESS MODAL FORM -->
<script>
// Shows the success modal
function showSuccessModal() {
    $('#successModal').css('display', 'flex').hide().fadeIn();
    setTimeout(function() {
        $('#successModal').fadeOut();
        $('#myForm').trigger('reset'); // Assuming 'myForm' is the ID of your form
        location.reload(); // Reload the page after the modal fades out and form resets
    }, 2000);
}

// Shows the error modal with a message
function showErrorModal(message) {
    $('#errorMessage').text(message);
    $('#errorModal').css('display', 'flex').hide().fadeIn();
    setTimeout(function() {
        $('#errorModal').fadeOut();
        location.reload(); // Reload the page after the modal fades out
    }, 2000);
}

</script>

<script>
  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none"; // Hide all tabs
    }
    tablinks = document.getElementsByClassName("tab-link");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active-link", "");
    }
    document.getElementById(tabName).style.display = "block"; // Show the current tab
    evt.currentTarget.className += " active-link"; // Set the current tab to active
}

// Set the default open tab when the page loads
document.addEventListener("DOMContentLoaded", function() {
    document.getElementsByClassName("tab-link")[0].click();
});

</script>



<!-- BODY -->
<body>
<form id="myForm" method="POST" action="form_handler.php">

<div class="tabular-form">
    <div class="tabs">
      <button class="tab-link" type="button" onclick="openTab(event, 'ReportDetails')">Report Summary</button>
      <button class="tab-link" type="button" onclick="openTab(event, 'ReportingPerson')">"A" - Reporting Person</button>
      <button class="tab-link" type="button" onclick="openTab(event, 'SuspectsData')">"B" - Suspect's Data</button>
      <button class="tab-link" type="button" onclick="openTab(event, 'VictimsData')">"C" - Victim's Data</button>
      <button class="tab-link" type="button" onclick="openTab(event, 'NarrativeOfIncident')">"D" - Narrative of Incident</button>
      <button class="tab-link" onclick="window.location.href = 'record.php';">Back to Report</button>

    </div>

    <!-- <h1>REPORT DETAILS</h1>
    <label for="type_of_incident">Type of Incident:</label> -->

<div id="ReportDetails" class="tab-content">
<h2>Report Summary</h2>
<div class="form-row">
  <div class="form-group">
<label for="type_of_incident">Type of Incident:</label>
    <select id="type_of_incident" name="type_of_incident" onchange="showSpecifyBox(this.value)" required>
    <option value="" disabled selected>Select Type of Incident</option>
        <option value="Theft">Theft</option>
        <option value="Burglary">Burglary</option>
        <option value="Vandalism">Vandalism</option>
        <option value="Assault">Assault</option>
        <option value="Robbery">Robbery</option>
        <option value="Arson">Arson</option>
        <option value="Homicide">Homicide</option>
        <option value="Fraud">Fraud</option>
        <option value="Drug Offense">Drug Offense</option>
        <option value="Traffic Violation">Traffic Violation</option>
        <option value="DUI">DUI (Driving Under the Influence)</option>
        <option value="Public Disturbance">Public Disturbance</option>
        <option value="Cybercrime">Cybercrime</option>
        <option value="Domestic Violence">Domestic Violence</option>
        <option value="Harassment">Harassment</option>
        <option value="Kidnapping">Kidnapping</option>
        <option value="Extortion">Extortion</option>
        <option value="Terrorism">Terrorism</option>
        <option value="Smuggling">Smuggling</option>
        <option value="Forgery">Forgery</option>
        <option value="Illegal Gambling">Illegal Gambling</option>
        <option value="Illegal Possession of Weapon">Illegal Possession of Weapon</option>
        <option value="Environment Crime">Environment Crime</option>
        <option value="Trafficking">Trafficking</option>
        <option value="Piracy">Piracy</option>
        <option value="Money Laundering">Money Laundering</option>
        <option value="Corruption">Corruption</option>
        <option value="Human Abuse/Maltreatment">Human Abuse/Maltreatment</option>
        <option value="Loitering">Loitering</option>
        <option value="Trespassing">Trespassing</option>
        <option value="Jaywalking">Jaywalking</option>
        <option value="Conspiracy">Conspiracy</option>
        <option value="Racketeering">Racketeering</option>
        <option value="Embezzlement">Embezzlement</option>
        <option value="Obstruction of Justice">Obstruction of Justice</option>
        <option value="Perjury">Perjury</option>
        <option value="Juvenile Delinquency">Juvenile Delinquency</option>
        <option value="Cult Activity">Cult Activity</option>
        <option value="Tax Evasion">Tax Evasion</option>
</select>


</div>
  <div class="form-group">
<label for="datetime_of_incident">Date and Time of Incident:</label>
<input type="datetime-local" id="datetime_of_incident" name="datetime_of_incident">
  </div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="datetime_reported">Date and Time Reported:</label>
<input type="datetime-local" id="datetime_reported" name="datetime_reported" readonly>

</div>
  <div class="form-group">
<label for="place_of_incident">Place of Incident: <span class="disclaimer">(Disclaimer: Estimated Location)</span></label>
<select id="place_of_incident" name="place_of_incident" onchange="moveMapToLocation(this.value)" required>
    <option value="">Select Place of Incident</option>
    <option value="Aguinaldo">Aguinaldo</option>
    <option value="Baldoza">Baldoza</option>
    <option value="Bantud">Bantud</option>
    <option value="Banuyao">Banuyao</option>
    <option value="Burgos-Mabini-Plaza">Burgos-Mabini-Plaza</option>
    <option value="Caingin">Caingin</option>
    <option value="Divinagracia">Divinagracia</option>
    <option value="Gustilo">Gustilo</option>
    <option value="Hinactacan">Hinactacan</option>
    <option value="Ingore">Ingore</option>
    <option value="Jereos">Jereos</option>
    <option value="Laguda">Laguda</option>
    <option value="Lopez Jaena Norte">Lopez Jaena Norte</option>
    <option value="Lopez Jaena Sur">Lopez Jaena Sur</option>
    <option value="Luna">Luna</option>
    <option value="MacArthur">MacArthur</option>
    <option value="Magdalo">Magdalo</option>
    <option value="Magsaysay Village">Magsaysay Village</option>
    <option value="Nabitasan">Nabitasan</option>
    <!-- <option value="Railway">Railway</option> -->
    <option value="Rizal">Rizal</option>
    <option value="San Isidro">San Isidro</option>
    <option value="San Nicolas">San Nicolas</option>
    <option value="Tabuc Suba">Tabuc Suba</option>
    <option value="Ticud">Ticud</option>
</select>
  <img src="toggle.png" id="toggleMapButton" alt="Toggle Map" onclick="toggleMap()">
  </div>
</div>

<div class="form-row" style="display: none;">
  <div class="form-group">
    <label for="latitude">Latitude:</label>
    <input type="text" id="latitude" name="latitude">
  </div>
  <div class="form-group">
    <label for="longitude">Longitude:</label>
    <input type="text" id="longitude" name="longitude">
  </div>
</div>

<!-- Button to toggle map visibility -->





<!-- Map Container -->
<div id="map" style="height: 500px; width: 90%; margin-top: 10px; margin-left: auto; margin-right: auto; display: none; background-color: #f0f0f0;"></div>


<script>
var locations = {
  "Aguinaldo": {
      coords: {lat: 10.706914020093047, lng: 122.57258361979724},
      zoom: 17.60 
  },
  "Baldoza": {
      coords: {lat: 10.71374275, lng: 122.58079420},
      zoom: 16.20 
  },    
  "Bantud": {
      coords:{lat: 10.70957856, lng: 122.56421070},
      zoom: 16.80
  }, 
  "Banuyao": {
      coords:{lat: 10.729240487193719, lng: 122.57963841541729},
      zoom: 15.70
  },     
  "Burgos-Mabini-Plaza": {
      coords:{lat: 10.71401261, lng: 122.56791330},
      zoom: 16.10
  },    
  "Caingin": {
      coords:{lat: 10.717763266196362, lng: 122.57524171407337},
      zoom: 16.50
  },  
  "Divinagracia": {
      coords:{lat: 10.70919809, lng: 122.57115520},
      zoom: 17
  },
  "Gustilo": {
      coords:{lat:10.716946173751825, lng: 122.5699270491424},
      zoom: 16.86
  },
  "Hinactacan":  {
      coords:{lat: 10.734294031182312, lng: 122.58719760894243},
      zoom: 15.70
  },
  "Ingore": {
      coords:{lat: 10.72160379, lng: 122.59450730},
      zoom: 14.40
  },
  "Jereos": {
      coords:{lat: 10.71722101, lng: 122.56799540},
      zoom: 16.70
  },
  "Laguda": {
      coords:{lat: 10.70778241, lng: 122.56770540},
      zoom: 17.50
  },
  "Lopez Jaena Norte": {
      coords:{ lat: 10.71410005, lng: 122.57266650},
      zoom: 16.70
  },

  "Lopez Jaena Sur": {
      coords:{ lat: 10.71117752, lng: 122.57433100},
      zoom: 16.60 
  },


  "Luna": {
      coords:{ lat: 10.706482706487785,  lng: 122.56534258940596},
      zoom: 17
  
  },


  "MacArthur": {
  coords: { lat: 10.70905186, lng: 122.57038730},
  zoom: 17 

  },


  "Magdalo": { 
      coords: {lat:10.714244103897801, lng: 122.56701057176224},
      zoom: 16.60
  },
  


  "Magsaysay Village": {
      coords: {lat:10.71154421415819, lng: 122.5617769795283},
      zoom: 16.20
  
  },

  "Nabitasan": {
    coords:{lat: 10.705472440404682, lng: 122.55872918215731},
    zoom: 16.10
  },

  "Rizal": {
    coords:{lat: 10.70772295, lng: 122.56965500},
    zoom: 17.30
  },

  "San Isidro": {
    coords:{lat: 10.72254093, lng: 122.58062130},
    zoom: 16.20
  },

  "San Nicolas": {
    coords: {lat: 10.71438142, lng: 122.56458470},
    zoom: 16.20
  },  

  "Tabuc Suba": {
    coords: {lat: 10.724147205415367, lng: 122.57230066095009},
    zoom: 15.20
  },

  "Ticud": {
   coords: {lat: 10.71869730, lng: 122.58162000},
   zoom: 16
  },
};


var map; 
var currentBoundary; 
var boundaries = {}; 
var markersArray = []; // Array to hold markers for possible future removal

function clearMarkers() {
  for (var i = 0; i < markersArray.length; i++) {
    markersArray[i].setMap(null);
  }
  markersArray = [];
}

function createMarker(lat, lng) {
  var marker = new google.maps.Marker({
    position: {lat: lat, lng: lng},
    map: map,
    title: 'Location Marker'
  });
  markersArray.push(marker); // Add marker to array for management
}

function onMapClick(event) {
  var lat = event.latLng.lat();
  var lng = event.latLng.lng();
  
  document.getElementById('latitude').value = lat.toFixed(6);
  document.getElementById('longitude').value = lng.toFixed(6);

  // Clear existing markers before adding a new one
  clearMarkers();
  createMarker(lat, lng);
}

function initMap() {
  var clearMapStyles = [
    {
      featureType: "poi.business",
      stylers: [{ visibility: "off" }]
    },
    {
      featureType: "transit",
      elementType: "labels.icon",
      stylers: [{ visibility: "off" }]
    },
    {
      featureType: "poi",
      stylers: [{ visibility: "off" }]
    }
  ];

  map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: 10.7081, lng: 122.5683 },
    zoom: 15,
    styles: clearMapStyles
  });

  map.addListener('click', onMapClick);

  fetchBoundaries();

  document.getElementById('place_of_incident').addEventListener('change', function() {
    moveMapToLocation(this.value);
  });
}

function fetchBoundaries() {
  fetch('boundaries.php')
    .then(response => response.json())
    .then(data => {
      boundaries = data;
    })
    .catch(error => console.error('Error fetching boundaries:', error));
}

function moveMapToLocation(place) {
  if (locations[place] && boundaries[place]) {
    var location = locations[place];
    map.setCenter(location.coords);
    map.setZoom(location.zoom);

    if (currentBoundary) {
      currentBoundary.setMap(null);
    }

    currentBoundary = new google.maps.Polygon({
      paths: boundaries[place],
      strokeColor: '#FF0000',
      strokeOpacity: 0.6,
      strokeWeight: 2,
      fillColor: '#FF0000',
      fillOpacity: 0.10
    });

    currentBoundary.setMap(map);
    currentBoundary.addListener('click', onMapClick);
  }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6zhaIwscTGqJGz2UwxGyxhlRz2HF3lFg&libraries=places&callback=initMap" async defer></script>
</div>

<!-- ITEM A  -->

<!-- <h1 onclick="toggleSection('itemA')">ITEM "A" - REPORTING PERSON <span id="toggleIconA" style="cursor: pointer;">&#x25BC;</span></h1>

<div id="itemA" style="display: block;"> -->

<div id="ReportingPerson" class="tab-content">
    <!-- Form content for Reporting Person -->
    <h2>Reporting Person</h2>
<div class="form-row">
    <div class="form-group">
<input type="hidden" id="personID_a" name="personID_a">

<label for="family_name_a">Family Name:</label>
<input type="text" id="family_name_a" name="family_name_a" oninput="searchFamilyName(this.value)" autocomplete="off">
<div id="familyNameSuggestions" class="suggestions-container"></div>
</div>
  <div class="form-group">
<label for="autoFirstName">First Name:</label>
<input type="text" id="autoFirstName" name="first_name" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoMiddleName">Middle Name:</label>
<input type="text" id="autoMiddleName" name="middle_name" readonly>
</div>
  <div class="form-group">
<label for="autoQualifier">Qualifier:</label>
<input type="text" id="autoQualifier" name="qualifier" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoNickname">Nickname:</label>
<input type="text" id="autoNickname" name="nickname" readonly>
</div>
  <div class="form-group">
<label for="autoCitizenship">Citizenship:</label>
<input type="text" id="autoCitizenship" name="citizenship" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoSex">Sex:</label>
<input type="text" id="autoSex" name="sex" readonly>
</div>
  <div class="form-group">
<label for="autoCivilStatus">Civil Status:</label>
<input type="text" id="autoCivilStatus" name="civil_status" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoDateOfBirth">Date of Birth:</label>
<input type="text" id="autoDateOfBirth" name="date_of_birth" readonly>
</div>
  <div class="form-group">
<label for="autoAge">Age:</label>
<input type="text" id="autoAge" name="age" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoPlaceOfBirth">Place of Birth:</label>
<input type="text" id="autoPlaceOfBirth" name="place_of_birth" readonly>
</div>
  <div class="form-group">
<label for="autoHomePhone">Home Phone:</label>
<input type="text" id="autoHomePhone" name="home_phone" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoMobilePhone">Mobile Phone:</label>
<input type="text" id="autoMobilePhone" name="mobile_phone" readonly>
</div>
  <div class="form-group">
<label for="autoCurrentHouseNo">Current House No:</label>
<input type="text" id="autoCurrentHouseNo" name="current_house_no" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoCurrentSitio">Current Sitio:</label>
<input type="text" id="autoCurrentSitio" name="current_sitio" readonly>
</div>
  <div class="form-group">
<label for="autoCurrentBarangay">Current Barangay:</label>
<input type="text" id="autoCurrentBarangay" name="current_barangay" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoCurrentTown">Current Town:</label>
<input type="text" id="autoCurrentTown" name="current_town" readonly>
</div>
  <div class="form-group">
<label for="autoCurrentProvince">Current Province:</label>
<input type="text" id="autoCurrentProvince" name="current_province" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoOtherHouseNo">Other House No:</label>
<input type="text" id="autoOtherHouseNo" name="other_house_no" readonly>
</div>
  <div class="form-group">
<label for="autoOtherSitio">Other Sitio:</label>
<input type="text" id="autoOtherSitio" name="other_sitio" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoOtherBarangay">Other Barangay:</label>
<input type="text" id="autoOtherBarangay" name="other_barangay" readonly>
</div>
  <div class="form-group">
<label for="autoOtherTown">Other Town:</label>
<input type="text" id="autoOtherTown" name="other_town" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoOtherProvince">Other Province:</label>
<input type="text" id="autoOtherProvince" name="other_province" readonly>
</div>
  <div class="form-group">
<label for="autoHighestEducationalAttainment">Highest Educational Attainment:</label>
<input type="text" id="autoHighestEducationalAttainment" name="highest_educational_attainment" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoOccupation">Occupation:</label>
<input type="text" id="autoOccupation" name="occupation" readonly>
</div>
  <div class="form-group">
<label for="autoIdCard">ID Card:</label>
<input type="text" id="autoIdCard" name="id_card" readonly>
</div>
</div>

<div class="form-row">
    <div class="form-group">
<label for="autoEmail">Email:</label>
<input type="text" id="autoEmail" name="email" readonly>
</div>
</div>
</div>
<!-- ITEM B -->
<!-- <h1 onclick="toggleSection('itemB')">ITEM "B" - SUSPECT'S DATA <span id="toggleIconB" style="cursor: pointer;">&#x25BC;</span></h1>

<div id="itemB" style="display: block;"> -->

<div id="SuspectsData" class="tab-content">
        <!-- Form content for Suspect's Data -->
        <h2>Suspect's Data</h2>
<div class="form-row">
  <div class="form-group">
<input type="hidden" id="personID_b" name="personID_b">

<label for="family_name_b">Family Name:</label>
<input type="text" id="family_name_b" name="family_name_b" oninput="searchFamilyNameB(this.value)" autocomplete="off">
<div id="familyNameSuggestionsB" class="suggestions-container" style="display: none;"></div>
</div>
  <div class="form-group">
<label for="autoFirstNameB">First Name:</label>
<input type="text" id="autoFirstNameB" name="first_name_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoMiddleNameB">Middle Name:</label>
<input type="text" id="autoMiddleNameB" name="middle_name_b" readonly>
</div>
  <div class="form-group">
<label for="autoQualifierB">Qualifier:</label>
<input type="text" id="autoQualifierB" name="qualifier_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoNicknameB">Nickname:</label>
<input type="text" id="autoNicknameB" name="nickname_b" readonly>
</div>
  <div class="form-group">
<label for="autoCitizenshipB">Citizenship:</label>
<input type="text" id="autoCitizenshipB" name="citizenship_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoSexB">Sex:</label>
<input type="text" id="autoSexB" name="sex_b" readonly>
</div>
  <div class="form-group">
<label for="autoCivilStatusB">Civil Status:</label>
<input type="text" id="autoCivilStatusB" name="civil_status_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoDateOfBirthB">Date of Birth:</label>
<input type="text" id="autoDateOfBirthB" name="date_of_birth_b" readonly>
</div>
  <div class="form-group">
<label for="autoAgeB">Age:</label>
<input type="text" id="autoAgeB" name="age_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoPlaceOfBirthB">Place of Birth:</label>
<input type="text" id="autoPlaceOfBirthB" name="place_of_birth_b" readonly>
</div>
  <div class="form-group">
<label for="autoHomePhoneB">Home Phone:</label>
<input type="text" id="autoHomePhoneB" name="home_phone_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoMobilePhoneB">Mobile Phone:</label>
<input type="text" id="autoMobilePhoneB" name="mobile_phone_b" readonly>
</div>
  <div class="form-group">
<label for="autoCurrentHouseNoB">Current House No:</label>
<input type="text" id="autoCurrentHouseNoB" name="current_house_no_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoCurrentSitioB">Current Sitio:</label>
<input type="text" id="autoCurrentSitioB" name="current_sitio_b" readonly>
</div>
  <div class="form-group">
<label for="autoCurrentBarangayB">Current Barangay:</label>
<input type="text" id="autoCurrentBarangayB" name="current_barangay_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoCurrentTownB">Current Town:</label>
<input type="text" id="autoCurrentTownB" name="current_town_b" readonly>
</div>
  <div class="form-group">
<label for="autoCurrentProvinceB">Current Province:</label>
<input type="text" id="autoCurrentProvinceB" name="current_province_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoOtherHouseNoB">Other House No:</label>
<input type="text" id="autoOtherHouseNoB" name="other_house_no_b" readonly>
</div>
  <div class="form-group">
<label for="autoOtherSitioB">Other Sitio:</label>
<input type="text" id="autoOtherSitioB" name="other_sitio_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoOtherBarangayB">Other Barangay:</label>
<input type="text" id="autoOtherBarangayB" name="other_barangay_b" readonly>
</div>
  <div class="form-group">
<label for="autoOtherTownB">Other Town:</label>
<input type="text" id="autoOtherTownB" name="other_town_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoOtherProvinceB">Other Province:</label>
<input type="text" id="autoOtherProvinceB" name="other_province_b" readonly>
</div>
  <div class="form-group">
<label for="autoHighestEducationalAttainmentB">Highest Educational Attainment:</label>
<input type="text" id="autoHighestEducationalAttainmentB" name="highest_educational_attainment_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoOccupationB">Occupation:</label>
<input type="text" id="autoOccupationB" name="occupation_b" readonly>
</div>
  <div class="form-group">
<label for="autoIdCardB">ID Card:</label>
<input type="text" id="autoIdCardB" name="id_card_b" readonly>
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="autoEmailB">Email:</label>
<input type="text" id="autoEmailB" name="email_b" readonly>
</div>
  <div class="form-group">
<label for="sRank">Rank:</label>
<input type="text" id="sRankB" name="sRank" >
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="sAssign">Assignment:</label>
<input type="text" id="sAssign" name="sAssign" >
</div>
  <div class="form-group">
<label for="sAffiliation">Affiliation:</label>
<input type="text" id="sAffiliation" name="sAffiliation" >
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="sCrimRecord">Criminal Record:</label>
<input type="text" id="sCrimRecord" name="sCrimRecord" >
</div>
  <div class="form-group">
<label for="sStatus">Status:</label>
<input type="text" id="sStatus" name="sStatus" >
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="Height">Height:</label>
<input type="text" id="Height" name="Height" >
</div>
  <div class="form-group">
<label for="Weight">Weight:</label>
<input type="text" id="Weight" name="Weight" >
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="eyeColor">Eye Color:</label>
<input type="text" id="eyeColor" name="eyeColor" >
</div>
  <div class="form-group">
<label for="eyeDesc">Eye Description:</label>
<input type="text" id="eyeDesc" name="eyeDesc" >
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="hairColor">Hair Color:</label>
<input type="text" id="hairColor" name="hairColor" >
</div>
  <div class="form-group">
<label for="hairDesc">Hair Description:</label>
<input type="text" id="hairDesc" name="hairDesc" >
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="sInfluence">Influence:</label>
<input type="text" id="sInfluence" name="sInfluence" >
</div>
  <div class="form-group">
<label for="guardian_name">Guardian Name:</label>
<input type="text" id="guardian_name" name="guardian_name" >
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="g_address">Guardian Address:</label>
<input type="text" id="g_address" name="g_address" >
</div>
  <div class="form-group">
<label for="ghome_phone">Guardian Home Phone:</label>
<input type="text" id="ghome_phone" name="ghome_phone" >
</div>
</div>

<div class="form-row">
  <div class="form-group">
<label for="gmob_phone">Guardian Mobile Phone:</label>
<input type="text" id="gmob_phone" name="gmob_phone" >
</div>
</div>
</div>

<!-- ITEM C -->
<!-- <h1 onclick="toggleSection('itemC')">ITEM "C" - VICTIM'S DATA <span id="toggleIconC" style="cursor: pointer;">&#x25BC;</span></h1>

<div id="itemC" style="display: block;"> -->

<div id="VictimsData" class="tab-content">
        <!-- Form content for Victim's Data -->
        <h2>Victim's Data</h2>

<div class="form-row">
<div class="form-group">
<input type="hidden" id="personID_c" name="personID_c">

<label for="family_name_c">Family Name:</label>
<input type="text" id="family_name_c" name="family_name_c" oninput="searchFamilyNameC(this.value)" autocomplete="off">
<div id="familyNameSuggestionsC" class="suggestions-container"></div>
</div>
  <div class="form-group">
<label for="autoFirstNameC">First Name:</label>
<input type="text" id="autoFirstNameC" name="first_name_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoMiddleNameC">Middle Name:</label>
<input type="text" id="autoMiddleNameC" name="middle_name_c" readonly>
</div>
  <div class="form-group">
<label for="autoQualifierC">Qualifier:</label>
<input type="text" id="autoQualifierC" name="qualifier_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoNicknameC">Nickname:</label>
<input type="text" id="autoNicknameC" name="nickname_c" readonly>
</div>
  <div class="form-group">
<label for="autoCitizenshipC">Citizenship:</label>
<input type="text" id="autoCitizenshipC" name="citizenship_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoSexC">Sex:</label>
<input type="text" id="autoSexC" name="sex_c" readonly>
</div>
  <div class="form-group">
<label for="autoCivilStatusC">Civil Status:</label>
<input type="text" id="autoCivilStatusC" name="civil_status_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoDateOfBirthC">Date of Birth:</label>
<input type="text" id="autoDateOfBirthC" name="date_of_birth_c" readonly>
</div>
  <div class="form-group">
<label for="autoAgeC">Age:</label>
<input type="text" id="autoAgeC" name="age_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoPlaceOfBirthC">Place of Birth:</label>
<input type="text" id="autoPlaceOfBirthC" name="place_of_birth_c" readonly>
</div>
  <div class="form-group">
<label for="autoHomePhoneC">Home Phone:</label>
<input type="text" id="autoHomePhoneC" name="home_phone_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoMobilePhoneC">Mobile Phone:</label>
<input type="text" id="autoMobilePhoneC" name="mobile_phone_c" readonly>
</div>
  <div class="form-group">
<label for="autoCurrentHouseNoC">Current House No:</label>
<input type="text" id="autoCurrentHouseNoC" name="current_house_no_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoCurrentSitioC">Current Sitio:</label>
<input type="text" id="autoCurrentSitioC" name="current_sitio_c" readonly>
</div>
  <div class="form-group">
<label for="autoCurrentBarangayC">Current Barangay:</label>
<input type="text" id="autoCurrentBarangayC" name="current_barangay_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoCurrentTownC">Current Town:</label>
<input type="text" id="autoCurrentTownC" name="current_town_c" readonly>
</div>
  <div class="form-group">
<label for="autoCurrentProvinceC">Current Province:</label>
<input type="text" id="autoCurrentProvinceC" name="current_province_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoOtherHouseNoC">Other House No:</label>
<input type="text" id="autoOtherHouseNoC" name="other_house_no_c" readonly>
</div>
  <div class="form-group">
<label for="autoOtherSitioC">Other Sitio:</label>
<input type="text" id="autoOtherSitioC" name="other_sitio_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoOtherBarangayC">Other Barangay:</label>
<input type="text" id="autoOtherBarangayC" name="other_barangay_c" readonly>
</div>
  <div class="form-group">
<label for="autoOtherTownC">Other Town:</label>
<input type="text" id="autoOtherTownC" name="other_town_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoOtherProvinceC">Other Province:</label>
<input type="text" id="autoOtherProvinceC" name="other_province_c" readonly>
</div>
  <div class="form-group">
<label for="autoHighestEducationalAttainmentC">Highest Educational Attainment:</label>
<input type="text" id="autoHighestEducationalAttainmentC" name="highest_educational_attainment_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoOccupationC">Occupation:</label>
<input type="text" id="autoOccupationC" name="occupation_c" readonly>
</div>
  <div class="form-group">
<label for="autoIdCardC">ID Card:</label>
<input type="text" id="autoIdCardC" name="id_card_c" readonly>
</div>
</div>

<div class="form-row">
<div class="form-group">
<label for="autoEmailC">Email:</label>
<input type="text" id="autoEmailC" name="email_c" readonly>
</div>
</div>
</div>
<!-- ITEM D -->
<!-- <h1>ITEM "D" - NARRATIVE OF INCIDENT</h1>
<form method="post" action="form.php"> -->
<div id="NarrativeOfIncident" class="tab-content">
        <!-- Form content for Victim's Data -->
        <h2>Narrative of Incident</h2>

  <label for="narrative">Narrative:</label>
  <textarea id="narrative" name="narrative"></textarea>

<label for="administering_officer">Administering Officer:</label>
<input type="text" id="administering_officer" name="administering_officer" value="<?php echo htmlspecialchars($_SESSION['firstname'] . " " . $_SESSION['lastname']); ?>" readonly>

    <!-- <label for="rank_name_of_desk_officer">Rank/Name of Desk Officer:</label>
    <input type="text" id="rank_name_of_desk_officer" name="rank_name_of_desk_officer"> -->

    <!-- <label for="blotter_number">Blotter Number:</label>
    <input type="text" id="blotter_number" name="blotter_number"> -->

    <label for="police_station_name">Police Station Name:</label>
    <select id="police_station_name" name="police_station_name">
    <option value="Police Station 2">Police Station 2 - LAPAZ</option>
    <option value="Police Station 1">Police Station 1 - GENERAL LUNA</option>
    <option value="Police Station 3">Police Station 3 - JARO</option>
    <option value="Police Station 4">Police Station 4 - MOLO</option>
    <option value="Police Station 5">Police Station 5 - MANDURRIAO</option>
    <option value="Police Station 6">Police Station 6 - AREVALO</option>
</select>

    <label for="chief_head_of_office">Chief/Head of Office:</label>
    <input type="text" id="chief_head_of_office" name="chief_head_of_office">
        
    <button type="submit" name="submitReport" id="submitButton">Submit Report</button>

    <!-- </form> -->
    </div>
</div>

<script src="script.js"></script>
<script>
    document.getElementById('myForm').addEventListener('submit', function() {
      document.getElementById('submitButton').disabled = true;
  });
</script>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Handle the form submission
    $('#myForm').submit(function(event){
        event.preventDefault(); // Prevent the default form submit action
        
        var formData = $(this).serialize(); // Serialize the form data
        
        $.ajax({
            type: 'POST',
            url: 'form_handler.php',
            data: formData,
            dataType: 'json', // Expect a JSON response
            success: function(response){
                if(response.status === "success") {
                    // Show the success modal
                    $('#successModal').fadeIn();
                    // Hide the modal after 2 seconds
                    setTimeout(function(){
                        $('#successModal').fadeOut();
                    }, 2000);
                } else {
                    // An error occurred, handle it here, perhaps showing the error modal
                }
            },
            error: function(xhr, status, error){
                console.error('An error occurred: ' + error); // Log errors for debugging
                // Display error in errorModal
                $('#errorMessage').text(error);
                // Show the error modal
                $('#errorModal').fadeIn();
                
                // Hide the modal after 2 seconds
                setTimeout(function(){
                    $('#errorModal').fadeOut();
                }, 2000);
            }
        });
    });

    // Other event bindings and functions...
});

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var chiefsByStation = {
            "Police Station 1": "PCol Joeresty Coronica",
            "Police Station 2": "PCPT Marlon C. Perez", 
            "Police Station 3": "PMAJ Eduardo Siacon",
            "Police Station 4": "PCPT Benjie Dicen",
            "Police Station 5": "PCol Albert Sy",
            "Police Station 6": "PCPT Resty Labastida"
        };

        var policeStationDropdown = document.getElementById('police_station_name');
        var chiefInput = document.getElementById('chief_head_of_office');

        policeStationDropdown.addEventListener('change', function() {
            var selectedStation = this.options[this.selectedIndex].value;
            chiefInput.value = chiefsByStation[selectedStation] || "PCPT Marlon C. Perez"; // Default to empty if no match found
        });
    });
</script>



<!-- Success Modal -->
<div id="successModal" class="modal-message">
  <div class="modal-content-message">
    <p class="success-message">Data submitted successfully!</p>
  </div>
</div>

<!-- Error Modal -->
<div id="errorModal" class="modal-message">
  <div class="modal-content-message">
    <p id="errorMessage" class="error-message"></p>
  </div>
</div>


</body>
</html>

