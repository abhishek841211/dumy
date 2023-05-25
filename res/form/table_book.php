<?php

require_once 'connection.php';
// print_r($_POST);
 
if(isset($_POST['submit']))
{
    $c_name=$_POST['c_name'];
    $email_id=$_POST['email_id'];
    $mobile_no=$_POST['mobile_no'];
    $c_date=$_POST['date'];
    $time=$_POST['time'];
    $people=$_POST['people'];
    $message=$_POST['message'];
   
 $sql="INSERT INTO book_table(c_name, email_id, mobile_no, c_date, time, people, message) 
 VALUES ('$c_name',' $email_id',' $mobile_no','$c_date','$time',' $people',' $message')";
   
    $res=mysqli_Query($con,$sql);
   if($res==true)
   {
      echo "<script>window.location='../index.php'</script>";
   }
   
}

?>

