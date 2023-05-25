<?php
include 'connection.php';
if(isset($_POST['submit']))
{
$mobile_number=$_POST['mobile_number'];
$password=$_POST['password'];
  // if(count($_POST)>0) {
  //     print_r($_POST);
  //     extract($_POST);
      $sql="UPDATE registration1 SET password='$password' WHERE mobile_number='$mobile_number'";
      $res=mysqli_query($con, $sql);
      //echo "Hii";
      //  }
  if($res)
  {
      echo "<script> window.location='login.php'</script>";
  }
  else
  {
   
   echo "Error!".mysqli_error($con);

  }


}




?>