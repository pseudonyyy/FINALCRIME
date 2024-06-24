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
    $sRank = $_POST['sRank'];
    $sAssign = $_POST['sAssign'];
    $sAffiliation = $_POST['sAffiliation'];
    $sCrimRecord = $_POST['sCrimRecord'];
    $sStatus = $_POST['sStatus'];
    $Height = $_POST['Height'];
    $Weight = $_POST['Weight'];
    $eyeColor = $_POST['eyeColor'];
    $eyeDesc = $_POST['eyeDesc'];
    $hairColor = $_POST['hairColor'];
    $hairDesc = $_POST['hairDesc'];
    $sInfluence = $_POST['sInfluence'];
    $guardian_name = $_POST['guardian_name'];
    $g_address = $_POST['g_address'];
    $ghome_phone = $_POST['ghome_phone'];
    $gmob_phone = $_POST['gmob_phone'];

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
?>


<!DOCTYPE html>
<html>
    <head>
        <title>CRIMELEON - Records</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style> 
 @import url('https://fonts.cdnfonts.com/css/lovelo?styles=25962');

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

            .user-name {
            color: #0a2242;
            margin: 0 15px;
            font-weight: bold;
            font-size: 25px;
            vertical-align: middle;
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
    text-align: right; /* Right aligns the text in the label */
    }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="date"],
        input[type="number"],
        input[type="datetime-local"],
        select, 
        textarea {
            width: 300px; /* Fixed width, adjust as needed */
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc; /* Light grey border */
            background-color: #ffffff; /* Light background for inputs */
            color: #000000; /* Dark text for input content */
            border-radius: 4px;
            box-sizing: border-box;
        }
    /* Style for the submit button */
    #submitButton {
        font-family: 'Lovelo', sans-serif;
        background-color: #4CAF50; /* Green background for submit button */
        color: white; /* White text color for submit button */
        padding: 10px 20px;
        border: none;
        border-radius: px;
        cursor: pointer;
    }

    /* Style for the submit button on hover */
    #submitButton:hover {
        background-color: #45a049; /* Darker green for hover effect */
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
</head>

<div class="header">
    <img src="logo2.png" alt="Logo">
    <span class="brand-text">CRIMELEON</span>
    <div class="header-links">
        <a href="police.php">HOME</a>
        <a href="index_police.php">MAP</a>
        <a href="form.php">FORM</a>
        <a href="record.php">RECORD</a>
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

<!-- MODAL WINDOW -->
<script>
function showRegistrationModal() {
  var modal = document.getElementById('registrationModal');
  modal.style.display = 'flex'; // Use 'flex' to apply the CSS flexbox styles
}


document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById('registrationModal');
  var closeBtn = document.querySelector('.modal .close'); // Select the close button

  // When the user clicks on <span> (x), close the modal
  if (closeBtn) {
    closeBtn.onclick = function() {
      modal.style.display = 'none';
    };
  } else {
    console.error('Close button not found');
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  };
});

// Call the function to set up the close button event listener
setupCloseModal();
</script>

<!-- SUMBIT FUNCTION -->
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
        var suggestionItem = $('<div>').text(item.personID + ' - ' + item.family_name + ' - ' + item.first_name);
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
          .text(item.personID + ' - ' + item.family_name + ' - ' + item.first_name)
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
          .text(item.personID + ' - ' + item.family_name + ' - ' + item.first_name)
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


<!-- Register Person Data Button -->
<button type="button" onclick="showRegistrationModal()">Register Person Data</button>

