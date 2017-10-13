<?php 
require('session.php');
include('serverinfo.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

if(isset($_SESSION["books"]))
    {
	    $total = 0;
		echo '<form method="post" action="process.php">';
		echo '<ul>';
		$cart_items = 0;
		foreach ($_SESSION["books"] as $cart_itm)
        {
           $title = $cart_itm["name"];
		   $author_name  = $cart_itm["author"];
		   $publisher_name = $cart_itm["publisher"];
		   $year_published = $cart_itm["year"];
	$results = $conn->query("update authors,publishers,book_copy set book_copy.count = 0 WHERE book_copy.title = '$title' and
	authors.author_name = '$author_name'	and publishers.publisher_name = '$publisher_name'  and 
	authors.author_id = book_copy.author_id and book_copy.publisher_id = publishers.publisher_id");							  		   
	}
  }	
session_destroy();
header("location:index.php");
?>