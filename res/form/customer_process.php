<?php
require_once 'connection.php';
// print_r($_POST);
 
if(isset($_POST['submit']))
{
    $c_name=$_POST['c_name'];
    $mobile_no=$_POST['mobile_no'];
    $message=$_POST['message'];
    $email=$_POST['email'];

 $sql="INSERT INTO customer(c_name,mobile_no,address,email,status)
    VALUES ('$c_name','$mobile_no','$message','$email','ACTIVE')";
   
    $res=mysqli_Query($con,$sql);
   if($res)
   {
    echo "<script>window.location='../index.php'</script>";
   }
   
}

?>