<!-- The Modal -->
<div id="registrationModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h1>Register Person Data</h1>

    <!-- Registration form -->
    <form id="registrationForm" method="post" action="form.php">
        <label for="family_name">Family Name:</label>
        <input type="text" id="family_name" name="family_name">
    
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name">
    
        <label for="middle_name">Middle Name:</label>
        <input type="text" id="middle_name" name="middle_name">
    
        <label for="qualifier">Qualifier:</label>
        <input type="text" id="qualifier" name="qualifier">
    
        <label for="nickname">Nickname:</label>
        <input type="text" id="nickname" name="nickname">
    
        <label for="citizenship">Citizenship:</label>
          <select id="citizenship" name="citizenship">
              <option value=""></option>
              <option value="Filipino">Filipino</option>
              <option value="American">American</option>
              <option value="British">British</option>
              <option value="Canadian">Canadian</option>
              <option value="Chinese">Chinese</option>
              <option value="French">French</option>
              <option value="German">German</option>
              <option value="Indian">Indian</option>
              <option value="Japanese">Japanese</option>
              <option value="Mexican">Mexican</option>
          </select>

    
        <label for="sex">Sex:</label>
        <select id="sex" name="sex">
            <option value=""></option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

    
        <label for="civil_status">Civil Status:</label>
            <select id="civil_status" name="civil_status">
            <option value=""></option>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Widowed">Widowed</option>
            <option value="Divorced">Divorced</option>
            <option value="Separated">Separated</option>
        </select>
    
        <label for="doBirth">Date of Birth:</label>
        <input type="date" id="doBirth" name="doBirth">
    
        <label for="age">Age:</label>
        <input type="number" id="age" name="age">
    
        <label for="poBirth">Place of Birth:</label>
        <input type="text" id="poBirth" name="poBirth">
    
        <label for="hPhone">Home Phone:</label>
        <input type="number" id="hPhone" name="hPhone">
    
        <label for="mPhone">Mobile Phone:</label>
        <input type="number" id="mPhone" name="mPhone">
    
        <label for="cHouseNo">Current House No:</label>
        <input type="text" id="cHouseNo" name="cHouseNo">
    
        <label for="cSitio">Current Sitio:</label>
        <input type="text" id="cSitio" name="cSitio">
    
        <label for="cBrgy">Current Barangay:</label>
        <input type="text" id="cBrgy" name="cBrgy">
    
        <label for="cTown">Current Town:</label>
        <input type="text" id="cTown" name="cTown">
    
        <label for="cProvince">Current Province:</label>
        <input type="text" id="cProvince" name="cProvince">
    
        <label for="oHouseNo">Other House No:</label>
        <input type="text" id="oHouseNo" name="oHouseNo">
    
        <label for="oSitio">Other Sitio:</label>
        <input type="text" id="oSitio" name="oSitio">
    
        <label for="oBrgy">Other Barangay:</label>
        <input type="text" id="oBrgy" name="oBrgy">
    
        <label for="oTown">Other Town:</label>
        <input type="text" id="oTown" name="oTown">
    
        <label for="oProvince">Other Province:</label>
        <input type="text" id="oProvince" name="oProvince">
    
        <label for="heAttain">Highest Educational Attainment:</label>
        <select id="heAttain" name="heAttain">
            <option value=""></option>
            <option value="None">None</option>
            <option value="Elementary">Elementary</option>
            <option value="High School">High School</option>
            <option value="Associate Degree">Associate Degree</option>
            <option value="Bachelor's Degree">Bachelor's Degree</option>
            <option value="Graduate or Professional Degree">Graduate or Professional Degree</option>
        </select>


    
        <label for="occupation">Occupation:</label>
        <input type="text" id="occupation" name="occupation">
    
        <label for="idCard">ID Card:</label>
        <input type="text" id="idCard" name="idCard">
    
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">

        <button type="submit" name="registerPerson" id="submitRegistration">Submit Registration</button>

    </form>
<!-- Success message container -->
        <div id="submissionStatus"></div>
    </div>
</div>

<div id="errorModal" class="modal" style="display:none;">
    <div class="modal-content">Submission error: <span id="errorMessage"></span></div>
</div>

