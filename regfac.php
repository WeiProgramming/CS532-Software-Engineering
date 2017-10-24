<?php
require('session.php');
// if(!isset($_SESSION['username'])){
// header("location:index.php");
// }

	require 'serverinfo.php';
	
	// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
	
	if( isset($_POST['facultyID']) &&
	isset($_POST['fullname']) && 
    isset($_POST['email']) && 
    isset($_POST['department']) &&
    isset($_POST['position'])  &&
	isset($_POST['password']))
	{
	
		$facultyID = $_POST['facultyID'];
		$name = $_POST['fullname'];
		$email = $_POST['email'];
		$department = $_POST['department'];
		$position = $_POST['position'];
		$password = md5($_POST['password']);
		
		if( !empty($facultyID) &&
		!empty($name) && 
		!empty($email) && !empty($department) && !empty($position) && !empty($password))
		{
				$qry = "select faculty_id from teachers where email = '$email'";
				$query_run = mysqli_query( $conn,$qry );
				
				if( mysqli_num_rows( $query_run ) == 1)
				{
					echo 'The facultyID. ' . $facultyID . ' already exists.';
					echo "Go to <a href=index.html> Home</a> for transaction.";
				}
				else
				{
					$qry = "insert into teachers values('$facultyID','$name','$department', '$email', '$password', '$position')";
					
					
					if(mysqli_query($conn, $qry ))
					{
						echo "Registed Successfully, Go <a href=members.php>Home</a> to register.";
					}
					else
					{
						echo 'Sorry, we could not register 
							you this time, try again later.';
						echo "<a href=members.php> Go Home here! </a>";
					}
				}
		}		
		else
		{
			echo "All fields required.";
			echo "<a href=faculty.html> Try again! </a>";
		}
	}

?>