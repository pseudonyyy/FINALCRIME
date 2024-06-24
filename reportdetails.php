<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crimeleon2";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the report ID is set
    if (isset($_GET['reportId'])) {
        $reportId = $_GET['reportId'];

        // SQL to get the details for a specific report ID
        $sql = "SELECT r.*, pd.*, a.*, b.*, c.*, d.*, 
                        rp.family_name AS rp_family_name, rp.first_name AS rp_first_name, rp.middle_name AS rp_middle_name, rp.qualifier AS rp_qualifier, rp.nickname AS rp_nickname, rp.citizenship AS rp_citizenship, rp.sex AS rp_sex, rp.civil_status AS rp_civil_status, rp.doBirth AS rp_doBirth, rp.age AS rp_age, rp.poBirth AS rp_poBirth, rp.hPhone AS rp_hPhone, rp.mPhone AS rp_mPhone, rp.cHouseNo AS rp_cHouseNo, rp.cSitio AS rp_cSitio, rp.cBrgy AS rp_cBrgy, rp.cTown AS rp_cTown, rp.cProvince AS rp_cProvince, rp.oHouseNo AS rp_oHouseNo, rp.oSitio AS rp_oSitio, rp.oBrgy AS rp_oBrgy, rp.oTown AS rp_oTown, rp.oProvince AS rp_oProvince, rp.heAttain AS rp_heAttain, rp.occupation AS rp_occupation, rp.idCard AS rp_idCard, rp.email AS rp_email,
                        sd.family_name AS sd_family_name, sd.first_name AS sd_first_name, sd.middle_name AS sd_middle_name, sd.qualifier AS sd_qualifier, sd.nickname AS sd_nickname, sd.citizenship AS sd_citizenship, sd.sex AS sd_sex, sd.civil_status AS sd_civil_status, sd.doBirth AS sd_doBirth, sd.age AS sd_age, sd.poBirth AS sd_poBirth, sd.hPhone AS sd_hPhone, sd.mPhone AS sd_mPhone, sd.cHouseNo AS sd_cHouseNo, sd.cSitio AS sd_cSitio, sd.cBrgy AS sd_cBrgy, sd.cTown AS sd_cTown, sd.cProvince AS sd_cProvince, sd.oHouseNo AS sd_oHouseNo, sd.oSitio AS sd_oSitio, sd.oBrgy AS sd_oBrgy, sd.oTown AS sd_oTown, sd.oProvince AS sd_oProvince, sd.heAttain AS sd_heAttain, sd.occupation AS sd_occupation, sd.idCard AS sd_idCard, sd.email AS sd_email,
                        vd.family_name AS vd_family_name, vd.first_name AS vd_first_name, vd.middle_name AS vd_middle_name, vd.qualifier AS vd_qualifier, vd.nickname AS vd_nickname, vd.citizenship AS vd_citizenship, vd.sex AS vd_sex, vd.civil_status AS vd_civil_status, vd.doBirth AS vd_doBirth, vd.age AS vd_age, vd.poBirth AS vd_poBirth, vd.hPhone AS vd_hPhone, vd.mPhone AS vd_mPhone, vd.cHouseNo AS vd_cHouseNo, vd.cSitio AS vd_cSitio, vd.cBrgy AS vd_cBrgy, vd.cTown AS vd_cTown, vd.cProvince AS vd_cProvince, vd.oHouseNo AS vd_oHouseNo, vd.oSitio AS vd_oSitio, vd.oBrgy AS vd_oBrgy, vd.oTown AS vd_oTown, vd.oProvince AS vd_oProvince, vd.heAttain AS vd_heAttain, vd.occupation AS vd_occupation, vd.idCard AS vd_idCard, vd.email AS vd_email
                FROM report r
                LEFT JOIN item_a a ON r.repID = a.repID
                LEFT JOIN item_b b ON r.repID = b.repID
                LEFT JOIN item_c c ON r.repID = c.repID
                LEFT JOIN item_d d ON r.repID = d.repID
                LEFT JOIN persons_data pd ON pd.personID = a.personID
                LEFT JOIN persons_data rp ON rp.personID = a.personID
                LEFT JOIN persons_data sd ON sd.personID = b.personID
                LEFT JOIN persons_data vd ON vd.personID = c.personID
                WHERE r.repID = :reportId";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['reportId' => $reportId]);
        $reportDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reportDetails) {
            echo "<div class='modal-content-report'>";
        
        echo "<div class='modal-section'>";
        echo "<div class='modal-section-header'>CRIMELEON INCIDENT RECORD FORM</div>";
        echo "</div>";

        // HEADER
        echo "<div class='modal-section'>";
        echo "<div class='modal-section-header'>REPORT ID: " . htmlspecialchars($reportDetails['repID']) . "</div>";
        echo "</div>";

        echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>Type of Incident:</span><span class='field-value'>" . htmlspecialchars($reportDetails['type_of_incident']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Incident Date:</span><span class='field-value'>" . htmlspecialchars($reportDetails['datetime_of_incident']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Reported Date:</span><span class='field-value'>" . htmlspecialchars($reportDetails['datetime_reported']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Place of Incident:</span><span class='field-value'>" . htmlspecialchars($reportDetails['place_of_incident']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Status:</span><span class='field-value'>" . htmlspecialchars($reportDetails['status']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Latitude:</span><span class='field-value'>" . htmlspecialchars($reportDetails['latitude']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Longitude:</span><span class='field-value'>" . htmlspecialchars($reportDetails['longitude']) . "</span></div>";
        echo "</div>";

        // Item A details (Reporting Person)
        echo "<div class='modal-section'>";
        echo "<div class='modal-section-header'>ITEM A - Reporting Person:</div>";
        echo "</div>";
            
        echo "<div class='modal-section'>";
        echo "<div class='field-row'><span class='field-label'>Family Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_family_name']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>First Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_first_name']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Middle Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_middle_name']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Qualifier Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_qualifier']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Nickname:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_nickname']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Citizenship:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_citizenship']) . "</span></div>";
        echo "</div>";
        echo "<div class='modal-section'>";
        echo "<div class='field-row'><span class='field-label'>Sex:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_sex']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Civil Status:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_civil_status']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Date of Birth:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_doBirth']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Age:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_age']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Place of Birth:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_poBirth']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Home Phone:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_hPhone']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Mobile Phone:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_mPhone']) . "</span></div>";
        echo "</div>";
        echo "<div class='modal-section'>";
        echo "<div class='field-row'><span class='field-label'>Current House No:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_cHouseNo']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Current Sitio:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_cSitio']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Current Barangay:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_cBrgy']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Current Town:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_cTown']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Current Province:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_cProvince']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Current House:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_oHouseNo']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Other Sitio:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_oSitio']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Other Barangay:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_oBrgy']) . "</span></div>";
        echo "</div>";
        echo "<div class='modal-section'>";
        echo "<div class='field-row'><span class='field-label'>Other Town:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_oTown']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Other Province:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_oProvince']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Highest Educational Attainment:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_heAttain']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Occupation:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_occupation']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>ID Card:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_idCard']) . "</span></div>";
        echo "<div class='field-row'><span class='field-label'>Email:</span><span class='field-value'>" . htmlspecialchars($reportDetails['rp_email']) . "</span></div>";
        echo "</div>";

        // Item B details (Suspect's data)
        echo "<div class='modal-section'>";
        echo "<div class='modal-section-header'>ITEM B - Suspect Details:</div>";
        echo "</div>";

        echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>Family Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_family_name']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>First Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_first_name']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Middle Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_middle_name']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Qualifier Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_qualifier']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Nickname:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_nickname']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Citizenship:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_citizenship']) . "</span></div>";
        echo "</div>";
        echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>Sex:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_sex']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Civil Status:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_civil_status']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Date of Birth:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_doBirth']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Age:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_age']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Place of Birth:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_poBirth']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Home Phone:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_hPhone']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Mobile Phone:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_mPhone']) . "</span></div>";
        echo "</div>";
        echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>Current House No:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_cHouseNo']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Current Sitio:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_cSitio']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Current Barangay:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_cBrgy']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Current Town:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_cTown']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Current Province:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_cProvince']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Current House:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_oHouseNo']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Other Sitio:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_oSitio']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Other Barangay:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_oBrgy']) . "</span></div>";
        echo "</div>";
            echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>Other Town:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_oTown']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Other Province:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_oProvince']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Highest Educational Attainment:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_heAttain']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Occupation:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_occupation']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>ID Card:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_idCard']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Email:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sd_email']) . "</span></div>";
        echo "</div>";
            echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>if AFP/PNP Personnel (Rank):</span><span class='field-value'>" . htmlspecialchars($reportDetails['sRank']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Unit Assignemnt:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sAssign']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Affiliation:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sAffiliation']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Criminal Record:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sCrimRecord']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Status of Previous Case:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sStatus']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Height:</span><span class='field-value'>" . htmlspecialchars($reportDetails['Height']) . "</span></div>";
        echo "</div>";
            echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>Weight:</span><span class='field-value'>" . htmlspecialchars($reportDetails['Weight']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Eye Color:</span><span class='field-value'>" . htmlspecialchars($reportDetails['eyeColor']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Eye Description:</span><span class='field-value'>" . htmlspecialchars($reportDetails['eyeDesc']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Hair Color:</span><span class='field-value'>" . htmlspecialchars($reportDetails['hairColor']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Hair Description:</span><span class='field-value'>" . htmlspecialchars($reportDetails['hairDesc']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Influence:</span><span class='field-value'>" . htmlspecialchars($reportDetails['sInfluence']) . "</span></div>";
        echo "</div>";
        echo "<div class='modal-section'>";
        echo "<div class='modal-section-header'>FOR CHILDREN IN CONFLICT WITH THE LAW:</div>";
        echo "</div>";
        echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>Guardian Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['guardian_name']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Guardian Address:</span><span class='field-value'>" . htmlspecialchars($reportDetails['g_address']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Guardian Home Phone:</span><span class='field-value'>" . htmlspecialchars($reportDetails['g_address']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Guardian Mobile Phone:</span><span class='field-value'>" . htmlspecialchars($reportDetails['gmob_phone']) . "</span></div>";
        echo "</div>";

        // Item C details (Victim's data)
        echo "<div class='modal-section'>";
        echo "<div class='modal-section-header'>ITEM  C - Victim Details:</div>";
        echo "</div>";

        echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>Family Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_family_name']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>First Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_first_name']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Middle Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_middle_name']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Qualifier Name:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_qualifier']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Nickname:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_nickname']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Citizenship:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_citizenship']) . "</span></div>";
        echo "</div>";
        echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>Sex:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_sex']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Civil Status:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_civil_status']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Date of Birth:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_doBirth']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Age:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_age']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Place of Birth:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_poBirth']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Home Phone:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_hPhone']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Mobile Phone:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_mPhone']) . "</span></div>";
        echo "</div>";
        echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>Current House No:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_cHouseNo']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Current Sitio:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_cSitio']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Current Barangay:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_cBrgy']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Current Town:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_cTown']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Current Province:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_cProvince']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Current House:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_oHouseNo']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Other Sitio:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_oSitio']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Other Barangay:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_oBrgy']) . "</span></div>";
        echo "</div>";
        echo "<div class='modal-section'>";
            echo "<div class='field-row'><span class='field-label'>Other Town:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_oTown']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Other Province:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_oProvince']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Highest Educational Attainment:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_heAttain']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Occupation:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_occupation']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>ID Card:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_idCard']) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Email:</span><span class='field-value'>" . htmlspecialchars($reportDetails['vd_email']) . "</span></div>";
        echo "</div>";
            // Item D details (Narrative of incident)
        echo "<div class='modal-section'>";    
        echo "<div class='modal-section-header'>Narrative of Incident:</div>";
        echo "</div>";
            echo "<div class='field-row'><span class='field-label'>Narrative:</span><span class='field-value'>" . nl2br(htmlspecialchars($reportDetails['narrative'])) . "</span></div>";
        echo "<div class='modal-section'>"; 
            echo "<div class='field-row'><span class='field-label'>Administering Officer:</span><span class='field-value'>" . nl2br(htmlspecialchars($reportDetails['administering_officer'])) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Rank Name of Desk Officer:</span><span class='field-value'>" . nl2br(htmlspecialchars($reportDetails['rank_name_of_desk_officer'])) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Blotter Number:</span><span class='field-value'>" . nl2br(htmlspecialchars($reportDetails['blotter_number'])) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Police Station Name:</span><span class='field-value'>" . nl2br(htmlspecialchars($reportDetails['police_station_name'])) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Investigator on Case:</span><span class='field-value'>" . nl2br(htmlspecialchars($reportDetails['investigator_on_case'])) . "</span></div>";
            echo "<div class='field-row'><span class='field-label'>Chief Head of Office:</span><span class='field-value'>" . nl2br(htmlspecialchars($reportDetails['chief_head_of_office'])) . "</span></div>";
        echo "</div>";

        } else {
            echo "<p>No details found for the specified report.</p>";
        }
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
