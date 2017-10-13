<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Books</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<div class="shopping-cart">
<h2>Your Books</h2>
<?php
require('session.php');
if(isset($_SESSION["books"]))
{  
    $total = 0;
    echo '<ol>';
    foreach ($_SESSION["books"] as $cart_itm)
    {
        echo '<li class="cart-itm">';
                echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["name"].'&return_url="cart.php">&times;</a></span>';

        echo '<h3>'.$cart_itm["name"].'</h3>';
        echo '<div class="p-code">Author : '.$cart_itm["author"].'</div>';
        echo '<div class="p-qty">Publisher : '.$cart_itm["publisher"].'</div>';
		echo '<div class="p-qty">Year Published : '.$cart_itm["year"].'</div>';
        echo '</li>';
    }
    echo '</ol>';
    echo '<span class="check-out-txt"><strong>Proceed to transaction</strong> <a href="view_cart.php">Check-out!</a></span><br>';
	echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url="cart.php">Empty Cart</a></span>';
}else{
    echo 'Your Cart is empty';
	echo '<a href="members.php">Click to return</a>'; 
}
?>
</div>
    
</div>

</body>
</html>

