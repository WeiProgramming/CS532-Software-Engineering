<?php
session_start();
if(!isset($_SESSION['username'])){
header("location:index.php");
}
include('serverinfo.php');
?>
<!doctype html>
<html>
<head>
<title>Add books</title>
<link href="files/bootstrap.min.css" rel="stylesheet">
   <script src="files/jquery.min.js"></script>
   <script src="files/bootstrap.min.js"></script>
<style>
</style>
</head>

<body>
	<h3 align="center">New Book Entry Panel</h3>
	<br><br>
	<form class="form-horizontal container" role="form" method="post" action="bk entry.php">
   <div class="form-group">
      <label for="bookname" class="col-sm-2 control-label">Book Name</label>
      <div class="col-sm-10">
         <input type="text" class="form-control" name="bookname" 
            placeholder="Concepts of Physics">
      </div>
   </div>
   <div class="form-group">
      <label for="authorname" class="col-sm-2 control-label">Author(s) Name</label>
      <div class="col-sm-10">
         <input type="text" class="form-control" name="authorname" 
            placeholder="HC Verma">
      </div>
   </div>
   <div class="form-group">
      <label for="publishername" class="col-sm-2 control-label">Publisher Name</label>
      <div class="col-sm-10">
         <input type="text" class="form-control" name="publishername" 
            placeholder="Bharti Bhawan">
      </div>
   </div>
   <div class="form-group">
      <label for="yearpublished" class="col-sm-2 control-label">Year of Publishing </label>
      <div class="col-sm-10">
         <input type="number" class="form-control" name="yearpublished" 
            placeholder="2014">
      </div>
   </div>
   <div class="form-group">
      <label for="copies" class="col-sm-2 control-label">No. of Copies</label>
      <div class="col-sm-10">
         <input type="number" class="form-control" name="copies" 
            placeholder="10">
      </div>
   </div>
   <div class="form-group">
      <label for="copies" class="col-sm-2 control-label">Price per Copy</label>
      <div class="col-sm-10">
         <input type="number" class="form-control" name="price" 
            placeholder="100">
      </div>
   </div>
   <div class="form-group">
      <label for="shelf" class="col-sm-2 control-label">Shelf(eg A)</label>
      <div class="col-sm-10">
         <input type="text" class="form-control" name="shelf" 
            placeholder="A">
      </div>
   </div>
   <div class="form-group">
      <label for="authorname" class="col-sm-2 control-label">Rack Number</label>
      <div class="col-sm-10">
         <input type="number" class="form-control" name="rack_number" 
            placeholder="1">
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-success">Add to the Vault</button>
      </div>
   </div>
</form>
</body>
</html>