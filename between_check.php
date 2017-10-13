<?php
 require('session.php');
 
 for($i = 0;$i < $_SESSION['ct']-1;$i++){
  $c = $i +1;
 $id[$i] = $_POST[$c];
 /*$id[1] = $_POST['2'];
 $id[2] = $_POST['3'];
 $id[3] = $_POST['4'];
 $id[4]= $_POST['5'];
 $id[5] = $_POST['6']; 
 */}
 $_SESSION['id'] = $id;
 
 //echo $_SESSION['id'][0];
if($_SESSION['check_who'] == 0){
 header("location:stu_login.php");}
else
 {  header("location:fac_login.php");}
 ?>