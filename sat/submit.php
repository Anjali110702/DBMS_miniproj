<?php
$user = 'root';
$pass = '';
$db = 'satellitedb';
$conn = new mysqli('localhost:4306',$user , $pass ,$db) or die("Connection failed");
session_start();
if(isset($_GET['dry_mass']) and isset($_GET['launch_mass']) and isset($_GET['power'])){
$_SESSION['dry_mass'] = $_GET['dry_mass'];
$_SESSION['launch_mass'] = $_GET['launch_mass'];
$_SESSION['power'] = $_GET['power'];
}
if(isset($_GET['confirmation'])){
if($_GET['confirmation'] == "update"){
  $stmt1 = $conn->prepare("update orbit set orbit_id=?,type_of_orbit=?,longitude=?,period=?,perigee=?,apoge=?,inclination=?,ecentricity=?;");
  $stmt2 = $conn->prepare("update purpose set purpose_id=?,purpose=?,det_purpose=?;");
  $stmt3 = $conn->prepare("update  crew set crew_id=?,crew_name=?,crew_field=?,crew_phone=?;");
  $stmt4 = $conn->prepare("update contractor set con_id=?,con_name=?,con_phone=?;");
  $stmt5 = $conn->prepare("update organisation set org_id=?,org_name=?,org_country=?,org_phone=?,crew_id=?,con_id=?;");
  $stmt6 = $conn->prepare("update country set country_id=?,cname=?,UN_registry=?,org_id=?;");
  $stmt7 = $conn->prepare("update satellite set s_id=?,sname=?,exp_lifetime=?,dry_mass=?,launch_mass=?,power=?,orbit_id=?,purpose_id=?,country_id=?,crew_id=?;");
  
  $stmt1->bind_param("isiiiiss",$_SESSION['orbit_id'],
  $_SESSION['type_of_orbit'],
  $_SESSION['longitude'],
  $_SESSION['period'],
  $_SESSION['perigee'],
  $_SESSION['apoge'],
  $_SESSION['inclination'],$_SESSION['ecentricity']);
  $stmt1->execute();
  
  
  $stmt2->bind_param("iss" , $_SESSION['purpose_id'],
  $_SESSION['purpose'] ,
  $_SESSION['det_purpose']);
  $stmt2->execute();
  
  $stmt3->bind_param("issi",$_SESSION['crew_id'],
  $_SESSION['crew_name'],
  $_SESSION['crew_field'],$_SESSION['crew_phone']);
  $stmt3-execute();
  
  $stmt4->bind_param("isi",$_SESSION['con_id'],
  $_SESSION['con_name'],
  $_SESSION['con_phone']);
  $stmt4->execute();
  
  
  $stmt5->bind_param("issiii",$_SESSION['org_id'],
  $_SESSION['org_name'],
  $_SESSION['org_country'],$_SESSION['org_phone'],$_SESSION['crew_id'],$_SESSION['con_id']);
  $stmt5->execute();
  
  $stmt6->bind_param("issi",$_SESSION['country_id'],
  $_SESSION['cname'],
  $_SESSION['UN_registry'],$_SESSION['org_id']);
  $stmt6->execute();
  
  $stmt7->bind_param("isiiiiiiii",$_SESSION['s_id'],
  $_SESSION['sname'],
  $_SESSION['exp_lifetime'],$_SESSION['dry_mass'],
  $_SESSION['launch_mass'],
  $_SESSION['power'] ,$_SESSION['org_id'],$_SESSION['purpose_id'], $_SESSION['country_id'],$_SESSION['crew_id']);
  $stmt->execute();

}
else{
$stmt1 = $conn->prepare("insert into orbit(?,?,?,?,?,?,?,?);");
$stmt2 = $conn->prepare("insert into purpose(?,?,?);");
$stmt3 = $conn->prepare("insert into crew(?,?,?,?);");
$stmt4 = $conn->prepare("insert into contractor(?,?,?);");
$stmt5 = $conn->prepare("insert into organisation(?,?,?,?,?,?);");
$stmt6 = $conn->prepare("insert into country(?,?,?,?);");
$stmt7 = $conn->prepare("insert into satellite(?,?,?,?,?,?,?,?,?,?);");

$stmt1->bind_param("isiiiiss",$_SESSION['orbit_id'],
$_SESSION['type_of_orbit'],
$_SESSION['longitude'],
$_SESSION['period'],
$_SESSION['perigee'],
$_SESSION['apoge'],
$_SESSION['inclination'],$_SESSION['ecentricity']);
$stmt1->execute();


$stmt2->bind_param("iss" , $_SESSION['purpose_id'],
$_SESSION['purpose'] ,
$_SESSION['det_purpose']);
$stmt2->execute();

$stmt3->bind_param("issi",$_SESSION['crew_id'],
$_SESSION['crew_name'],
$_SESSION['crew_field'],$_SESSION['crew_phone']);
$stmt3-execute();

$stmt4->bind_param("isi",$_SESSION['con_id'],
$_SESSION['con_name'],
$_SESSION['con_phone']);
$stmt4->execute();


$stmt5->bind_param("issiii",$_SESSION['org_id'],
$_SESSION['org_name'],
$_SESSION['org_country'],$_SESSION['org_phone'],$_SESSION['crew_id'],$_SESSION['con_id']);
$stmt5->execute();

$stmt6->bind_param("issi",$_SESSION['country_id'],
$_SESSION['cname'],
$_SESSION['UN_registry'],$_SESSION['org_id']);
$stmt6->execute();

$stmt7->bind_param("isiiiiiiii",$_SESSION['s_id'],
$_SESSION['sname'],
$_SESSION['exp_lifetime'],$_SESSION['dry_mass'],
$_SESSION['launch_mass'],
$_SESSION['power'] ,$_SESSION['orbit_id'],$_SESSION['purpose_id'], $_SESSION['country_id'],$_SESSION['crew_id']);
$stmt->execute();
}

}

