<?php
$user = 'root';
$pass = '';
$db = 'satellitedb';
$conn = new mysqli('localhost',$user , $pass ,$db) or die("Connection failed");
$Fname = $_GET['fname'];
$Lname = $_GET['lname'];
$email = $_GET['email'];
$password = $_GET['pass'];

$stmt = $conn->prepare("insert into logins (Fname, Lname, email, password) values(?,?,?,?);");
$stmt->bind_param('ssss',$Fname,$Lname,$email,$password);
$stmt->execute();
if($stmt->affected_rows >0){
  
    header("Location: index.htm");
}
else{
    echo  "<script>alert('Enter the correct information.');</script>";
}







$stmt->close();
$conn->close();

?>