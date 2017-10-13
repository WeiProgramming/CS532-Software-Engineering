<?php

	require 'serverinfo.php';
	
	// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
	
if( isset($_POST['bookname']) &&
	isset($_POST['authorname']) && 
    isset($_POST['publishername']) && 
	isset($_POST['yearpublished']) &&
	isset($_POST['copies']) )
	{
		$bookname = $_POST['bookname'];
		$authorname = $_POST['authorname'];
		$publishername = $_POST['publishername'];
		$yearpublished = $_POST['yearpublished'];
		$copies = $_POST['copies'];
		
		if( !empty($bookname) &&
		!empty($authorname) && 
		!empty ($publishername) && !empty($yearpublished) && !empty($copies))
		{	
			$sql_all = "SELECT title,author_name,publisher_name,year_published FROM authors,book_copy,publishers where book_copy.title like 
	  '%".$bookname."%' and authors.author_id = book_copy.author_id and book_copy.publisher_id = publishers.publisher_id and authors.author_name like '%".$authorname."%' and publishers.publisher_name like '%".$publishername."%' and book_copy.year_published like '%".$yearpublished."%'";
			$sql_book_author_publisher = "SELECT title,author_name,publisher_name FROM authors,book_copy,publishers where book_copy.title like 
	  '%".$bookname."%' and authors.author_id = book_copy.author_id and book_copy.publisher_id = publishers.publisher_id and authors.author_name like '%".$authorname."%' and publishers.publisher_name like '%".$publishername."%'";
			$sql_book_author = "SELECT title,author_name FROM authors,book_copy where book_copy.title like 
	  '%".$bookname."%' and authors.author_id = book_copy.author_id and authors.author_name like '%".$authorname."%'";
			$sql_book_publisher = "SELECT title,publisher_name FROM book_copy,publishers where book_copy.title like 
	  '%".$bookname."%' and book_copy.publisher_id = publishers.publisher_id and publishers.publisher_name like '%".$publishername."%'";
			$sql_book = "SELECT title FROM book_copy where book_copy.title like 
	  '%".$bookname."%'";
			$sql_publisher = "SELECT publisher_name FROM book_copy,publishers where book_copy.publisher_id = publishers.publisher_id and publishers.publisher_name like '%".$publishername."%'";
			$sql_author = "SELECT author_name FROM book_copy,authors where book_copy.author_id = authors.author_id and authors.author_name like '%".$authorname."%'";
			
			$result_all = $conn->query($sql_all);
			$result_book_author_publisher = $conn->query($sql_book_author_publisher);
			$result_book_author = $conn->query($sql_book_author);
			$result_book_publisher = $conn->query($sql_book_publisher);
			$result_book = $conn->query($sql_book);
			$result_author = $conn->query($sql_author);
			$result_publisher = $conn->query($sql_publisher);
			
			if($result_book->num_rows > 0 && $result_author->num_rows>0 && $result_publisher->num_rows> 0)
			{
				if($result_all->num_rows > 0)
				{
					//increase the number of copies.
					$query = "UPDATE `book_copy` SET `copies`= `copies` + ".$copies." where book_copy.title like '%".$bookname."%' and authors.author_id = book_copy.author_id and book_copy.publisher_id = publishers.publisher_id and authors.author_name like '%".$authorname."%' and publishers.publisher_name like '%".$publishername."%' and book_copy.year_published like '%".$yearpublished."%'";
				
					//implement $query
					$result_q = $conn->query($query);
					//select the copy_id of the book whose copies were increased in the vault
					/*$select = "select copy_id from book_copy, authors, publishers, year_published where book_copy.title like '%".$bookname."%' and authors.author_id = book_copy.author_id and book_copy.publisher_id = publishers.publisher_id and authors.author_name like '%".$authorname."%' and publishers.publisher_name like '%".$publishername."%' and book_copy.year_published like '%".$yearpublished."%'";
					$result_select = $conn->query($select);*/
				
					//$query_1 = "select copies from book_copy, books where not exists(SELECT copy_id FROM book_copy WHERE books.copy_id = book_copy.copy_id)";
					$query_2 = "select copy_id from book_copy, books where not exists(SELECT copy_id FROM book_copy WHERE books.copy_id = book_copy.copy_id)";
					//$result_1 = $conn->query($query_1);
					$result_2 = $conn->query($query_2);
					$query_again = "INSERT INTO `books`(`copy_id`) VALUES ('$result_2')";
					$temp = $copies;
					//inserting these no. of copies in the books table.
					while($temp--)
					{
						$result_again = $conn->query($query_again);
					}
				}
				else
				{
					//make a new row in book_copy table with new year published attr ans copies attr as new.
					$query = "INSERT INTO `book_copy`(`title`, `publisher_id`, `author_id`, `year_published`, `copies`) VALUES ('$bookname','$publishername' ,'$authorname', '$yearpublished', '$copies')";
					$result_q = $conn->query($query);
				
					//selecting the no. of copies(copies) and copy_id which are not in books table but inserted now in book_copy
					//$query_1 = "select copies from book_copy, books where not exists(SELECT copy_id FROM book_copy WHERE books.copy_id = book_copy.copy_id)";
					$query_2 = "select copy_id from book_copy, books where not exists(SELECT copy_id FROM book_copy WHERE books.copy_id = book_copy.copy_id)";
					//$result_1 = $conn->query($query_1);
					$result_2 = $conn->query($query_2);
					$query_again = "INSERT INTO `books`(`copy_id`) VALUES ('$result_2')";
					$temp = $copies;
					//inserting these no. of copies in the books table.
					while($temp--)
					{
						$result_again = $conn->query($query_again);
					}
				}
			}
			else
			{
				if($result_author->num_rows > 0 && $result_publisher->num_rows > 0)
				{}
				else if($result_author->num_rows > 0)
				{
					//insert a publisher in the publisher table.
					$query_publisher = "INSERT INTO `publishers`(`publisher_name`) VALUES ('$publishername')";
					//make a new row with new publisher data and year published.
					$result_qpub = $conn->query($query_publisher);
				}
				else if($result_publisher->num_rows > 0)
				{
					//insert an author in the author table.
					$query_author = "INSERT INTO `authors`(`author_name`) VALUES ('$authorname')";
					//make a new row with new author details and year published.
					$result_qauth = $conn->query($query_author);
				}
				else
				{
					//insert a publisher in the publisher table.
					$query_publisher = "INSERT INTO `publishers`(`publisher_name`) VALUES ('$publishername')";
					//make a new row with new publisher data and year published.
					$result_qpub = $conn->query($query_publisher);
					//insert an author in the author table.
					$query_author = "INSERT INTO `authors`(`author_name`) VALUES ('$authorname')";
					//make a new row with new author details and year published.
					$result_qauth = $conn->query($query_author);
				}	
				//make a new entry with everything except the book's title is new
				$query = "INSERT INTO `book_copy`(`title`, `publisher_id`, `author_id`, `year_published`, `copies`) VALUES ('$bookname','$publishername' ,'$authorname', '$yearpublished', '$copies')";
				$result_q = $conn->query($query);
				//$query_1 = "select copies from book_copy, books where not exists(SELECT copy_id FROM book_copy WHERE books.copy_id = book_copy.copy_id)";
				$query_2 = "select copy_id from book_copy, books where not exists(SELECT copy_id FROM book_copy WHERE books.copy_id = book_copy.copy_id)";
				//$result_1 = $conn->query($query_1);
				$result_2 = $conn->query($query_2);
				$query_again = "INSERT INTO `books`(`copy_id`) VALUES ('$result_2')";
				$temp = $copies;
				//inserting these no. of copies in the books table.
				while($temp--)
				{
					$result_again = $conn->query($query_again);
				}	
				
			}
		}
	}
			/*else if($result_author->num_rows > 0)
			{
				//insert a publisher in the publisher table.
				$query_publisher = "INSERT INTO `publishers`(`publisher_name`) VALUES ('$publishername')";
				//make a new row with new publisher data and year published.
				$result_qpub = $conn->query($query_publisher);
				$query = "INSERT INTO `book_copy`(`title`, `publisher_id`, `author_id`, `year_published`, `copies`) VALUES ('$bookname','$publishername' ,'$authorname', '$yearpublished', '$copies')";
				$result_q = $conn->query($query);
				//selecting the no. of copies(copies) and copy_id which are not in books table but inserted now in book_copy
				$query_1 = "select copies from book_copy, books where not exists(SELECT copy_id FROM book_copy WHERE books.copy_id = book_copy.copy_id)";
				$query_2 = "select copy_id from book_copy, books where not exists(SELECT copy_id FROM book_copy WHERE books.copy_id = book_copy.copy_id)";
				$result_1 = $conn->query($query_1);
				$result_2 = $conn->query($query_2);
				$query_again = "INSERT INTO `books`(`copy_id`) VALUES ('$result_2')";
				$temp = $result_1;
				//inserting these no. of copies in the books table.
				while($temp--)
				{
					$result_again = $conn->query($query_again);
				}
			}*/
			/*else if($result_publisher->num_rows > 0)
			{
				//insert an author in the author table.
				$query_author = "INSERT INTO `authors`(`author_name`) VALUES ('$authorname')";
				//make a new row with new author details and year published.
				$result_qauth = $conn->query($query_author);
				$query = "INSERT INTO `book_copy`(`title`, `publisher_id`, `author_id`, `year_published`, `copies`) VALUES ('$bookname','$publishername' ,'$authorname', '$yearpublished', '$copies')";
				$result_q = $conn->query($query);
				//selecting the no. of copies(copies) and copy_id which are not in books table but inserted now in book_copy
				$query_1 = "select copies from book_copy, books where not exists(SELECT copy_id FROM book_copy WHERE books.copy_id = book_copy.copy_id)";
				$query_2 = "select copy_id from book_copy, books where not exists(SELECT copy_id FROM book_copy WHERE books.copy_id = book_copy.copy_id)";
				$result_1 = $conn->query($query_1);
				$result_2 = $conn->query($query_2);
				$query_again = "INSERT INTO `books`(`copy_id`) VALUES ('$result_2')";
				$temp = $result_1;
				//inserting these no. of copies in the books table.
				while($temp--)
				{
					$result_again = $conn->query($query_again);
				}
			}*/
			
			/*else if($result_author->num_rows > 0)
			{
				//make a complete new entry with author existing
				$query = "INSERT INTO `book_copy`(`title`, `publisher_id`, `author_id`, `year_published`, `copies`) VALUES ('$bookname','$publishername' ,'$authorname', '$yearpublished', '$copies')";
			}
			else if($result_publisher->num_rows > 0)
			{
				//make a complete new entry with publisher existing
				$query = "INSERT INTO `book_copy`(`title`, `publisher_id`, `author_id`, `year_published`, `copies`) VALUES ('$bookname','$publishername' ,'$authorname', '$yearpublished', '$copies')";
			}
			else
			{
				//make a whole new entry
				$query = "INSERT INTO `book_copy`(`title`, `publisher_id`, `author_id`, `year_published`, `copies`) VALUES ('$bookname','$publishername' ,'$authorname', '$yearpublished', '$copies')";
			}*/
?>
			