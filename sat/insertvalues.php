<?php
session_start();

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "satellitedb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to retrieve or insert country ID
function getCountryID($conn, $countryName, $UN_registery) {
    $sql = "SELECT country_id FROM country WHERE cname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $countryName);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["country_id"];
    } else {
        // Insert country name if not exists
        $sql = "INSERT INTO country (cname, UN_registery) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $countryName, $UN_registery);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

// Function to retrieve or insert organization ID
function getOrganizationID($conn, $orgName, $orgCountry, $orgPhone) {
    $sql = "SELECT org_id FROM organisation WHERE org_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orgName);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["org_id"];
    } else {
        // Insert organization details if not exists
        $sql = "INSERT INTO organisation (org_name, org_country, org_phone) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $orgName, $orgCountry, $orgPhone);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

// Function to retrieve or insert purpose ID
function getPurposeID($conn, $purpose, $detPurpose) {
    $sql = "SELECT purpose_id FROM purpose WHERE purpose = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $purpose);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["purpose_id"];
    } else {
        // Insert purpose details if not exists
        $sql = "INSERT INTO purpose (purpose, det_purpose) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $purpose, $detPurpose);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

// Function to retrieve or insert launch ID
function getLaunchID($conn, $dateOfLaunch, $launchSite, $launchVehicle, $cospar, $norad, $satelliteID) {
    $sql = "SELECT launch_id FROM launch WHERE date_of_launch = ? AND launch_site = ? AND launch_vehicle = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $dateOfLaunch, $launchSite, $launchVehicle);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["launch_id"];
    } else {
        // Insert launch details if not exists
        $sql = "INSERT INTO launch (date_of_launch, launch_site, launch_vehicle, COSPAR_number, NORAD_number, satellite_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $dateOfLaunch, $launchSite, $launchVehicle, $cospar, $norad, $satelliteID);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

// Function to retrieve or insert orbit ID
function getOrbitID($conn, $orbitType, $long, $period, $perigee, $apogee, $inc, $ecc) {
    $sql = "SELECT orbit_id FROM orbit WHERE type_of_orbit = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orbitType);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["orbit_id"];
    } else {
        // Insert orbit details if not exists
        $sql = "INSERT INTO orbit (type_of_orbit, longitude, period, perigee, apogee, inclination, eccentricity) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $orbitType, $long, $period, $perigee, $apogee, $inc, $ecc);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure all required fields are present
    if(isset($_POST['sname'], $_POST['exp_life'], $_POST['dry_mass'], $_POST['launch_mass'], $_POST['spower'], $_POST['country_name'], $_POST['org_name'], $_POST['purpose'], $_POST['ldate'], $_POST['lsite'], $_POST['lvehicle'], $_POST['orbit_type'])) {
        
        // Set variables for missing values
        $sname = $_POST['sname'] ?? '';
        $exp_lifetime = $_POST['exp_life'] ?? '';
        $dry_mass = $_POST['dry_mass'] ?? '';
        $launch_mass = $_POST['launch_mass'] ?? '';
        $spower = $_POST['spower'] ?? '';
        $country_name = $_POST['country_name'] ?? '';
        $UN_registery = $_POST['UN_registery'] ?? '';
        $org_name = $_POST['org_name'] ?? '';
        $org_country = $_POST['org_country'] ?? '';
        $org_phone = $_POST['org_phone'] ?? '';
        $purpose = $_POST['purpose'] ?? '';
        $det_purpose = $_POST['det_purpose'] ?? '';
        $ldate = $_POST['ldate'] ?? '';
        $lsite = $_POST['lsite'] ?? '';
        $lvehicle = $_POST['lvehicle'] ?? '';
        $cospar = $_POST['cospar'] ?? '';
        $norad = $_POST['norad'] ?? '';
        $orbit_type = $_POST['orbit_type'] ?? '';
        $long = $_POST['long'] ?? '';
        $period = $_POST['period'] ?? '';
        $perigee = $_POST['perigee'] ?? '';
        $apogee = $_POST['apogee'] ?? '';
        $inclination = $_POST['inclination'] ?? '';
        $eccentricity = $_POST['eccentricity'] ?? '';
        $satellite_id=$satellite_id;
        // Get IDs for country, organization, purpose, launch, and orbit
        $country_id = getCountryID($conn, $country_name, $UN_registery);
        $org_id = getOrganizationID($conn, $org_name, $org_country, $org_phone);
        $purpose_id = getPurposeID($conn, $purpose, $det_purpose);
        $launch_id = getLaunchID($conn, $ldate, $lsite, $lvehicle, $cospar, $norad, $satellite_id);
        $orbit_id = getOrbitID($conn, $orbit_type, $long, $period, $perigee, $apogee, $inclination, $eccentricity);
        
        // Insert satellite details
        $sql = "INSERT INTO satellite (sname, exp_lifetime, dry_mass, launch_mass, power, orbit_id, purpose_id, country_id, launch_id, org_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siiiiiiiii", $sname, $exp_lifetime, $dry_mass, $launch_mass, $spower, $orbit_id, $purpose_id, $country_id, $launch_id, $org_id);
        
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required";
    }
}

$conn->close();
?>
