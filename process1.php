<?php

session_start();
include_once("serverinfo.php");
if(!isset($_SESSION['username'])){
       header("location:index.php");  
    }

$conn = new mysqli($servername, $username, $password, $dbname)or die("cannot connect");

	if(isset($_SESSION["books"]))
    {
	    $count =1;$c = 0;
		$flag = 0;
		foreach ($_SESSION["books"] as $cart_itm)
        {
           $title = $cart_itm["name"];
		   $author_name  = $cart_itm["author"];
		   $publisher_name = $cart_itm["publisher"];
		   $year_published = $cart_itm["year"];
	       
           if($_SESSION['number'] < $count){
		                 if($flag == 0){
						                echo "you can't issue more<br>";$flag =1;} 
										header("refresh:5,url=members.php");}
		   else{$count++;
		   $book_id = $_SESSION['id'][$c];$c++;
		   $rn = $_SESSION['faculty_id'];
		   
		  $date1 = strtotime("+65 day", strtotime(date("Y-m-d")));
           $date1 = date("Y-m-d", $date1);
	//	echo 'sdf';
	
	    $q1 = "Select * from books where book_id = '$book_id'";
	    $result = $conn->query($q1);
	    if($result->num_rows > 0){
          $qry = "update book_copy set copies = copies-1 where title = '$title' and copies > 1";		  
		  $result = $conn->query($qry);
		        $qry1 = "update book_copy set count = count-1 where title = '$title' and count > 0";		  
                $result = $conn->query($qry1);
		   $sql = "INSERT INTO loan_faculty (book_id, faculty_id, date_expected) VALUES ('$book_id', '$rn', '$date1')";
		   
		   $result = $conn->query($sql);
           if($flag == 0){
		   echo 'Success';$flag = 1;
		   unset($_SESSION['books']);
           header("refresh:5,url=members.php");}
		   }
          else{ 
            echo '<a href = "between.php"><strong>Wrong book_id , Click to go back</strong></a>'; 
			}
        }
      }
	}
else{
echo 'session_cache_expire';
}
?>