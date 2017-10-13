<?php
require('session.php');;
include_once("serverinfo.php");
$conn = new mysqli($servername, $username, $password, $dbname)or die("cannot connect");

//empty cart by destroying current session
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1)
{
	$return_url = base64_decode($_GET["return_url"]); //return url
	if(isset($_SESSION['books'])){
	foreach ($_SESSION["books"] as $cart_itm)
        {
           $title = $cart_itm["name"];
	       $qry1 = "update book_copy set count = count-1 where title = '$title' and count > 0";		  
                $result = $conn->query($qry1);
		}
 	}	
	unset($_SESSION['books']);
	header('Location:view_cart.php');
}

//add item in shopping cart
if(isset($_POST["title"]))
{
	$title 	        = filter_var($_POST["title"], FILTER_SANITIZE_STRING); //title of book
	$author_name    = filter_var($_POST["author_name"], FILTER_SANITIZE_STRING);
	$publisher_name = filter_var($_POST["publisher_name"], FILTER_SANITIZE_STRING);
	$year_published = filter_var($_POST["year_published"], FILTER_SANITIZE_NUMBER_INT); //year published
//	$return_url 	= base64_decode($_POST["return_url"]); //return url
//	echo $title;
	//limit quantity for single product
//	if($title > 1){
	//	die('<div align="center">This library does not allowed to issue a book more than once!<br /><a href="members.php">Back To Search Page</a>.</div>');
//	}

	//MySqli query - get details of item from db using product code
	$results = $conn->query("SELECT title,author_name,publisher_name,year_published from authors,publishers,book_copy WHERE book_copy.title = '$title' and
	authors.author_name = '$author_name'	and publishers.publisher_name = '$publisher_name' and book_copy.copies > 1 and 
	authors.author_id = book_copy.author_id and book_copy.publisher_id = publishers.publisher_id");							  
	$obj = $results->fetch_object();
	
	if ($results) { //we have the book info 
		
		//prepare array for the session variable
		$new_book = array(array('name'=>$title, 'author'=>$author_name, 'publisher'=>$publisher_name, 'year'=>$year_published));
		$qry1 = "update book_copy set count = count+1 where title = '$title'";		  
                    $result1 = $conn->query($qry1);
					
		if(isset($_SESSION["books"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["books"] as $cart_itm) //loop through session array
			{
				if(($cart_itm["name"] == $title) && ($cart_itm["author"] == $author_name)){ //the item exist in array

				//	$book[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$product_qty, 'price'=>$cart_itm["price"]);
				die('<div align="center">This library does not allowed to issue a book more than once!<br /><a href="members.php">Back To Search Page</a>.</div>');
					$found = true;
				}else{
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$book[] = array('name'=>$cart_itm["name"], 'author'=>$cart_itm["author"], 'publisher'=>$cart_itm["publisher"], 'year'=>$cart_itm["year"]);
				}
			}
			
			if($found == false) //we didn't find item in array
			{
				//add new user item in array
				$_SESSION["books"] = array_merge($book, $new_book);
			}else{
				//found user item in array list, and increased the quantity
			//	$_SESSION["books"] = $book;
			}
			
		}else{
			//create a new session var if does not exist
			$_SESSION["books"] = $new_book;
		}
		
	}
	
	//redirect back to original page
	header('Location:view_cart.php');
}

//remove item from shopping cart
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["books"]))
{
	$title 	= $_GET["removep"]; //get the product code to remove
//	$return_url = base64_decode($_GET["return_url"]); //get return url

	
	foreach ($_SESSION["books"] as $cart_itm) //loop through session array var
	{
		if($cart_itm["name"]!=$title){ //item does,t exist in the list
			$book[] = array('name'=>$cart_itm["name"], 'author'=>$cart_itm["author"], 'publisher'=>$cart_itm["publisher"], 'year'=>$cart_itm["year"]);
		}
		else{
		$qry1 = "update book_copy set count = count-1 where title = '$title' and count > 0";		  
                $result = $conn->query($qry1);}
		
		//create a new product list for cart
		$_SESSION["books"] = $book;
	}
	
	//redirect back to original page
	header('Location:view_cart.php');
}
?>