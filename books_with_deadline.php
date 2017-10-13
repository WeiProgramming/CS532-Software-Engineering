<?php
require('session.php');
if(!isset($_SESSION['username'])){
header("location:index.php");
} 

include('serverinfo.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	echo "Try Later after sometime. We encountered some error with the connection.";
     die("Connection failed: " . $conn->connect_error);
}

echo '<link href="files/bootstrap.min.css" rel="stylesheet">';
echo  '<script src="files/jquery.min.js"></script>';
echo  '<script src="files/bootstrap.min.js"></script>';

$sql = "select roll_no,book_id,loan_id,date_expected from loan_stud where DATEDIFF(DATE(date_expected),CURDATE()) < 14";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

echo '<table class="table table-hover"><tr class="success"><th>Index</th><th>Roll Number</th><th>Book ID</th><th>Loan_id</th><th>&nbspDate Expected</th></tr>';
     
    // echo "<table border='1'><tr><th>Index</th><th>Title</th><th>Author Name</th><th>Publisher Name</th><th>&nbspYear //Published</th><th>Copies</th><th>Date Arrived</th></tr>";
     // output data of each row
	 $count = 0;
     while($row = $result->fetch_assoc()) { $count++;
         echo '<tr class = "warning"><td>' . $count . "</td> <td>" . $row["roll_no"]. "&nbsp</td> <td>" . $row["book_id"]. "&nbsp</td> <td>" . $row["loan_id"]. "&nbsp</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $row["date_expected"]. "</td></tr>";
       }
     echo "</table>";
} else {
     echo "0 results";
}