<!-- BODY -->
<body>
<form id="myForm" method="POST">
    <h1>REPORT DETAILS</h1>
    <label for="type_of_incident">Type of Incident:</label>
        <select id="type_of_incident" name="type_of_incident" onchange="showSpecifyBox(this.value)" required>
        <option value="">Select Incident Type</option>
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
        <option value="Other">Other</option>

    </select>

    <div id="specifyBox" style="display: none;">
            <label for="specify_other">Please specify:</label>
            <input type="text" id="specify_other" name="specify_other">
    </div>

    <label for="datetime_of_incident">Date and Time of Incident:</label>
    <input type="datetime-local" id="datetime_of_incident" name="datetime_of_incident">

    <label for="datetime_reported">Date and Time Reported:</label>
    <input type="datetime-local" id="datetime_reported" name="datetime_reported">

    <label for="place_of_incident">Place of Incident:</label>
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
        <option value="Railway">Railway</option>
        <option value="Rizal">Rizal</option>
        <option value="San Isidro">San Isidro</option>
        <option value="San Nicolas">San Nicolas</option>
        <option value="Tabuc Suba">Tabuc Suba</option>
        <option value="Ticud">Ticud</option>
    </select>

    <label for="latitude">Latitude:</label>
    <input type="text" id="latitude" name="latitude">

    <label for="longitude">Longitude:</label>
    <input type="text" id="longitude" name="longitude">


    <!-- Button to toggle map visibility -->
    <button type="button" id="toggleMapButton" onclick="toggleMap()">Show Map</button>


    <!-- Map Container -->
    <div id="map" style="height: 500px; width: 79%; margin-left: auto; margin-right: auto; display: none;"></div>

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


      "Nabitasan": {lat: 10.70551841, lng: 122.55889500},
      "Railway": {lat: 10.70987142, lng: 122.56790000},
      "Rizal": {lat: 10.70772295, lng: 122.56965500},
      "San Isidro": {lat: 10.72254093, lng: 122.58062130},
      "San Nicolas": {lat: 10.71438142, lng: 122.56458470},
      "Tabuc Suba": {lat: 10.72139678, lng: 122.57292490},
      "Ticud": {lat: 10.71869730, lng: 122.58162000}
  };




  var map; 
  var currentBoundary; 
  var boundaries = {}; 

  function onMapClick(event) {
  // Get the latitude and longitude from the event object
  var lat = event.latLng.lat();
  var lng = event.latLng.lng();

  // Set the latitude and longitude values to the input fields
  document.getElementById('latitude').value = lat.toFixed(6); // Formats to 6 decimal places
  document.getElementById('longitude').value = lng.toFixed(6); // Formats to 6 decimal places
}


function initMap() {
// Define styles that hide POI and other non-essential features
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

// Initialize map with custom styles
map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: 10.7081, lng: 122.5683 },
    zoom: 15,
    styles: clearMapStyles
});

// Add a click event listener to the map for latitude and longitude input fields update
map.addListener('click', onMapClick);

// Function to handle map click event
function onMapClick(event) {
    var lat = event.latLng.lat();
    var lng = event.latLng.lng();
    document.getElementById('latitude').value = lat.toFixed(6);
    document.getElementById('longitude').value = lng.toFixed(6);
}

// Fetch boundaries from the server
fetchBoundaries();

// Function to fetch boundaries data
function fetchBoundaries() {
    // Replace 'boundaries.php' with your actual PHP script path that returns boundaries data
    fetch('boundaries.php')
        .then(response => response.json())
        .then(data => {
            boundaries = data;
        })
        .catch(error => console.error('Error fetching boundaries:', error));
}

// Function to move map to a specific location based on place selection
function moveMapToLocation(place) {
    if (locations[place] && boundaries[place]) {
        var location = locations[place];
        map.setCenter(location.coords);
        map.setZoom(location.zoom);

        // Remove the previous boundary if it exists
        if (currentBoundary) {
            currentBoundary.setMap(null);
        }

        // Create a new polygon for the new boundary
        currentBoundary = new google.maps.Polygon({
            paths: boundaries[place],
            strokeColor: '#FF0000',
            strokeOpacity: 0.6,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.10
        });

        // Add the new boundary polygon to the map
        currentBoundary.setMap(map);

        // Add click event listener to the polygon boundary
        currentBoundary.addListener('click', onMapClick);
    }
}

