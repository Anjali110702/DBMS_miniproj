<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Satellite Details</title>
    <style>
        form {
            text-align: center;
            margin-top: 30px;
            z-index: 1; 
            position: relative; 
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(225.75deg, #31d6d8ff 14%, #8074c7d6 46%, #c61ed4b2 89%);
            background-size: 100% 100%;
            margin: 0;
            padding: 0;
            z-index: 1;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        select, input[type="submit"] {
            padding: 8px;
            font-size: 16px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            margin: 30px auto;
            border-collapse: collapse;
            width: 80%;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .additional-details {
            display: none; 
        }


        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 20px auto;
            max-width: 500px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            padding: 8px 16px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
        }

        .button-container button:hover {
            background-color: #45a049;
        }

        #know-more-button {
            padding: 8px;
            font-size: 16px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;

            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;

        }

        #know-more-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
   
    <h2>Search Satellite Details</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="country">Select Country:</label>
        <select name="country" id="country">
            <option value="">Select Country</option>
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "satellitedb";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM country";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["cname"]."'>".$row["cname"]."</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>

        <label for="orbit">Select Orbit:</label>
        <select name="orbit" id="orbit">
            <option value="">Select Orbit</option>
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM orbit";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["type_of_orbit"]."'>".$row["type_of_orbit"]."</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>

        <label for="satellite">Select Satellite:</label>
        <select name="satellite" id="satellite">
            <option value="">Select Satellite</option>
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM satellite";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["sname"]."'>".$row["sname"]."</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>

        <input type="submit" name="submit" value="Search">
    </form>
    
    <?php
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "satellitedb";

    // Establishing database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handling form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            // Search satellite details
            // Retrieve form data
            $selected_country = $_POST["country"];
            $selected_orbit = $_POST["orbit"];
            $selected_satellite = $_POST["satellite"];

            // SQL query to search satellite details
            $sql = "SELECT * FROM satellite s
                    INNER JOIN country c ON s.country_id = c.country_id
                    INNER JOIN orbit o ON s.orbit_id = o.orbit_id
                    INNER JOIN launch l ON s.launch_id=l.launch_id
                    INNER JOIN organisation org ON s.org_id=org.org_id
                    INNER JOIN contractor con ON org.con_id=con.con_id
                    WHERE c.cname = '$selected_country'
                    AND o.type_of_orbit = '$selected_orbit'
                    AND s.sname = '$selected_satellite'";
            
            // Execute the query
            $result = $conn->query($sql);

            // Display search results
            if ($result->num_rows > 0) {
                echo "<h3>Satellite Details</h3>";
                echo "<table>";
                // Display table headers
                echo "<tr><th>Satellite Name</th><th>Expected Lifetime</th><th>Dry Mass</th><th>Launch Mass</th><th>Power</th><th>Launch site</th><th>Launch date</th><th>Contractor</th><th>Action</th></tr>";
                while($row = $result->fetch_assoc()) {
                    // Display table rows with satellite details
                    echo "<tr>";
                    echo "<td>".$row["sname"]."</td>";
                    echo "<td>".$row["exp_lifetime"]."</td>";
                    echo "<td>".$row["dry_mass"]."</td>";
                    echo "<td>".$row["launch_mass"]."</td>";
                    echo "<td>".$row["power"]."</td>";
                   
                    echo "<td>".$row["launch_site"]."</td>";
                    echo "<td>".$row["date_of_launch"]."</td>";
                    echo "<td>".$row["con_name"]."</td>";
                    // Add delete button with form submission
                    echo "<td>
                            <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>
                                <input type='hidden' name='delete' value='" . $row['sname'] . "'>
                                <button type='submit'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No results found.";
            }
        } elseif (isset($_POST["delete"])) {
            // Handle delete request
            $satellite_name = $_POST["delete"];

            // Escape satellite name to prevent SQL injection
            $satellite_name = $conn->real_escape_string($satellite_name);

            // SQL query to delete satellite record
            $sql_delete = "DELETE FROM satellite WHERE sname = '$satellite_name'";
            
            // Execute the delete query
            if ($conn->query($sql_delete) === TRUE) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
    }
    ?>
    <button id="know-more-button">Know More</button>
    <div class="additional-details">
        <!-- Additional details table -->
        <table id="additional-details-table">
            <!-- Table headers -->
            <tr>
                <th>Contractor Name</th>
                <th>Contractor Phone</th>
                <th>Purpose</th>
                <th>Detailed Purpose</th>
                <th>Organization name</th>
                <th>Organization country</th>
                <th>Organization Phone</th>
                <th>Longitude</th>
                <th>Inclination</th>
                <th>Eccentricity</th>
                <th>Perigee</th>
                <th>Apogee</th>
            </tr>
            <!-- Table data will be filled dynamically using PHP -->
            <?php
            // Establishing database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "satellitedb";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to fetch additional details from the database
            $sql = "SELECT * FROM satellite s
                    INNER JOIN country c ON s.country_id = c.country_id
                    INNER JOIN orbit o ON s.orbit_id = o.orbit_id
                    INNER JOIN launch l ON s.launch_id=l.launch_id
                    INNER JOIN organisation org ON s.org_id=org.org_id
                    INNER JOIN contractor con ON org.con_id=con.con_id
                    INNER JOIN purpose p ON s.purpose_id=p.purpose_id
                    WHERE c.cname = '$selected_country'
                    AND o.type_of_orbit = '$selected_orbit'
                    AND s.sname = '$selected_satellite'";
            $result = $conn->query($sql);

            // Populate the table with data fetched from the database
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["con_name"]."</td>";
                    echo "<td>".$row["con_phone"]."</td>";
                    echo "<td>".$row["con_phone"]."</td>";
                    echo "<td>".$row["purpose"]."</td>";
                    echo "<td>".$row["det_purpose"]."</td>";
                    echo "<td>".$row["org_name"]."</td>";
                    echo "<td>".$row["org_phone"]."</td>";
                    echo "<td>".$row["longitude"]."</td>";
                    echo "<td>".$row["inclination"]."</td>";
                    echo "<td>".$row["eccentricity"]."</td>";
                    echo "<td>".$row["perigee"]."</td>";
                    echo "<td>".$row["apogee"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No data available</td></tr>";
            }
            $conn->close();
            ?>
        </table>

        <!-- Insert and Edit buttons -->
        <div class="button-container">
            
            <a href="editable.php"><button id="insert-button">Insert</button></a>
            
        </div>
    </div>

    <!-- Script to handle Know More button functionality -->
    <script>
        document.getElementById("know-more-button").addEventListener("click", function() {
            var additionalDetails = document.querySelector(".additional-details");
            additionalDetails.style.display = (additionalDetails.style.display === "none") ? "block" : "none";
        });
    </script>
</body>
</html>
