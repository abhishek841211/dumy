<style>
table
{
    border-collapse: collapse;
  border: 1px solid black;
  margin-left:280px;
  margin-top:70px;
}
th,td {
  border: 1px solid black;
  
}
th
{
    background-color:black;
    color:white;
    font-weight:bold;
    border-color:green;
    border-width:3px;
    
}
td
{
    font-family:cursive;
    color:darkblue;
    font-weight:bold;
    text-align:center;
}
h1{
    text-align:center;
    font-weight:bold;
    color:red;
    font-size:50px;
}
button
{
    float:right;
    width:60px;
    height:27px;
    color:black;
    background-color:white;
    border-radius:10px 10px 10px 10px;
    
}
button:hover
{
    color:white;
    background-color:black;
    font-weight:bold;
    border-radius:20px 0px 20px 0px;
}
</style>
<h1>Retrive Data</h1>
<a href="delivery.php"><button type="button">Back</button></a>
<a href="deliveryupdate.php"><button type="button">Update</button></a>
<a href="deliverydelete.php"><button type="button">Delete</button></a>
<?php
include 'connection.php';
$sql="select *from dilivery_table";
$display=mysqli_query($con,$sql);
echo "<table>";
echo "<tr>";
echo "<th> Sr No.</th>";
echo "<th> ID </th>";
echo "<th> Name </th>";
echo "<th> Mobile No.</th>";
echo "<th> AlterNet Mobile No.</th>";
echo "<th> Pine Code</th>";
echo "<th> State </th>";
echo "<th> City</th>";
echo "<th> House No.</th>";
echo "<th>Road Name</th>";
echo "<th>Created At</th>";
echo "<tr>";

if($display)
{
    $i=1;
    while($var=mysqli_fetch_assoc($display))
    {  
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$var['id']."</td>";
        echo "<td>".$var['full_name']."</td>";
        echo "<td>".$var['mobile1']."</td>";
        echo "<td>".$var['mobile2']."</td>";
        echo "<td>".$var['pin_code']."</td>";
        echo "<td>".$var['state']."</td>";
        echo "<td>".$var['city']."</td>";
        echo "<td>".$var['house_no']."</td>";
        echo "<td>".$var['road_name']."</td>";
        echo "<td>".$var['created_at']."</td>";
        echo "</tr>";
        $i++;
    }
}
else {
   echo  mysqli_error($con);
}

echo "</table>";
?>