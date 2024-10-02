<?php
session_start();
$user = 'root';
$pass = '';
$db = 'satellitedb';
$conn = new mysqli('localhost',$user , $pass ,$db) or die("Connection failed");
$name = $_GET['ename'];
$pass = $_GET['password'];
$stmt = $conn->query("Select CONCAT(Fname,' ',Lname) as name,password from logins;");
while($row = $stmt->fetch_assoc()){
    if($row['name'] == $name)
    {
        if($row['password'] == $pass)
        {

            $username = $_GET['ename'];
            $_SESSION['username'] = $username;
            header("Location:page1.php?username=".urlencode($username));
        }
        else{
            header("Location:index.htm");
            echo "<script> alter('Enter the correct password:')";
        }
    }
    else{
        header("Location:index.htm");
        echo "<script> alter('Enter the correct Username and Password:')";
    }
}












?>