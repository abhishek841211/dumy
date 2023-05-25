<?php
require_once 'connection.php';
if(isset($_POST['submit']))
{
$mobile_no=$_POST['mobile'];
$sql="SELECT * FROM customer WHERE mobile_no='$mobile_no' or email='$mobile_no'";
$res=mysqli_query($con,$sql);
if($res)
{
    echo "hle";
}
else
{
    echo "er"; 
}
}

?>