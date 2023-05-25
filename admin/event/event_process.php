<?php
require 'connection.php';
if(isset($_POST['submit']))
{
    $event_name=$_POST['event_name'];
    $price=$_POST['price'];
    $discription=$_POST['discription'];

    
    $imagename=$_FILES['image']['name'];
    $tempname=$_FILES['image']['tmp_name'];
    $uploc='event_image/'.$imagename;

   echo $sql="INSERT INTO event(event_name, price, discription,image) VALUES
    ('$event_name','$price','$discription','$imagename')";
   
    $res=mysqli_query($con,$sql);
   
    if($res==True)
    {
        move_uploaded_file($tempname,$uploc);    
      // echo"<script>window.location='event_form.php'</script>";
    }
    else
    {
       echo "Not Data Insert Plz Try Second Time<a href='event_form.php'>Retry</a>".mysqli_error($con);
    }
}

?>