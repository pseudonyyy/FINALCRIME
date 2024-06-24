<?php
session_start();

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

$sql = "SELECT latitude, longitude FROM report WHERE status='Approved'";
$result = $conn->query($sql);

$locations = array();
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $locations[] = $row;
  }
} else {
  echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Heatmaps</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<style>
     @import url('https://fonts.cdnfonts.com/css/lovelo?styles=25962');

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

        
    tr:hover {
    background-color: rgba(232, 232, 232, 0.4); /* 0.7 is 70% opacity */
    }

</style>
<style>
    /* 
 * Always set the map height explicitly to define the size of the div element
 * that contains the map. 
 */
 #map {
    height: 100%;
  }
  
  /* 
   * Optional: Makes the sample page fill the window. 
   */
  html,
  body {
    height: 91%;
    margin: 0;
    padding: 0;
  }
  
/* Style for the floating panel container */
#floating-panel {
    position: fixed; /* Positioning it relative to the viewport */
    top: 120px; /* Distance from the top */
    left: 400px; /* Distance from the left */
    padding: 10px; /* Padding around the content */
    background-color: #bbc8e6; /* White background for the panel */
    border: 1px solid #ccc; /* Grey border */
    border-radius: 5px; /* Rounded corners */
    box-shadow: 0 2px 5px rgba(0,0,0,0.3); /* Subtle shadow to lift the panel off the page */
}

/* General style for buttons */
#floating-panel button {
  font-family: 'Lovelo', sans-serif;
    background-color:#0a2242; /* Green background */
    color: white; /* White text */
    border: none; /* No borders */
    padding: 10px 25px; /* Top and bottom padding of 10px, left and right padding of 20px */
    margin: 5px; /* Margin around each button */
    cursor: pointer; /* Cursor appears as a pointer on hover */
    border-radius: 4px; /* Rounded corners */
    font-size: 11px; /* Font size for text inside the buttons */
    transition: background-color 0.3s; /* Smooth transition for background color change on hover */
}

/* Hover effect for buttons */
#floating-panel button:hover {
    background-color: #a4b7e4; /* Darker shade of green on hover */
}

</style>

  </head>
<body>

<div class="header">
    <img src="logo2.png" alt="Logo">
    <span class="brand-text">CRIMELEON</span>
    <div class="header-links">
        <a href="investigator.php">HOME</a>
        <a href="index_inv.php" class="active">MAP</a> 
        <a href="inv_record.php">REPORT</a>
        <a href="about_i.php">ABOUT US</a>
        <span class="user-name"><?php echo htmlspecialchars($_SESSION['firstname'] . " " . $_SESSION['lastname']); ?></span>
        <div class="dropdown">
            <img src="logout.png" alt="Logout Icon" style="cursor: pointer; width: 50px; height: 50px;">
            <div class="dropdown-content">
                <a href="logout.php">LOGOUT</a>
            </div>
        </div>
    </div>
</div>

<div id="map"></div>
<div id="floating-panel">
    <button id="toggle-heatmap">Toggle Heatmap</button>
    <button id="change-gradient">Change gradient</button>
    <button id="change-radius">Change radius</button>
    <button id="change-opacity">Change opacity</button>
  </div>



<script>
let map, heatmap;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 14,
    center: { lat: 10.714866, lng: 122.580625 },
    mapTypeId: "roadmap",
    styles: [
      {
        featureType: "poi",
        elementType: "labels",
        stylers: [{ visibility: "off" }],
      },
    ],
  });


  
  heatmap = new google.maps.visualization.HeatmapLayer({
    data: getPoints(),
    map: map,
  });
  document
    .getElementById("toggle-heatmap")
    .addEventListener("click", toggleHeatmap);
  document
    .getElementById("change-gradient")
    .addEventListener("click", changeGradient);
  document
    .getElementById("change-opacity")
    .addEventListener("click", changeOpacity);
  document
    .getElementById("change-radius")
    .addEventListener("click", changeRadius);
}

function toggleHeatmap() {
  heatmap.setMap(heatmap.getMap() ? null : map);
}

function changeGradient() {
  const gradient = [
    "rgba(0, 255, 255, 0)",
    "rgba(0, 255, 255, 1)",
    "rgba(0, 191, 255, 1)",
    "rgba(0, 127, 255, 1)",
    "rgba(0, 63, 255, 1)",
    "rgba(0, 0, 255, 1)",
    "rgba(0, 0, 223, 1)",
    "rgba(0, 0, 191, 1)",
    "rgba(0, 0, 159, 1)",
    "rgba(0, 0, 127, 1)",
    "rgba(63, 0, 91, 1)",
    "rgba(127, 0, 63, 1)",
    "rgba(191, 0, 31, 1)",
    "rgba(255, 0, 0, 1)",
  ];

  heatmap.set("gradient", heatmap.get("gradient") ? null : gradient);
}

function changeRadius() {
  heatmap.set("radius", heatmap.get("radius") ? null : 20);
}

function changeOpacity() {
  heatmap.set("opacity", heatmap.get("opacity") ? null : 0.3);
}

// Heatmap data: 500 Points
function getPoints() {
    return [
        <?php foreach($locations as $location): ?>
            new google.maps.LatLng(<?php echo $location['latitude']; ?>, <?php echo $location['longitude']; ?>),
        <?php endforeach; ?>
    ];
}

window.initMap = initMap;
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6zhaIwscTGqJGz2UwxGyxhlRz2HF3lFg&callback=initMap&libraries=visualization&v=weekly"
    defer
></script>
</body>
</html>