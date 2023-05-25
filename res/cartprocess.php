<?php
session_start();
require_once('connection.php');
//print_r($_POST);exit;
 


if(isset($_POST))
{
  extract($_POST);  
 

  $invsql = "SELECT * FROM invoice WHERE status='OPEN'";
   $resultAll = mysqli_query($con,$invsql);
 
//  $inv =  mysqli_fetch_array($invData);
if (mysqli_num_rows($resultAll) > 0) {
	while($rowCatData = mysqli_fetch_assoc($resultAll)){
    $inv_no = $rowCatData["inv_no"];
	}
}

else
{
  $inv_no = rand(10,10000);
  

 $invsql="INSERT INTO invoice(inv_no,status)
    VALUES ('$inv_no','OPEN')";
    mysqli_query($con,$invsql);
}

 
 $sql="INSERT INTO item (p_name,p_id,price,inv_no,status)
    VALUES ('$p_name','$p_id','$price','$inv_no','ACTIVE')";

    // $sql="INSERT INTO cart(price,p_name)
    // VALUES ('$price','$p_name')";
    $res = mysqli_query($con,$sql);
  //  print_r($res);
  if($res == true)
  {
    $sum="SELECT SUM(price) total_amount FROM item where inv_no='$inv_no'"; //total amount=store price 
    $result = mysqli_query($con,$sum);
    
      while($rowData = mysqli_fetch_assoc($result)){
        $total_price = $rowData["total_amount"];
      }
      
      $update="UPDATE invoice SET total_price='$total_price' WHERE inv_no='$inv_no'";
      $updateres= mysqli_query($con,$update);
    
     
    echo json_encode(['status'=>'success','msg'=>'added to cart']);
    // header("cart.php");
  }else{
    echo json_encode(['status'=>'error','msg'=>$res]);
  }
}
?>