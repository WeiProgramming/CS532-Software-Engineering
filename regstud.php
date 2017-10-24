<?php
require('session.php');
if(!isset($_SESSION['username'])){
header("location:index.php");
}
 
	require 'serverinfo.php';
	
	// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
	
	if( isset($_POST['rollno']) &&
	    isset($_POST['fullname']) && 
        isset($_POST['email']) && 
        isset($_POST['password']))
	{
		$rollno = $_POST['rollno'];
		$name = $_POST['fullname'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		
		if( !empty($rollno) &&
		!empty($name) && 
		!empty ($email) && !empty($password))
		{
				$qry = "select roll_no from students where email = '$email'";
				$result = mysqli_query( $conn,$qry );
				
				if( mysqli_num_rows($result ) == 1)
				{
					echo 'The rollno. ' . $rollno . ' already exists.';
					echo "Go to <a href=members.php> Home</a> for transaction.";
				}
				else
				{
					$qry = "insert into students values('$rollno','$name','$email','$password')";
					
					
					if(mysqli_query($conn,$qry ))
					{
						echo "Registed Successfully, Go <a href=members.php>Home</a> to register.";
					}
					else
					{
						echo 'Sorry, we could not register you this time, try again later.';
                        echo "<a href=members.php> Go Home here! </a>";
					}
				}
		}
		else{
		    echo "All fields required.";
			echo "<a href=students.html> Try again! </a>";
		  }
	}		
		

?>