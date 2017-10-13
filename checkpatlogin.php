<?php
session_start();
require 'serverinfo.php';
//$tbl_name="members"; // Table name 

// Connect to server and select databse.
$conn = new mysqli($servername, $username, $password, $dbname) or die("cannot connect"); 


// username and password sent from form 
$myusername=$_POST['email']; 
$mypassword= md5($_POST['key']); 
//$tbl_name  =$_POST['whois'];

//echo $myusername.'<br>';
//echo $mypassword;

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($conn, $myusername);
$mypassword = mysqli_real_escape_string($conn, $mypassword);

$sql="SELECT * FROM students WHERE email='$myusername' and password='$mypassword'";


$result = mysqli_query($conn, $sql);

// Mysql_num_row is counting table row
$count = mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['username'] = $myusername; 
$_SESSION['password'] = $mypassword;
header("location:members.php");
}
else {
echo '<a href ="index.php" >Wrong Username or Password,Click to go back</a>';

}

?>