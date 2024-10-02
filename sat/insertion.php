<?php
session_start();
if(isset($_GET['orbit_id']) and isset($_GET['type_of_orbit']) and isset($_GET['longitude']) and isset($_GET['period']) and isset($_GET['perigee']) and isset($_GET['apoge']) and isset($_GET['inclination'])){
$_SESSION['orbit_id'] = $_GET['orbit_id'];
$_SESSION['type_of_orbit'] = $_GET['type_of_orbit'];
$_SESSION['longitude'] = $_GET['longitude'];
$_SESSION['period'] = $_GET['period'];
$_SESSION['perigee'] = $_GET['perigee'];
$_SESSION['apoge'] = $_GET['apoge'];
$_SESSION['inclination'] = $_GET['inclination'];
$orbit_options = [];
$sql_orbit = "SELECT * FROM orbit";
$result_orbit = $conn->query($sql_orbit);
if ($result_orbit->num_rows > 0) {
    while ($row = $result_orbit->fetch_assoc()) {
        $orbit_options[$row['orbit_id']] = $row['type_of_orbit']; // Assuming 'orbit_id' is the unique identifier for orbits
    }
}

// Fetch options for country
$country_options = [];
$sql_country = "SELECT * FROM country";
$result_country = $conn->query($sql_country);
if ($result_country->num_rows > 0) {
    while ($row = $result_country->fetch_assoc()) {
        $country_options[$row['country_id']] = $row['cname']; // Assuming 'country_id' is the unique identifier for countries
    }
}

// Fetch options for organization
$organization_options = [];
$sql_organization = "SELECT * FROM organization";
$result_organization = $conn->query($sql_organization);
if ($result_organization->num_rows > 0) {
    while ($row = $result_organization->fetch_assoc()) {
        $organization_options[$row['org_id']] = $row['org_name']; // Assuming 'org_id' is the unique identifier for organizations
    }
}
}

?>
<!doctype html>
<html>
  <head>
    <title>intro</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="si.css" />
   
   
  </head>
  <body>
    <form action="insertion2.php" method="POST">
    
    <div class="parent-div">
      <div class="intro--1-4410" id="id-372">
        <div class="rectangle-18-1-779" id="id-376"></div>

        <label for="orbit">Select Orbit:</label>
    <select name="orbit" id="orbit">
        <?php foreach ($orbit_options as $orbit_id => $orbit_name) : ?>
            <option value="<?php echo $orbit_id; ?>"><?php echo $orbit_name; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="country">Select Country:</label>
    <select name="country" id="country">
        <?php foreach ($country_options as $country_id => $country_name) : ?>
            <option value="<?php echo $country_id; ?>"><?php echo $country_name; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="organization">Select Organization:</label>
    <select name="organization" id="organization">
        <?php foreach ($organization_options as $org_id => $org_name) : ?>
            <option value="<?php echo $org_id; ?>"><?php echo $org_name; ?></option>
        <?php endforeach; ?>
    </select><br><br>
        <input type="text" name="orbit_id" id="" class="rectangle-19-1-1344"  placeholder = "Enter the  Orbit ID:  ">
        
        <input type="text" name="type_of_orbit" id="" class="rectangle-20-1-336"  placeholder = "Enter the Type of Orbit:   ">
        <div class="rectangle-21-1-2135" id="id-3712"></div>
        <input type="text" name="longitude" id="" class="rectangle-21-1-2135"  placeholder = "Enter the   Longitude: ">
        
        <input type="text" name="period" id="" class="rectangle-22-1-561"   placeholder = "Enter the   Period: ">
        
        <input type="text" name="perigee" id="" class="rectangle-23-1-645"   placeholder = "Enter the   Perigee:">
     
        <input type="text" name="apoge" id=""  class="rectangle-24-1-160"  placeholder = "Enter the   Apoge: ">
        
        <input type="text" name="inclination" id="" class="rectangle-25-1-620"  placeholder = "Enter the   Inclination: ">
      
    
        <a href="insertion2.php" class="next-1-260" target = "_self"><input type="submit"  value="Next" name="" id="next"  ></a>
      </div>
    </div>
    </form>
   
  </body>
</html>
