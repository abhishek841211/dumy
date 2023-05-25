<?php
if(isset($_POST['submit']))
{
include 'connection.php';
$full_name=$_POST['full_name'];
$mobile1=$_POST['mobile1'];
$mobile2=$_POST['mobile2'];
$pin_code=$_POST['pin_code'];
$state=$_POST['state'];
$city=$_POST['city'];
$house_no=$_POST['house_no'];
$road_name=$_POST['road_name'];

$sql="INSERT INTO dilivery_table(full_name, mobile1, mobile2, pin_code, state, city, house_no, road_name) 
VALUES ('$full_name','$mobile1','$mobile2','$pin_code','$state','$city','$house_no','$road_name')";

$display=mysqli_query
($con,$sql);
if($display)
{
    echo "Data insert Sucessfully..";

}
else
{
    echo "Error! Data Not Insert.".mysqli_error();
}
}
?>