<?php

require 'session.php';
require 'serverinfo.php';
if(!isset($_SESSION['username'])){
       header("location:index.php");  
    } 

// Connect to server and select databse.
$conn = new mysqli($servername, $username, $password, $dbname)or die("cannot connect"); 


// username and password sent from form 
$myusername=$_POST['rollNO']; 
$mypassword= md5($_POST['password']); 


$sql = "SELECT * FROM teachers WHERE faculty_id = $myusername and password='$mypassword'";
$result = mysqli_query($conn, $sql);

// Mysql_num_row is counting table row
$count = mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count == 1){
$_SESSION['faculty_id'] = $myusername;
header("location:process1.php");
}
else{
echo '<a href ="fac_login.php" >Wrong Username or Password,Click to go back</a>';
}
?>