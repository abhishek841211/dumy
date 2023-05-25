<?php
require('function.php');
if (isset($_GET['task'])) {
	$task = $_GET['task'];
	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}
	switch ($task) {
		
		

			/*------NEW TASK 07 NOv 2020----------*/

			case "registration" :
					
				
				$res= insert_data('registration1', $_POST);
				echo json_encode($res);
				$res['url'] ='login.php';
			
				break;	

			case "product_update" :
				$_POST['status'] ='ACTIVE';
				if($_FILES['img1']['name'] !='')
				{
					//   $img_name = upload_img('img1');
					//   print_r($img_name);
					$img_name = upload_img('img1')['id'];
					$_POST['img1']= $img_name;
				}				
				$res= update_data('product_table', $_POST,$_POST['id']);
				echo "<pre>";
			    print_r($res);
				echo json_encode($res);
				
				$res['url'] ='productretrive.php';
				break;
				
					case "delete_product" :
						$id = $_GET['id'];
						$res  = delete_data('product_table', $id);
						echo json_encode($res);
						$res['url'] ='productretrive.php';
					break;

					
			case "event_update" :
				$_POST['status'] ='ACTIVE';
				if($_FILES['image']['name'] !='')
				{
					echo  $img_name = upload_img('image')['id'];
					$_POST['image']= $img_name;
				}				
				$res= update_data('event', $_POST,$_POST['id']);
				// echo "<pre>";
			    // print_r($res);
				echo json_encode($res);
				
				$res['url'] ='event_retrive.php';
				break;

				case "delete_event":
					$id = $_GET['id'];
					$res  = delete_data('event', $id);
					echo json_encode($res);
					$res['url'] ='event_retrive.php';
				break;

		
				case "chefs_update" :
					$_POST['status'] ='ACTIVE';
					if($_FILES['image']['name'] !='')
					{
						 //$img_name = upload_img('image');
						// print_r($img_name);
						  $img_name = upload_img('image')['id'];
						$_POST['image']= $img_name;
					}				
					$res= update_data('chefs', $_POST,$_POST['id']);
					echo "<pre>";
					// print_r($res);
					echo json_encode($res);					
					$res['url'] ='chefs_retrive.php';
					break;
	
					case "delete_chefs":
						$id = $_GET['id'];
						$res  = delete_data('chefs', $id);
						echo json_encode($res);
						$res['url'] ='chefs_retrive.php';
					break;
	


				// case "event_add" :
					
				// 	$_POST['status'] ='ACTIVE';
				// 	$res= insert_data('event', $_POST);
				// 	echo json_encode($res);
				// 	//$res['url'] ='login.php';
				
				// 	break;	
	
					// case "view_details" :
					
					// 	$_POST['status'] ='ACTIVE';
					// 	$res= get_data('details', $_POST);
					// 	echo json_encode($res);
					// 	// $res['url'] ='view_cat.php';
					
					// 	break;	
					
					

				
		default:
			echo "Invalid Action";
	}
}
if(isset($res['url'])){ 
	
echo "<script> window.location ='".$res['url']."' </script>";

} ?>