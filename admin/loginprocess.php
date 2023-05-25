<?php
include 'connection.php';
if(isset($_POST['submit']))
{
//print_r($_POST);


if(isset($_POST['username']) && !empty($_POST['password'])) 
{
  $mobile_number=$_POST['username'];
  $password=$_POST['password'];

  $sql="select * from registration1 where mobile_number='$mobile_number'AND password='$password' ";
  $sear=mysqli_query($con,$sql) or die("Error in Searching Data ".mysqli_error());
 
  //$row  = mysqli_fetch_array($sear);
  $ct  = mysqli_num_rows($sear);
  if($ct>0) 
  {  
  $c=mysqli_fetch_assoc($sear);
    $_SESSION['user_id'] =$c['id'];

    //print_r($row);
    // echo 'Login Success';
    echo "<script> window.location='index.php'</script>";
  }
  else 
  {
    echo 'Wrong username or password';
  }
}

}
?>