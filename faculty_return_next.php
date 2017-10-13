<?php
require('session.php');

include('serverinfo.php');
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['faculty_id']) && isset($_POST['bookid'])) {

  $rn =  $_POST['faculty_id'];
  $bk =  $_POST['bookid'];
  $dm =  $_POST['damage'];
 
  $sql = "Select * from loan_faculty where faculty_id = '$rn' and book_id = '$bk' and date_returned is Null";
  $results = $conn->query($sql);

  if($results->num_rows > 0){
  $q12 = "select Price_per_copy from book_copy,books,loan_faculty where loan_faculty.book_id = books.book_id and books.copy_id = book_copy.copy_id";
  $res12 = $conn->query($q12);
  $row1 = $res12->fetch_array();
  $dm = ($dm * $row1[0])/100;  
  $q1 = "update loan_faculty set date_returned = CURDATE(),fine = $dm where faculty_id = '$rn' and book_id = '$bk'";
  $res = $conn->query($q1);
  $q2 = "update book_copy,books set book_copy.copies = copies+1 where books.book_id='$bk' and books.copy_id = book_copy.copy_id";
  $res1 = $conn->query($q2);  
  $qry = "update loan_faculty set fine = fine + 10*(DATEDIFF(CURDATE(),DATE(date_expected))) where faculty_id = '$rn' and book_id = '$bk' and (DATEDIFF(CURDATE(),DATE(date_expected)))>0";
   $result = $conn->query($qry);
   
   echo 'Book returned';
   header("refresh:5,url=members.php");
   }
   else{
    echo 'wrong book id or roll no';
    header("refresh:5,url=faculty_return.php");
   }
 }
else{ 
 echo 'enter something';
header("refresh:5,url=faculty_return.php"); 
  }
?>  