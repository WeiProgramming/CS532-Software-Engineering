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

//$diff->format("%R%a") < 60 and $date1=(SELECT date_arrived FROM books) and $diff=date_diff($date1,$date2)

$sql = "select title,author_name,publisher_name,year_published,copies,date_arrived from authors,
publishers,book_copy,books where DATEDIFF(CURDATE(),DATE(date_arrived)) < 100 and publishers.publisher_id = book_copy.publisher_id and authors.author_id = book_copy.author_id and books.copy_id = book_copy.copy_id group by title";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

echo '<table class="table table-hover"><tr class="success"><th>Index</th><th>Title</th><th>Author Name</th><th>Publisher Name</th><th>&nbspYear Published</th><th>Copies</th><th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspDate Arrived</th></tr>';
     
    // echo "<table border='1'><tr><th>Index</th><th>Title</th><th>Author Name</th><th>Publisher Name</th><th>&nbspYear //Published</th><th>Copies</th><th>Date Arrived</th></tr>";
     // output data of each row
	 $count = 0;
     while($row = $result->fetch_assoc()) { $count++;
         echo '<tr class = "warning"><td>' . $count . "</td> <td>" . $row["title"]. "&nbsp</td> <td>" . $row["author_name"]. "&nbsp</td> <td>" . $row["publisher_name"]. "&nbsp</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $row["year_published"]. "</td> <td>" . $row["copies"].  "</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $row["date_arrived"]. "</td></tr>";
       }
     echo "</table>";
} else {
     echo "0 results";
}
?>