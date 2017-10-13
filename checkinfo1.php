<?php
require 'session.php';
require 'serverinfo.php';
if(!isset($_SESSION['username'])){
       header("location:index.php");  
    }

echo '<link href="files/bootstrap.min.css" rel="stylesheet">';
echo  '<script src="files/jquery.min.js"></script>';
echo  '<script src="files/bootstrap.min.js"></script>';

// Connect to server and select databse.
$conn = new mysqli($servername, $username, $password, $dbname)or die("cannot connect"); 


$fac_no = $_POST['fac_no']; 
$sql="SELECT * FROM teachers WHERE faculty_id='$fac_no'";

$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);

if($count == 1){
$_SESSION['fac_no'] = $fac_no;
echo 'Faculty ID Number valid<br>';

$qry = "Select count(faculty_id) from loan_faculty where faculty_id='$fac_no' and date_returned is null";
$result1 = mysqli_query($conn,$qry);
$row1 = $result1->fetch_array();
//echo $row1[0];
$number = 6-$row1[0];
echo 'You can issue '.$number.' books<br>';
$_SESSION['number'] = $number;
$_SESSION['check_who'] = 1;
echo '<iframe src="view_cart.php" width="1000" height="500"></iframe>';
echo '<br><br>';
echo '<a href = "between.php"><button type = "submit" class="btn  btn-success "   value = "proceed">Proceed</button></a>';



}
?> 