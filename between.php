<?php
require('session.php');
echo '<link href="files/bootstrap.min.css" rel="stylesheet">';
echo  '<script src="files/jquery.min.js"></script>';
echo  '<script src="files/bootstrap.min.js"></script>';


if(isset($_SESSION["books"]))
    {  
	    $count =1;
		$flag = 0;
		echo '<form name = form1 action ="between_check.php" method = "post">';
		echo '<table class="table table-hover"><tr class="success"><th>Index</th><th>Title</th><th>Author Name</th><th>Publisher Name</th><th>&nbspYear Published</th><th>Book ID</th></tr>';
		foreach ($_SESSION["books"] as $cart_itm)
        {
           $title = $cart_itm["name"];
		   $author_name  = $cart_itm["author"];
		   $publisher_name = $cart_itm["publisher"];
		   $year_published = $cart_itm["year"];
		   
		   
		   
		   echo '<tr class = "danger"><td>' . $count . "</td> <td>" . $title. "&nbsp</td> <td>" . $author_name. "&nbsp</td> 
		           <td>" . $publisher_name. "&nbsp</td>
				   <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $year_published. '</td> 
				   
				     <input type="hidden" value="'.$title.'" name="title"  />
					 <input type="hidden" value="'.$author_name.'" name="author_name"  />
					 <input type="hidden" value="'.$publisher_name.'" name="publisher_name"  />
					 <input type="hidden" value="'.$year_published.'" name="year_published"  />
     				 <td><input type="text"   name= '.$count.'   /></td>';
	    $count++;
		$_SESSION['ct'] = $count;
		}
		echo '<button type = "submit" class= "btn btn-success" >Final Checkout</button>';
		echo '</form>';
	}
else{
  echo 'session_cache_expire';
  header("location:members.php");  
	}
	
?>	