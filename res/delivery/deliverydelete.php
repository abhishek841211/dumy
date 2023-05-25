<style>
table
{
    border-collapse: collapse;
  border: 1px solid black;
  margin-left:380px;
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

</style>
<h1>Update Data</h1>
<?php
require 'connection.php';
$sql="SELECT *FROM dilivery_table";

$res=mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Sr No.</th>
<th>ID</th>
<th>Name</th>
<th>Mobile No.</th>
<th>Alternet Mobile No.</th>
<th>Pin Code</th>
<th>State</th>
<th>City</th>
<th>House No.</th>
<th>Road Name</th>
<th>Create At</th>
<th>Delete</th>
</tr>";
if($res)
{
$i=1;
    while($var=mysqli_fetch_assoc($res))
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
        echo "<td><a href='deliverydeleteprocess.php?php id=".$var['id']."'>Delete</a></td>";
        echo "</tr>";
        $i++;
    }


}


echo "</table>"


?>