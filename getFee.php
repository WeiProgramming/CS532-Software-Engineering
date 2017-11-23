<?php
require('session.php');
require 'serverinfo.php';
if(!isset($_SESSION['username'])){
       header("location:members.php");  
 }

$conn = new mysqli($servername, $username, $password, $dbname)or die("cannot connect"); 


$roll_no = $_POST['rollno']; 
$sql="SELECT * FROM loan_stud WHERE roll_no='$roll_no'";
$insertFee = "UPDATE loan_stud SET fine = 500 WHERE roll_no = '$roll_no'";

if (empty($_POST['rollno'])){
	header("location:members.php");  
}

$result = mysqli_query($conn,$sql);
$date = date("Y-m-d h:i:sa");
$totalFee = 0;

//check which books are overdue

while($row = mysqli_fetch_array($result)){
	$timeCheckedOut = strtotime($row['date_expected']);

	if($timeCheckedOut < strtotime($date) && ($row['date_returned'] == NULL )){
		if($row['fine']== NULL){
			mysqli_query($conn,$insertFee);
			$totalFee = $row['fine'];
		}
		else{
			mysqli_query($conn,$insertFee);
			$totalFee = $row['fine'];
		}
		$_SESSION['DBfee'] = $totalFee;
		echo '<a href ="members.php" >You have Outstanding Fees Please Pay it,Click to go back to your user page</a>';
	}
	else{
		$_SESSION['DBfee'] = 000;
		echo '<a href ="members.php" >Congrats you have no fees to pay!,Click to go back to your user page</a>';
	}
}



//check if the book hasn't been returned yet

//notify they are overdue if number expected is greater than date recieved

//redirect to a page that says they have over due books with an updated fee in members.php

?>