// Listen for changes in the place_of_incident dropdown to move the map
document.getElementById('place_of_incident').addEventListener('change', function() {
    moveMapToLocation(this.value);
});
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6zhaIwscTGqJGz2UwxGyxhlRz2HF3lFg&libraries=places&callback=initMap" async defer></script>


<!-- ITEM A  -->
<h1>ITEM "A" - REPORTING PERSON</h1>

<input type="hidden" id="personID_a" name="personID_a">

<label for="family_name_a">Family Name:</label>
<input type="text" id="family_name_a" name="family_name_a" oninput="searchFamilyName(this.value)" autocomplete="off">
<div id="familyNameSuggestions" class="suggestions-container"></div>

<label for="autoFirstName">First Name:</label>
<input type="text" id="autoFirstName" name="first_name" readonly>

<label for="autoMiddleName">Middle Name:</label>
<input type="text" id="autoMiddleName" name="middle_name" readonly>

<label for="autoQualifier">Qualifier:</label>
<input type="text" id="autoQualifier" name="qualifier" readonly>

<label for="autoNickname">Nickname:</label>
<input type="text" id="autoNickname" name="nickname" readonly>

<label for="autoCitizenship">Citizenship:</label>
<input type="text" id="autoCitizenship" name="citizenship" readonly>

<label for="autoSex">Sex:</label>
<input type="text" id="autoSex" name="sex" readonly>

<label for="autoCivilStatus">Civil Status:</label>
<input type="text" id="autoCivilStatus" name="civil_status" readonly>

<label for="autoDateOfBirth">Date of Birth:</label>
<input type="text" id="autoDateOfBirth" name="date_of_birth" readonly>

<label for="autoAge">Age:</label>
<input type="text" id="autoAge" name="age" readonly>

<label for="autoPlaceOfBirth">Place of Birth:</label>
<input type="text" id="autoPlaceOfBirth" name="place_of_birth" readonly>

<label for="autoHomePhone">Home Phone:</label>
<input type="text" id="autoHomePhone" name="home_phone" readonly>

<label for="autoMobilePhone">Mobile Phone:</label>
<input type="text" id="autoMobilePhone" name="mobile_phone" readonly>

<label for="autoCurrentHouseNo">Current House No:</label>
<input type="text" id="autoCurrentHouseNo" name="current_house_no" readonly>

<label for="autoCurrentSitio">Current Sitio:</label>
<input type="text" id="autoCurrentSitio" name="current_sitio" readonly>

<label for="autoCurrentBarangay">Current Barangay:</label>
<input type="text" id="autoCurrentBarangay" name="current_barangay" readonly>

<label for="autoCurrentTown">Current Town:</label>
<input type="text" id="autoCurrentTown" name="current_town" readonly>

<label for="autoCurrentProvince">Current Province:</label>
<input type="text" id="autoCurrentProvince" name="current_province" readonly>

<label for="autoOtherHouseNo">Other House No:</label>
<input type="text" id="autoOtherHouseNo" name="other_house_no" readonly>

<label for="autoOtherSitio">Other Sitio:</label>
<input type="text" id="autoOtherSitio" name="other_sitio" readonly>

<label for="autoOtherBarangay">Other Barangay:</label>
<input type="text" id="autoOtherBarangay" name="other_barangay" readonly>

<label for="autoOtherTown">Other Town:</label>
<input type="text" id="autoOtherTown" name="other_town" readonly>

<label for="autoOtherProvince">Other Province:</label>
<input type="text" id="autoOtherProvince" name="other_province" readonly>

<label for="autoHighestEducationalAttainment">Highest Educational Attainment:</label>
<input type="text" id="autoHighestEducationalAttainment" name="highest_educational_attainment" readonly>

<label for="autoOccupation">Occupation:</label>
<input type="text" id="autoOccupation" name="occupation" readonly>

<label for="autoIdCard">ID Card:</label>
<input type="text" id="autoIdCard" name="id_card" readonly>

<label for="autoEmail">Email:</label>
<input type="text" id="autoEmail" name="email" readonly>


