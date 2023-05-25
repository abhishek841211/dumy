<?php
include_once('connection.php');
extract($_GET); 
// print_r($_GET);
// exit;
// if(isset($_GET['p_id']!=''))
// 	{
// 	$p_id = $_GET['p_id'];

// 	echo $item_sql  ="DELETE FROM item where p_id='$p_id'";	
// 	$item_res = mysqli_query($con , $item_sql);
// if($item_res)
// {
// 	echo "<script> alert('Product removed from cart') </script>";
// 	echo "<script> window.location='add_to_cart_next.php'</script>";
// }
// else
// {
// 	echo "Error In data insert ". mysqli_error($con);
// }
// 	}
// 	else
// 	{
// 		$inv_no = $_GET['inv_no'];
// 		echo $item_sql  ="DELETE FROM invoice where inv_no='$inv_no'";	
// 		$item_res = mysqli_query($con , $item_sql);
// 	if($item_res)
// 	{
// 		echo "<script> alert('Product removed from cart') </script>";
// 		echo "<script> window.location='add_to_cart_next.php'</script>";
// 	}
// 	else
// 	{
// 		echo "Error In data insert ". mysqli_error($con);
// 	}
// 	}

if(isset($_GET['inv_no']))
	{
	$inv_no = $_GET['inv_no'];

	// $item_sql  ="DELETE FROM invoice where inv_no='$inv_no'";
    $item_sql =" DELETE inv.* ,i.* FROM invoice as inv, item as i  WHERE inv.inv_no = i.inv_no";
	
	$item_res = mysqli_query($con , $item_sql);
	}

// if($item_res)
// {
// 	echo "<script> alert('Product removed from cart') </script>";
// 	echo "<script> window.location='add_to_cart_next.php'</script>";
// }
// else{
// 	echo "Error In data insert ". mysqli_error($con);
// }
?>