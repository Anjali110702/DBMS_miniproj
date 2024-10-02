<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "satellitedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM satellite s
INNER JOIN country c ON s.country_id = c.country_id
INNER JOIN orbit o ON s.orbit_id = o.orbit_id
INNER JOIN launch l ON s.launch_id=l.launch_id
INNER JOIN organisation org ON s.org_id=org.org_id
INNER JOIN contractor con ON org.con_id=con.con_id
WHERE c.cname = '$selected_country'
AND o.type_of_orbit = '$selected_orbit'
AND s.sname = '$selected_satellite'";
$result = $conn->query($sql);

// Display search results
if ($result->num_rows > 0) {
    echo "<h3>Satellite Details</h3>";
    echo "<table>";
    // Display table headers
    echo "<tr><th>Satellite Name</th><th>Expected Lifetime</th><th>Dry Mass</th><th>Launch Mass</th><th>Power</th><th>Official Name</th><th>Launch site</th><th>Launch date</th><th>Contractor</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        // Display table rows with satellite details
        $satelliteDetails = array(
            'sname' => $row['sname'],
            'cname' => $row['cname'],
            'type_of_orbit' => $row['type_of_orbit'],
            'exp_lifetime' => $row['exp_lifetime'],
            'dry_mass' => $row['dry_mass'],
            'launch_mass' => $row['launch_mass'],
            'launch_site' => $row['launch_site'],
            'date_of_launch' => $row['date_of_launch'],
            'power' => $row['power'],
            'org_name' => $row['org_name'],
            'org_country' => $row['org_country'],
            'org_phone' => $row['org_phone'],
            'con_name' => $row['con_name'],
            'con_phone' => $row['con_phone']
        );
    }
} else {
    echo "No results found.";
}


// Output the satellite details as JSON
echo json_encode($satelliteDetails);
?>