<!-- ITEM B -->
<h1>ITEM "B" - SUSPECT'S DATA</h1>

<input type="hidden" id="personID_b" name="personID_b">

<label for="family_name_b">Family Name:</label>
<input type="text" id="family_name_b" name="family_name_b" oninput="searchFamilyNameB(this.value)" autocomplete="off">
<div id="familyNameSuggestionsB" class="suggestions-container" style="display: none;"></div>

<label for="autoFirstNameB">First Name:</label>
<input type="text" id="autoFirstNameB" name="first_name_b" readonly>

<label for="autoMiddleNameB">Middle Name:</label>
<input type="text" id="autoMiddleNameB" name="middle_name_b" readonly>

<label for="autoQualifierB">Qualifier:</label>
<input type="text" id="autoQualifierB" name="qualifier_b" readonly>

<label for="autoNicknameB">Nickname:</label>
<input type="text" id="autoNicknameB" name="nickname_b" readonly>

<label for="autoCitizenshipB">Citizenship:</label>
<input type="text" id="autoCitizenshipB" name="citizenship_b" readonly>

<label for="autoSexB">Sex:</label>
<input type="text" id="autoSexB" name="sex_b" readonly>

<label for="autoCivilStatusB">Civil Status:</label>
<input type="text" id="autoCivilStatusB" name="civil_status_b" readonly>

<label for="autoDateOfBirthB">Date of Birth:</label>
<input type="text" id="autoDateOfBirthB" name="date_of_birth_b" readonly>

<label for="autoAgeB">Age:</label>
<input type="text" id="autoAgeB" name="age_b" readonly>

<label for="autoPlaceOfBirthB">Place of Birth:</label>
<input type="text" id="autoPlaceOfBirthB" name="place_of_birth_b" readonly>

<label for="autoHomePhoneB">Home Phone:</label>
<input type="text" id="autoHomePhoneB" name="home_phone_b" readonly>

<label for="autoMobilePhoneB">Mobile Phone:</label>
<input type="text" id="autoMobilePhoneB" name="mobile_phone_b" readonly>

<label for="autoCurrentHouseNoB">Current House No:</label>
<input type="text" id="autoCurrentHouseNoB" name="current_house_no_b" readonly>

<label for="autoCurrentSitioB">Current Sitio:</label>
<input type="text" id="autoCurrentSitioB" name="current_sitio_b" readonly>

<label for="autoCurrentBarangayB">Current Barangay:</label>
<input type="text" id="autoCurrentBarangayB" name="current_barangay_b" readonly>

<label for="autoCurrentTownB">Current Town:</label>
<input type="text" id="autoCurrentTownB" name="current_town_b" readonly>

<label for="autoCurrentProvinceB">Current Province:</label>
<input type="text" id="autoCurrentProvinceB" name="current_province_b" readonly>

<label for="autoOtherHouseNoB">Other House No:</label>
<input type="text" id="autoOtherHouseNoB" name="other_house_no_b" readonly>

<label for="autoOtherSitioB">Other Sitio:</label>
<input type="text" id="autoOtherSitioB" name="other_sitio_b" readonly>

<label for="autoOtherBarangayB">Other Barangay:</label>
<input type="text" id="autoOtherBarangayB" name="other_barangay_b" readonly>

<label for="autoOtherTownB">Other Town:</label>
<input type="text" id="autoOtherTownB" name="other_town_b" readonly>

<label for="autoOtherProvinceB">Other Province:</label>
<input type="text" id="autoOtherProvinceB" name="other_province_b" readonly>

<label for="autoHighestEducationalAttainmentB">Highest Educational Attainment:</label>
<input type="text" id="autoHighestEducationalAttainmentB" name="highest_educational_attainment_b" readonly>

<label for="autoOccupationB">Occupation:</label>
<input type="text" id="autoOccupationB" name="occupation_b" readonly>

<label for="autoIdCardB">ID Card:</label>
<input type="text" id="autoIdCardB" name="id_card_b" readonly>

<label for="autoEmailB">Email:</label>
<input type="text" id="autoEmailB" name="email_b" readonly>

