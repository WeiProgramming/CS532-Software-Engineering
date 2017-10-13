<?php
session_start();
$timeout = 2000; // Number of seconds until it times out.
 
// Check if the timeout field exists.
if(isset($_SESSION['timeout'])) {
    // See if the number of seconds since the last
    // visit is larger than the timeout period.
    $duration = time() - (int)$_SESSION['timeout'];
    if($duration > $timeout) {
        // Destroy the session and restart it.
	include_once("serverinfo.php");
    $conn = new mysqli($servername, $username, $password, $dbname)or die("cannot connect");
	
	if(isset($_SESSION['books'])){
	    foreach ($_SESSION["books"] as $cart_itm)
        {
           $title = $cart_itm["name"];
	       $qry1 = "update book_copy set count = count-1 where title = '$title' and count > 0";		  
                $result = $conn->query($qry1);
		}
 	}	
	unset($_SESSION['books']);
	
        session_destroy();
      //  session_start();
	  echo 'Session Expired';
	  header("location:index.php");
    }
}
 
// Update the timout field with the current time.
$_SESSION['timeout'] = time();
?>