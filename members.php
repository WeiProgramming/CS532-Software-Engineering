<?php
require('session.php');
if(!isset($_SESSION['username'])){
header("location:index.html");

}
?>  
<!doctype html>
<html>
<head>
<title>NIT Library | Welcome to Library of NIT Raipur</title>
<link href="files/bootstrap.min.css" rel="stylesheet">
   <script src="files/jquery.min.js"></script>
   <script src="files/bootstrap.min.js"></script>
<style>

form {
    width: 500px;
    margin: 0 auto;
}
.searchtext {
                width:300px;
                margin:0 auto;
}
.searchbutton{
	width:100px;
	height:40px;
}
a:link {
    color: #ffffff;
	text-decoration: none;
}

a:visited {
    color: #ffffff;
	text-decoration: none;
}

a:hover {
    color: #ffffff;
	text-decoration: none;
}

a:active {
    color: #ffffff;
	text-decoration: none;
}

</style>
</head>
<body>

<h3 align="center">Search Book by-</h3>

<p align ="center">


 <form class="form-horizontal" role="form" name = "myForm" method = "post" action = "search.php">
 <div id="radiosearch" align="center">
<input type="radio" name="choice" value = 0 checked="checked"/> Book's Name
<input type="radio" name="choice" value =1 />Author's Name
<input type="radio" name="choice" value =2 />Publisher's Name
</div>
<br><br>
   <div class="form-group">
  <div class="col-md-12">
  <input id="searchbar" name="searchbar" type="text" placeholder="Start typing to search..." class="form-control input-md" maxlength="200"/>
    
  </div>
</div>
 <div class="form-group">
  <label class="col-md-0 control-label" for=""></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-success" >Search</button>
  </div>
</div>

</form>

<br/>
</p>
<br><br><br>
<p align="center">
<form action = "getFee.php" method = "POST" >
  <label for = "rollno">Please Input Your Roll Number</label>
  <input type="text" name="rollno">
  <button type = "submit"> Check Fee</button>
</form>
</p>

<p align="center">

  <!-- this is a static int change this -->
<a href="payment_screen.php"><button type="button" class="btn  btn-danger ">Pay Late Fee: 
  <?php 
    //replace this with a call to the transaction (new) database
  if(isset($_SESSION['DBfee'])){
    $fee = $_SESSION['DBfee'];
  }
  else{
    $fee = 000;
  }



    $formattedFee = substr_replace($fee,'.',-2,0);

    $_SESSION['lateFee'] = $fee;
    echo '$'.$formattedFee;
  ?></button></a>
<p/>

<p align="center">
<a href="view_cart.php"><button type="button" class="btn  btn-success ">View Cart</button></a>
<p/>

<p align="center">
<a href="transaction.php"><button type="button" class="btn btn-warning" data-toggle="collapse" data-target="stud_transaction">Patron Transaction</button>
<a href="student_return.php"><button type="button" class="btn btn-warning" data-toggle="collapse" data-target="stud_transaction">Patron Book Return</button>
</p>


<br><br>
<p align="center">
<a href="books_with_deadline.php"><button type="button" class="btn btn-danger">Books with their deadlines</button></a>
</p>
<p align="center">
<a href="book_entry.php"><button type="button" class="btn btn-warning">Make New Entry</button></a>
</p>
<br><br>
<p align="center">
<a href="new_arrival.php"><button type="button" class="btn btn-success"> New Arrivals</button></a>
</p>
<p align="center">
<a href="logout.php"><button type="button" class="btn btn-danger"> Logout</button></a>
</p>


</body>
</html>