<label for="sRank">Rank:</label>
<input type="text" id="sRankB" name="sRank" >

<label for="sAssign">Assignment:</label>
<input type="text" id="sAssign" name="sAssign" >

<label for="sAffiliation">Affiliation:</label>
<input type="text" id="sAffiliation" name="sAffiliation" >

<label for="sCrimRecord">Criminal Record:</label>
<input type="text" id="sCrimRecord" name="sCrimRecord" >

<label for="sStatus">Status:</label>
<input type="text" id="sStatus" name="sStatus" >

<label for="Height">Height:</label>
<input type="text" id="Height" name="Height" >

<label for="Weight">Weight:</label>
<input type="text" id="Weight" name="Weight" >

<label for="eyeColor">Eye Color:</label>
<input type="text" id="eyeColor" name="eyeColor" >

<label for="eyeDesc">Eye Description:</label>
<input type="text" id="eyeDesc" name="eyeDesc" >

<label for="hairColor">Hair Color:</label>
<input type="text" id="hairColor" name="hairColor" >

<label for="hairDesc">Hair Description:</label>
<input type="text" id="hairDesc" name="hairDesc" >

<label for="sInfluence">Influence:</label>
<input type="text" id="sInfluence" name="sInfluence" >

<label for="guardian_name">Guardian Name:</label>
<input type="text" id="guardian_name" name="guardian_name" >

<label for="g_address">Guardian Address:</label>
<input type="text" id="g_address" name="g_address" >

<label for="ghome_phone">Guardian Home Phone:</label>
<input type="text" id="ghome_phone" name="ghome_phone" >

<label for="gmob_phone">Guardian Mobile Phone:</label>
<input type="text" id="gmob_phone" name="gmob_phone" >



<!-- ITEM C -->
<h1>ITEM "C" - VICTIM'S DATA</h1>

<input type="hidden" id="personID_c" name="personID_c">

<label for="family_name_c">Family Name:</label>
<input type="text" id="family_name_c" name="family_name_c" oninput="searchFamilyNameC(this.value)" autocomplete="off">
<div id="familyNameSuggestionsC" class="suggestions-container"></div>

<label for="autoFirstNameC">First Name:</label>
<input type="text" id="autoFirstNameC" name="first_name_c" readonly>

<label for="autoMiddleNameC">Middle Name:</label>
<input type="text" id="autoMiddleNameC" name="middle_name_c" readonly>

<label for="autoQualifierC">Qualifier:</label>
<input type="text" id="autoQualifierC" name="qualifier_c" readonly>

<label for="autoNicknameC">Nickname:</label>
<input type="text" id="autoNicknameC" name="nickname_c" readonly>

<label for="autoCitizenshipC">Citizenship:</label>
<input type="text" id="autoCitizenshipC" name="citizenship_c" readonly>

<label for="autoSexC">Sex:</label>
<input type="text" id="autoSexC" name="sex_c" readonly>

<label for="autoCivilStatusC">Civil Status:</label>
<input type="text" id="autoCivilStatusC" name="civil_status_c" readonly>

<label for="autoDateOfBirthC">Date of Birth:</label>
<input type="text" id="autoDateOfBirthC" name="date_of_birth_c" readonly>

<label for="autoAgeC">Age:</label>
<input type="text" id="autoAgeC" name="age_c" readonly>

<label for="autoPlaceOfBirthC">Place of Birth:</label>
<input type="text" id="autoPlaceOfBirthC" name="place_of_birth_c" readonly>

<label for="autoHomePhoneC">Home Phone:</label>
<input type="text" id="autoHomePhoneC" name="home_phone_c" readonly>

<label for="autoMobilePhoneC">Mobile Phone:</label>
<input type="text" id="autoMobilePhoneC" name="mobile_phone_c" readonly>

<label for="autoCurrentHouseNoC">Current House No:</label>
<input type="text" id="autoCurrentHouseNoC" name="current_house_no_c" readonly>

<label for="autoCurrentSitioC">Current Sitio:</label>
<input type="text" id="autoCurrentSitioC" name="current_sitio_c" readonly>

