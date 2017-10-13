<?php
    require 'session.php';
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
	isset($_POST['copies']) &&
	isset($_POST['shelf']) &&
	isset($_POST['rack_number']) &&
	isset($_POST['price']))
	{
		$bookname = $_POST['bookname'];
		$authorname = $_POST['authorname'];
		$publishername = $_POST['publishername'];
		$yearpublished = $_POST['yearpublished'];
		$copies = $_POST['copies'];
		$shelf = $_POST['shelf'];
		$rack_number = $_POST['rack_number'];
		$price = $_POST['price'];
		
		if( !empty($bookname) &&
		!empty($authorname) && 
		!empty ($publishername) && !empty($yearpublished) && !empty($copies) && !empty($shelf) && !empty($rack_number) && !empty($price))
		{	
		 $qry = "Select count(author_id) from authors where author_name = '$authorname'";
         $res1 = $conn->query($qry);
         $row1 = $res1->fetch_array();
         if($row1[0] == 0)
         {
		   $q1 = "Insert into authors(author_name)  values ('$authorname')";
		   $r1 = $conn->query($q1);
		   $q2 = "Select author_id from authors where author_name = '$authorname'";
           $r2 = $conn->query($q2);		 
		   $rAuthorID = $r2->fetch_array(); 
		   $Aut_ID =  $rAuthorID[0];
		 }
         else
        {
          $q3 = "Select author_id from authors where author_name = '$authorname'";
           $r3 = $conn->query($q3);		 
		   $rAuthorID1 = $r3->fetch_array(); 
		   $Aut_ID =  $rAuthorID1[0];
		   
		}
        
         $qy = "Select count(publisher_id) from publishers where publisher_name = '$publishername'";
         $rs1 = $conn->query($qy);
         $rw1 = $rs1->fetch_array();
         if($rw1[0] == 0)
         {
		   $qw1 = "Insert into publishers(publisher_name)  values ('$publishername')";
		   $rw1 = $conn->query($qw1);
		   $qw2 = "Select publisher_id from publishers where publisher_name = '$publishername'";
           $rw2 = $conn->query($qw2);		 
		   $rPublisherID = $rw2->fetch_array(); 
		   $Pub_ID =  $rPublisherID[0];
		 }
         else
        {
          $qw3 = "Select publisher_id from publishers where publisher_name = '$publishername'";
           $rw3 = $conn->query($qw3);		 
		   $rPublisherID1 = $rw3->fetch_array(); 
		   $Pub_ID =  $rPublisherID1[0];
		}
		
		$p = "Select count(title) from book_copy where author_id = '$Aut_ID' and publisher_id='$Pub_ID' and title = '$bookname' and year_published = '$yearpublished'";
		$a = $conn->query($p);
		$title_count =  $a->fetch_array();
		//$tt_count = $title_count[0];
		
		if($title_count[0] == 0)
		{ echo 'hey';
		  echo $bookname.$Pub_ID.$Aut_ID.$yearpublished.$copies.$shelf.$rack_number.$price;
		  $p1 = "Insert into book_copy(title,publisher_id,author_id,year_published,copies,Shelf,Rack_Number,Price_per_copy,count) values('$bookname','$Pub_ID','$Aut_ID','$yearpublished','$copies','$shelf','$rack_number','$price',0)";
		  $a1 = $conn->query($p1);
		  //$p32 = "Update book_copy set count = 0 where author_id='$Aut_ID' and //publisher_id='$Pub_ID'";
		 // $a32 = $conn->query($p32);
		  
		  $p2 = "select copy_id from book_copy where author_id='$Aut_ID' and publisher_id='$Pub_ID'";
		  $a2 = $conn->query($p2);
		  $cp_id = $a2->fetch_array();
		  $cpid = $cp_id[0];
		  $p3 = "Insert into books(copy_id) values('$cpid')";
		  for($i=1;$i<=$copies;$i++)
		   {
		   $a3 = $conn->query($p3);
		  }
		}
        else
        {
           $p4 = "Update book_copy set copies = copies + $copies where author_id = '$Aut_ID' and publisher_id='$Pub_ID' and title = '$bookname' and year_published = '$yearpublished'";  
           $a4 = $conn->query($p4);
		   
            $p5 = "Select copy_id from book_copy where author_id = '$Aut_ID' and publisher_id='$Pub_ID' and title = '$bookname' and year_published = '$yearpublished'";  
            $a5 = $conn->query($p5);
           $cp_id  = $a5->fetch_array();
           	$cpid = $cp_id[0]; 	   
		   $p6 = "Insert into books(copy_id) values('$cpid')";
		   for($i=1;$i<=$copies;$i++)
		   {
		   $a6 = $conn->query($p6);
		   }
		}
	}
	}
	//header("refresh:5,url=members.php");
?>		