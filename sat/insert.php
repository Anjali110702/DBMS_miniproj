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

$country_options = [];
$sql_country = "SELECT * FROM country";
$result_country = $conn->query($sql_country);
if ($result_country->num_rows > 0) {
    while ($row = $result_country->fetch_assoc()) {
        $country_options[$row['cname']] = $row['cname'];
    }
}

$organization_options = [];
$sql_organization = "SELECT * FROM organisation";
$result_organization = $conn->query($sql_organization);
if ($result_organization->num_rows > 0) {
    while ($row = $result_organization->fetch_assoc()) {
        $organization_options[$row['org_name']] = $row['org_name'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
</head>
<style>
    .container {
        position: relative;
        left: 40vw;
        border: solid 5px black;
        border-radius: 20px;
        width: 600px;
        padding: 20px;
        padding-right: 100px;
    }

    .form {
        position: relative;
        left: 90px;
        font-size: xx-large;
    }

    input {
        font-size: x-large;
        border-radius: 25px;
        height: 50px;
        width: 550px;
    }

    #submit {
        position: relative;
        top: 30px;
        padding: 10px;
    }
</style>
<body style=" background-color: grey;">
<div class="container">
    <h2 style="font-size: 10vh; text-align: center;">Insert Data</h2>
    <div class="form">
        <form action="insertvalues.php" method="post">
        <label for="sname">Satellite Name:</label><br>
            <input type="text" id="sname" name="sname" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="exp_life">Expected Lifetime:</label><br>
            <input type="text" id="exp_life" name="exp_life" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="dry_mass">Dry Mass:</label><br>
            <input type="text" id="dry_mass" name="dry_mass" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="launch_mass">Launch Mass:</label><br>
            <input type="text" id="launch_mass" name="launch_mass" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="spower">Power:</label><br>
            <input type="text" id="spower" name="spower" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="country">Country Name:</label><br>
           
            <input type="text" id="country_name" name="country_name" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="UN_registery">UN Registry:</label><br>
            <input type="text" id="UN_registery" name="UN_registery" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="con_name">Contractor Name:</label><br>
            <input type="text" id="con_name" name="con_name" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="con_phone">Contractor Phone:</label><br>
            <input type="text" id="con_phone" name="con_phone" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="org_name">Organization Name:</label><br>
           
            <input type="text" id="org_name" name="org_name" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="org_country">Organization Country Name:</label><br>
            <input type="text" id="org_country" name="org_country" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="org_phone">Organization Phone:</label><br>
            <input type="text" id="org_phone" name="org_phone" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="purpose">Purpose:</label><br>
            <input type="text" id="purpose" name="purpose" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="det_purpose">Detailed Purpose:</label><br>
            <input type="text" id="det_purpose" name="det_purpose" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="ldate">Launch Date:</label><br>
            <input type="text" id="ldate" name="ldate" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="lsite">Launch Site:</label><br>
            <input type="text" id="lsite" name="lsite" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="lvehicle">Launch Vehicle:</label><br>
            <input type="text" id="lvehicle" name="lvehicle" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="cospar">Cospar Number:</label><br>
            <input type="text" id="cospar" name="cospar" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="norad">Norad Number:</label><br>
            <input type="text" id="norad" name="norad" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="orbit_type">Orbit Type:</label><br>
            <input type="text" id="orbit_type" name="orbit_type" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="long">Longitude:</label><br>
            <input type="text" id="long" name="long" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="period">Period:</label><br>
            <input type="text" id="period" name="period" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="perigee">Perigee:</label><br>
            <input type="text" id="perigee" name="perigee" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="apogee">Apogee:</label><br>
            <input type="text" id="apogee" name="apogee" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="inc">Inclination:</label><br>
            <input type="text" id="inc" name="inc" required><br>
            <!-- Add 'required' attribute to ensure this field is not empty -->
            <label for="ecc">Eccentricity:</label><br>
            <input type="text" id="ecc" name="ecc" required><br>
            <input type="submit" value="Submit" id="submit">
            <br><br>
        </form>
    </div>
</div>
</body>
</html>