<label for="autoCurrentBarangayC">Current Barangay:</label>
<input type="text" id="autoCurrentBarangayC" name="current_barangay_c" readonly>

<label for="autoCurrentTownC">Current Town:</label>
<input type="text" id="autoCurrentTownC" name="current_town_c" readonly>

<label for="autoCurrentProvinceC">Current Province:</label>
<input type="text" id="autoCurrentProvinceC" name="current_province_c" readonly>

<label for="autoOtherHouseNoC">Other House No:</label>
<input type="text" id="autoOtherHouseNoC" name="other_house_no_c" readonly>

<label for="autoOtherSitioC">Other Sitio:</label>
<input type="text" id="autoOtherSitioC" name="other_sitio_c" readonly>

<label for="autoOtherBarangayC">Other Barangay:</label>
<input type="text" id="autoOtherBarangayC" name="other_barangay_c" readonly>

<label for="autoOtherTownC">Other Town:</label>
<input type="text" id="autoOtherTownC" name="other_town_c" readonly>

<label for="autoOtherProvinceC">Other Province:</label>
<input type="text" id="autoOtherProvinceC" name="other_province_c" readonly>

<label for="autoHighestEducationalAttainmentC">Highest Educational Attainment:</label>
<input type="text" id="autoHighestEducationalAttainmentC" name="highest_educational_attainment_c" readonly>

<label for="autoOccupationC">Occupation:</label>
<input type="text" id="autoOccupationC" name="occupation_c" readonly>

<label for="autoIdCardC">ID Card:</label>
<input type="text" id="autoIdCardC" name="id_card_c" readonly>

<label for="autoEmailC">Email:</label>
<input type="text" id="autoEmailC" name="email_c" readonly>


<!-- ITEM D -->
<h1>ITEM "D" - NARRATIVE OF INCIDENT</h1>
<form method="post" action="form.php">

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


    <!-- <label for="investigator_on_case">Investigator on Case:</label>
    <input type="text" id="investigator_on_case" name="investigator_on_case"> -->

    <label for="chief_head_of_office">Chief/Head of Office:</label>
    <input type="text" id="chief_head_of_office" name="chief_head_of_office">
        
    <button type="submit" name="submitReport" id="submitButton">Submit Report</button>

    </form>

<script>
$(document).ready(function(){
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
                    showSuccessModal(); // Call the function to show the success modal and reload the page
                } else {
                    // An error occurred, handle it here, perhaps showing the error modal
                    showErrorModal('An error occurred. Please try again.'); // Show error modal with a generic error message
                }
            },
            error: function(xhr, status, error){
                // Handle the error
                showErrorModal(error); // Show error modal with the error received
            }
        });
    });
});

// Shows the success modal
function showSuccessModal() {
    $('#successModal').css('display', 'flex').hide().fadeIn();
    setTimeout(function() {
        $('#successModal').fadeOut();
        location.reload(); // Reload the page after the modal fades out
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

</body>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.getElementById('myForm').addEventListener('submit', function() {
      document.getElementById('submitButton').disabled = true;
  });
</script>


<script>
        window.onload = function() {
            // Check if the notification element exists
            var notification = document.getElementById('notification');
            if (notification) {
                // Set a timeout to hide the notification after 3 seconds
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 2000);
            }
        };
</script>

<script>
 function showSpecifyBox(value) {
     var specifyBox = document.getElementById('specifyBox');
     if(value === 'Other') {
         specifyBox.style.display = 'block';
     } else {
         specifyBox.style.display = 'none';
     }
 }
</script>

<script>
  window.onload = function() {
    // Get the current date and time
    var now = new Date();
    
    // Format the date and time to match the input format (YYYY-MM-DDTHH:MM)
    var dateTimeNow = new Date(now.getTime() - (now.getTimezoneOffset() * 60000)).toISOString().slice(0,16);

    // Set the value of the input
    document.getElementById('datetime_reported').value = dateTimeNow;
  };
</script>

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

</body>
</html>
