<?php
include 'connection.php';
if(isset($_POST['submit']))
{
    // print_r($_POST);


if(isset($_POST['username']) && !empty($_POST['email_id'])&&!empty($_POST['mobile_number'])) 
{
  $full_name=$_POST['username'];
  $email_id=$_POST['email_id'];
  $mobile_number=$_POST['mobile_number'];

  $sql="select * from registration1 where full_name='$full_name' AND email_id='$email_id' AND mobile_number='$mobile_number' ";
  $sear=mysqli_query($con,$sql) or die("Error in Searching Data ".mysqli_error());
 
  //$row  = mysqli_fetch_array($sear);
  $ct  = mysqli_num_rows($sear);
  if($ct>0) 
  {  
    
    //print_r($row);
   echo "<script>alert('First Step Verification Successfully!');</script>";
    echo "<script> window.location='forgetsearch2form.php'</script>";
  }
  else 
  {
    echo "<script>alert('Wrong information Plz Fill The Correct Info...')</script>";
    echo "<script> window.location='forgetsearch1form.php'</script>";
  
  }
}
}

?>