<?php
require 'connection.php';
$id=$_GET['id'];
$sql="DELETE FROM dilivery_table WHERE id='$id'";
$res=mysqli_query($con,$sql);
// if($res)
// {
//     echo windo.location('deliverydelete1.php');
// }
// else {
    
//     mysqli_error("Error!".$con);
// }

?>