?>

<!doctype html>
<html>
  <head>
    <title>intro</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="si.css" />
   
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    
    <div class="parent-div">
      <div class="intro--1-4410" id="id-372">
        <div class="rectangle-18-1-779" id="id-376"></div>

        
        <input type="text" name="dry_mass" id="" class="rectangle-19-1-1344"  placeholder = "Enter the  Dry Mass:">
        
        <input type="text" name="launch_mass" id="" class="rectangle-20-1-336"  placeholder = "Enter the  Launch Mass:">
        <div class="rectangle-21-1-2135" id="id-3712"></div>
        <input type="text" name="power" id="" class="rectangle-21-1-2135"  placeholder = " Enter the  Power:">
        
        <input type="text" name="" id="" class="rectangle-22-1-561"   placeholder = "" style ="display : none;">
        
        <input type="text" name="" id="" class="rectangle-23-1-645"   placeholder = "" style ="display : none;">
     
        <input type="text" name="" id=""  class="rectangle-24-1-160"  placeholder = "" style ="display : none;">
        
        <input type="text" name="" id="" class="rectangle-25-1-620"  placeholder = "" style ="display : none;">
      
        <input type="radio" name="confirmation" id=""  class="radio1" style = "
        transform : scale(2);
        position : relative;
        left : 30rem ;
        right : ;
        top: 30rem ;
        
          " value = "update"><p class="con1"  style = "
          position : relative;
           left :34rem ;
           right : ;
           top : 26rem;
           font-size : xx-large;
          "> Confirmation for updating the Value</p>
          <input type="radio" name="confirmation" id=""  class="radio2"  style = "
        transform : scale(2);
        transform : scale(2);
        position : relative;
        left : 30rem ;
        right : ;
        top: 30rem ;
        " value = "insert"><p  class="con2"  style = "
          position : relative;
           left :34rem ;
           right : ;
           top : 26rem;
           font-size : xx-large;

          ">Confirmation for Inserting the Value</p>
        </div>
        <div class="submit1-0-3740" id="id-3727">
          <span class="submit1-0-3740-0">Submit</span>
        </div>
      
        <a href="page1.php" class="next-1-260"><input type="submit"  value="Submit" name="" id="next"  ></a>
        <!--<button class ="next-1-260" onclick = >Submit</button>-->
      </div>
    </div>
    </form>
   
  </body>
</html>
