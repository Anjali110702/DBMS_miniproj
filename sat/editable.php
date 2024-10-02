
<?php
$user = 'root';
$pass = '';
$db = 'satellitedb';
$conn = new mysqli('localhost',$user , $pass ,$db) or die("Connection failed");

$stmt = $conn->query("Select * from adminlogin;");

while($row = $stmt->fetch_assoc()){
    if (isset($_GET['name']) && isset($_GET['password'])) {
        
    if($row['admin_id'] == $_GET['name'])
    {
        if($row['password'] == $_GET['password'])
        {

           
            header("Location:insert.php");
        }
        else{
            header("Location:page1.php");
           
        }
    }
   
}
}
$conn->close();





?>
<!doctype html>
<html>
  <head>
    <title>intro</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="s2.css" />
    <link rel="stylesheet" href="./animation.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <form action="" method="get">
    <div class="parent-div">
      <div class="intro--1-1141" id="id-412">
        <div class="rectangle-1-1-829" id="id-414"></div>
        <div class="rectangle-4-1-490" id="id-417"></div>
        <input type="text"  placeholder = "Enter your Admin ID" class="rectangle-4-1-490" name = "name">
        
        <input type="password" class="rectangle-5-1-126" id="id-419" placeholder = "Enter password" name = "password">
        
        <input type="submit" value="Submit" class="rectangle-6-1-3360 submit-1-840-0" id="id-4110">
        <div class="enter-your-admi-1-416" id="id-418">
          
        </div>
       
      
        <div class="admin-login-1-468" id="id-4114">
          <span class="admin-login-1-468-0">Admin Login</span>
        </div>
      </div>
    </div>
    </form>
  </body>
</html>
