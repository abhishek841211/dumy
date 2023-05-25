<?php
require_once('op_config.php');
$con = mysqli_connect( $host_name, $db_user, $db_password, $db_name) 
	or die("Unable to Connect, Check the Connection Parameter. " .mysqli_error($con)) ;


// === OFFERPLANT MASTER FUNTION FOR EVERY WHERE ==== //

	//  INSERT ( insert_row, insert_data, insert_html )
	// 	UPDATE (update_date, update_multi_data)
	// 	REMOVE (remove_data, remove_multi_data)
	// 	DELETE (delete_data, delete_multi_data)
	//	FETCH	(get_data, get_all, get_multi_data, get_not, direct_sql)
	//	CRYPTO (encode, decode)
	//	STRING (rnd_str, add_space, remove_space, remove_from_string, add_to_string)
	//	SECURITY (xss_clean, post_clean)
	//	ACCESS	(verify, verify_request)
	//	EXCEL 	(csv_import, csv_export)
	//	YOUTUBE ( ytid, get_vid)
	// 	COMM	(send_msg, send_sms, rtfmail ,wasend )
	//	API 	(api_call)
	//	QRcode	(qrcode)
	//	IMAGE 	(uploadimg, remote_file_size)
	// 	DATABASE Sturucture (table_list, Create_table, direct_sql_file,add_column, remove_column)
	// 	CONFIG 	(set_config, update_config,delete_config, all_config, get_config)
	//	HTML 	(input_text, input_date, btn_view, btn_edit, btn_delete) 
	//	UI DROPDOWN (dropdown, dropdown_list, dropdown_list_multiple, dropdown_list_where,  create_list)
	//	Scrap get_whois 
// Create Table with Basic Structure  

function get_whois($domain_name)
{
    $html = file_get_contents("https://www.whois.com/whois/$domain_name");
    $DOM = new DOMDocument();
    $DOM->loadHTML($html);
    $finder = new DomXPath($DOM);
    $classname = 'df-row';
    $nodes = $finder->query("//*[contains(@class, '$classname')]");
        // foreach ($nodes as $node) {
        //   echo "<br>".$node->nodeValue;
        // }
    $data['name'] = substr($nodes[0]->nodeValue,7);
    $data['reg'] = substr($nodes[2]->nodeValue,14);
    $data['expire'] = substr($nodes[3]->nodeValue,11);
    $data['ns'] = substr($nodes[6]->nodeValue,13);
    return $data;
}

function create_table($table_name)
{
	global $con;
	$sql1 ="CREATE TABLE IF NOT EXISTS $table_name (
	  id int(11) NOT NULL,
	  status varchar(25) DEFAULT NULL,
	  created_at timestamp NULL DEFAULT NULL,
	  created_by int(11) DEFAULT NULL,
	  updated_at timestamp NULL DEFAULT NULL,
	  updated_by int(11) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
	
	$res[] = mysqli_query($con,$sql1) or die("Error In Createting Table : ".mysqli_error($con));
	
	$sql2 ="ALTER TABLE $table_name  ADD PRIMARY KEY (id)";
	$res[] = mysqli_query($con,$sql2) or die("Error In Assigning Primary Key : ".mysqli_error($con));
	
	$sql3 =" ALTER TABLE $table_name  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";
	
	$res[] = mysqli_query($con,$sql3) or die("Error In Creating Auto Increment ID  : ".mysqli_error($con));
	
	$sql4 ="ALTER TABLE $table_name CHANGE `updated_at` `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP";
	$res[] = mysqli_query($con,$sql4) or die("Error In Assign Updated at Default Value as Current Timestamp : ".mysqli_error($con));
	return $res;
}

	
// List of all Table Exist in databse 
	function table_list()
	{
		global $con;
		global $db_name;
		$result =array();
		$res =mysqli_query($con, "show tables") or die("Error in Creating Table List". mysqli_error($con));
		$ct = mysqli_num_rows($res);
		if ($ct >=1)
		{
			while($row =mysqli_fetch_assoc($res))
			{
				//$data[] = $row['Tables_in_'.$db_name];
				$data[] = $row['Tables_in_'.$db_name];
			}
			$result['count']=$ct;
			$result['status']='success';
			$result['data'] =$data;
		}	
		else{
			$result['count']=0;
			$result['status']='error';
			$result['data'] =null;
		}
		return $result;
	}
	
	function column_list( $table_name ='users' )
	{
		global $con;
		global $db_name;
		$result =array();
		$sql ="SELECT COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, COLUMN_DEFAULT,  EXTRA FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table_name'";
		$res =mysqli_query($con, $sql) or die("Error in Creating Table List". mysqli_error($con));
		$ct = mysqli_num_rows($res);
		if ($ct >=1)
		{
			while($row =mysqli_fetch_assoc($res))
			{
				$data[] = $row;
			}
			$result['count']=$ct;
			$result['status']='success';
			$result['data'] =$data;
		}	
		else{
			$result['count']=0;
			$result['status']='error';
			$result['data'] =null;
		}
		return $result;
	}

	
// ENCODE STRING INTO NON READABLE STRING  
function encode($input) {
	 return strtr(base64_encode($input), '+/=', '._-');
	}

// DECODE STRING FROM NON READABLE STRING TO READABLE
function decode($input) {
		 $url = base64_decode(strtr($input, '._-', '+/=')); 
		 //$parts = parse_url($url);
		 parse_str($url, $query);
		 return $query;
		}

// USE TO CREATE STRING REPLACE SPACE WITH UNDERSCORE FORM STRING 

function remove_space($str)
		{
		$str =trim($str);
		return strtolower(preg_replace("/[^a-zA-Z0-9]+/", "_", $str));
		}

// USE TO CREATE STRING REPLACE UNDERSCORE WITH SPACE FORM STRING 
		
function add_space($str)
		{
		$str =trim($str);
		return ucwords(str_replace('_', ' ', $str));
		}
		
// GET VIDEO ID FROM YOUTUBE LINK 


function get_vid($url)
	{
	    if (stristr($url,'youtu.be/'))
		{preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
	    else 
		{@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
	}

function yt_info($video_url)
    {
    global $yt_api;
    $yt_api = "XXXXXXAIzaSyD9ViOHePhJsjaauyrlaZbihN256Q1Osq34x6t10sXXXXXX";
    
	$video_id = get_vid($video_url);
    //$video_id = "Kh8z7DCyOEE";
    $url = "https://www.googleapis.com/youtube/v3/videos?id=" . $video_id . "&key=" . $yt_api . "&part=snippet,contentDetails,statistics,status";
    $json = file_get_contents($url);
    $getData = json_decode( $json , true);

    foreach((array)$getData['items'] as $key => $gDat)
        {
            //print_r($gDat);
            $data['video_type'] = 'VIDEO';
            $data['video_title'] = $gDat['snippet']['title'];
            $data['video_date'] = date('Y-m-d h:i:s',strtotime($gDat['snippet']['publishedAt']));
            $data['video_id'] = $gDat['id'];
            $data['video_url'] = 'https://www.youtube.com/watch?v='.$gDat['id'];
            $data['video_image'] = $gDat['snippet']['thumbnails']['medium']['url'];
            $data['views'] = $gDat['statistics']['viewCount'];
            $data['like'] = $gDat['statistics']['likeCount'];
            $data['comment'] = $gDat['statistics']['commentCount'];
            $data['favorite'] = $gDat['statistics']['favoriteCount'];
        }
    return $data;
    }

// USE To CREATE A RANDOM STRING OF SPECIFIC LINK 
function rnd_str($length_of_string) 
{ 
    // String of all alphanumeric character 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 

    // Shufle the $str_result and returns substring of specified length 
    return strtoupper(substr(str_shuffle($str_result),0, $length_of_string)); 
} 

// USE TO CLEAN DATE AND REMOVE HAKABLE CODE 
function xss_clean($data)
{
        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
                // Remove really unwanted tags
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        // we are done...
        return $data;
}

// USE TO CLEAN MULTI LEVEL ARRAY DATA
function post_clean($arr_data)
{
	if(is_array($arr_data))
	{
		foreach( $arr_data as $data)
		{
			
		$key = array_search ($data, $arr_data);
			if(is_array($data))
			{
				post_clean($data);
			}
			else{
			$arr_data[$key] =xss_clean($data);
			}
		}
	}
	else{
		xss_clean($arr_data);
	}
	return $arr_data;
}

// CHECK ORIGIN OF REQUESTED URL 
function verify_request()
    {
        $ref = parse_url($_SERVER["HTTP_REFERER"]);
        $rh  = $ref['host'];
        $mh = $_SERVER['HTTP_HOST'];
        
        if($rh <> $mh)
        {
            return false;
        }
		else{
			return true;
		}
    }


function verify($user_type)
{
	$actual_link = "http://".$_SERVER['HTTP_HOST']; //$_SERVER['REQUEST_URI'];
	//die($actual_link);
	$current_page = basename($_SERVER['REQUEST_URI'], '?'. $_SERVER['QUERY_STRING']);
	if($user_type =='ADMIN') { 
	    global $admin_role;
	    $all_page = $admin_role;
	}
	else if($user_type =='CLIENT') { 
	    global $client_role;
	    $all_page = $client_role;
	}
	else{
	    die("Invalid User ! Don't Have Permission");
	}
	
	if (!array_search($current_page,$all_page))
	{
			die("Don't have Permission");
	}			
}

// To check and Add Column in Table
function add_column($table_name, $col_name, $data_type ='varchar(255)', $default =null )
	{
		global $con;
		$exist = direct_sql("SHOW COLUMNS FROM $table_name LIKE '$col_name'");
		if($exist['count']==0)
		{ 
		$sql ="alter table $table_name add column $col_name $data_type $default"; 
		$res =mysqli_query($con,$sql) or die("Error in Adding Coumn". mysqli_error($con));
		}
		
	}
	
// To Remove a Column from Table
function remove_column($table_name, $col_name )
	{
		global $con;
		$exist = direct_sql("SHOW COLUMNS FROM $table_name LIKE '$col_name'");
		if($exist['count']==1)
		{
		$sql ="alter table $table_name drop column $col_name "; 
		$res =mysqli_query($con,$sql) or die("Error in Removing Column". mysqli_error($con));
		}
	}
	
// TO INSERT BLANK ROW IN A TABLE  	
function insert_row($table_name )
	{
		global $con;
		global $user_id;
		global $current_date_time;
		$result = get_multi_data($table_name, array('created_by'=>$user_id, 'status'=>'AUTO'), ' order by id desc limit 1');
		if($result['count'] <1) 
		{
			$result = insert_data( $table_name, array('status'=>'AUTO', 'created_at' => $current_date_time ));
			$id = $result['id'];
		}
		else{
			$id = $result['data'][0]['id'];
		}		
		return array('table'=>$table_name,'id'=>$id);
	}

// TO INSERT DATA IN A TABLE  		
function insert_data( $table_name, $ArrayData)
	{
		global $con;
		global $user_id;
		global $current_date_time;
		//echo"<pre>";
		//print_r($ArrayData);
		$ArrayData['created_by'] =$user_id;
		$ArrayData['created_at'] =$current_date_time;
		
		$columns = implode(", ",array_keys($ArrayData));
		$escaped_values =array_values($ArrayData);
		foreach ($escaped_values as $newvalue)
		{
			$newvalues[] = "'".post_clean($newvalue)."'";	
		}
		//$data = mysqli_escape_string ($escaped_values);
		$values  = implode(", ", $newvalues);

		$sql = "INSERT IGNORE INTO $table_name ($columns) VALUES ($values)";
		
		$res =mysqli_query($con,$sql) or die("Error in Inserting Data". mysqli_error($con));
		$id = mysqli_insert_id($con);
		if(mysqli_affected_rows($con)>0)
		{
			$result['id'] =$id;	
			$result['status'] ='success';	
			$result['msg'] =" Data Added Successfully";
		}
		else{
			$result['id'] =0;	
			$result['status'] ='error';	
			$result['msg'] = mysqli_error($con);
		}
		return $result;	
	}

// TO INSERT DATA FROM RTF TEXTAREA 

function insert_html( $table_name, $ArrayData)
	{
		global $con;
		global $user_id;
		global $current_date_time;
		//echo"<pre>";
		//print_r($ArrayData);
		$ArrayData['created_by'] =$user_id;
		$ArrayData['created_at'] =$current_date_time;
		
		$columns = implode(", ",array_keys($ArrayData));
		$escaped_values =array_values($ArrayData);
		foreach ($escaped_values as $newvalue)
		{
			$newvalues[] = "'". htmlspecialchars($newvalue)."'";
			
		}
		//$data = mysqli_escape_string ($escaped_values);
		$values  = implode(", ", $newvalues);

		$sql = "INSERT IGNORE INTO $table_name ($columns) VALUES ($values)";
		
		$res =mysqli_query($con,$sql) or die("Error in Inserting Data". mysqli_error($con));
		$id = mysqli_insert_id($con);
		if(mysqli_affected_rows($con)>0)
		{
			$result['id'] =$id;	
			$result['status'] ='success';	
			$result['msg'] =" RTF Data Added Successfully";
		}
		else{
			$result['id'] =0;	
			$result['status'] ='error';	
			$result['msg'] = mysqli_error($con);
		}
		return $result;	
	}	
	
// TO UPDATE SINGLE RECORD OF TABLE 
function update_data( $table_name, $ArrayData, $id, $pkey='id' )
	{
		global $con;
		global $user_id;
		global $current_date_time;
		
		$ArrayData['updated_at'] =$current_date_time;
		$ArrayData['updated_by'] =$user_id;
		
		$cols = array();
 		foreach($ArrayData as $key=>$value) 
			{
				if($value =='')
    		    {
    		        unset($ArrayData[$key]);
    		    }
				else{
				$newvalue = post_clean($value);
				$cols[] = "$key = '$newvalue'";
				}
			}
		$sql = "UPDATE $table_name SET " . implode(', ', $cols) . " WHERE $pkey  ='".$id ."'";
		$res=mysqli_query($con,$sql) or mysqli_error($con);
		$num = mysqli_affected_rows($con);
		if($num>0)
		{
			$result['id'] =$id;	
			$result['status'] ='success';	
			$result['msg'] = $num." Record Updated Successfully";
		}
		else{
			$result['id'] =$id;	
			$result['status'] ='error';	
			$result['msg'] = "Sorry ! No Update Found" .mysqli_error($con);
		}
		return $result;	
	}

// TO UPDATE MULTIPLE RECORD OF TABLE BASED ON CONDITION

function update_multi_data( $table_name, $ArrayData, $whereArr )
	{
		global $con;
		$cols = array();
 		foreach($ArrayData as $key=>$value) 
			{
				$newvalue = post_clean($value);
				$cols[] = "$key = '$newvalue'";
			}
		
		foreach($whereArr as $key=>$value) 
			{
				$newvalue = post_clean($value);
				$where[] = "$key = '$newvalue'";
			}
			
		$sql = "UPDATE $table_name SET " . implode(', ', $cols) . " WHERE " .implode('and ', $where);
		$res=mysqli_query($con,$sql) or mysqli_error($con);
		$num = mysqli_affected_rows($con);
		if($num>0)
		{
			$result['count'] =$num;	
			$result['status'] ='success';	
			$result['msg'] = $num." Multi Record Updated Successfully";
		}
		else{
			$result['status'] ='error';	
			$result['msg'] = "Sorry ! No Update Found" .mysqli_error($con);
		}
		return $result;	
	}

// SOFT DELETE SINGLE RECORD FROM TABLE

function remove_data( $table_name, $id ,$pkey='id') 
	{
		global $con;
		global $user_id;
		global $current_date_time;
		
		$sql = "UPDATE $table_name SET status = 'DELETED' , updated_by = '$user_id', updated_at ='$current_date_time' WHERE $pkey  ='".$id ."'";
		$res =mysqli_query($con,$sql) or die("Error in Deleting Data". mysqli_error($con));
		$num = mysqli_affected_rows($con);
		if($num >=1)
		{
		 $result['id']=$id;
		 $result['status']='success';
		 $result['msg'] =$num. " Record removed successfully";
		}else{
			$result['id']=$id;
			$result['status']='error';
			$result['msg'] = "Sorry ! No record found to delete";
		}
		return $result;
	}

// SOFT DELETE MULTIPLE RECORD BASED ON CONDITION 
	
function remove_multi_data( $table_name, $whereArr)
	{
		global $con;
		global $user_id;
		global $current_date_time;
		foreach($whereArr as $key=>$value) 
			{
				$newvalue = preg_replace('/[^A-Za-z.@,:+0-9\-]/', ' ', $value);
				$where[] = "$key = '$newvalue'";
			}
		$sql = "update ". $table_name ." set status ='DELETED' updated_by = '$user_id', updated_at ='$current_date_time' WHERE " .implode('and ', $where);
		$res =mysqli_query($con,$sql) or die("Error in Deleting Data". mysqli_error($con));
		$num = mysqli_affected_rows($con);
		if($num >=1)
		{
		 $result['id']=$id;
		 $result['status']='success';
		 $result['msg'] =$num. " Record deleted successfully";
		}else{
			$result['id']=$id;
			$result['status']='error';
			$result['msg'] = "Soory ! No Record found to delete";
		}
		return $result;
	}


// HARD DELETE SINGLE RECORD FROM TABLE
	
function delete_data( $table_name, $id ,$pkey='id')
	{
		global $con;
		$sql = "delete from $table_name WHERE $pkey  ='".$id ."'";
		$res =mysqli_query($con,$sql) or die("Error in Deleting Data". mysqli_error($con));
		$num = mysqli_affected_rows($con);
		if($num >=1)
		{
		 $result['id']=$id;
		 $result['status']='success';
		 $result['msg'] =$num. " Record deleted successfully";
		}else{
			$result['id']=$id;
			$result['status']='error';
			$result['msg'] = "Sorry ! No record found to delete";
		}
		return $result;
	}

// HARD DELETE MULTIPLE RECORD BASED ON CONDITION 
	
function delete_multi_data( $table_name, $whereArr)
	{
		global $con;
		foreach($whereArr as $key=>$value) 
			{
				$newvalue = preg_replace('/[^A-Za-z.@,:+0-9\-]/', ' ', $value);
				$where[] = "$key = '$newvalue'";
			}
		$sql = "delete from ". $table_name ." WHERE " .implode('and ', $where);
		$res =mysqli_query($con,$sql) or die("Error in Deleting Data". mysqli_error($con));
		$num = mysqli_affected_rows($con);
		if($num >=1)
		{
		 $result['id']=$id;
		 $result['status']='success';
		 $result['msg'] =$num. " Record deleted successfully";
		}else{
			$result['id']=$id;
			$result['status']='error';
			$result['msg'] = "Soory ! No Record found to delete";
		}
		return $result;
	}
	

// FETCH ALL DATA BASED On CONDITION (Optional)	
	
function get_all( $table_name, $column_list ='*', $whereArr =null , $orderby ='id DESC')
	{
		global $con;
		$orderby = ' order by '.$orderby;
		if($column_list <>'*'){
			$column_list =implode(',',$column_list);
		}
	
		if($whereArr <>null)
		{	
			foreach($whereArr as $key=>$value) 
			{
				$key =trim($key);
				$newvalue = preg_replace('/[^A-Za-z.@,:+0-9\-]/', ' ', $value);
				$where[] = "$key = '$newvalue'";
			}
			$sql = "SELECT $column_list FROM $table_name where " .implode('and ', $where);
		}
		else{
			$sql = "SELECT $column_list FROM $table_name where status not in ('AUTO','DELETED')  ";
		}
		
		$res = mysqli_query($con,$sql . $orderby) or die("Error In Loading Data : ".mysqli_error($con));
		$ct =mysqli_num_rows($res);
		if ($ct >=1)
		{
			while($row =mysqli_fetch_assoc($res))
			{
				$data[] = $row;
			}
			$result['count']=$ct;
			$result['status']='success';
			$result['data'] =$data;
		}	
		else{
			$result['count']=0;
			$result['status']='error';
			$result['data'] =null;
		}
		return $result;
	}
	
// FETCH ALL DATA NOT On CONDITION (Optional)	
	
function get_not( $table_name, $column_list ='*', $whereArr =null , $orderby ='id DESC')
	{
		global $con;
		$orderby = ' order by '.$orderby;
		if($column_list <>'*'){
			$column_list =implode(',',$column_list);
		}
	
		if($whereArr <>null)
		{	
			foreach($whereArr as $key=>$value) 
			{
				$key =trim($key);
				$newvalue = preg_replace('/[^A-Za-z.@,:+0-9\-]/', ' ', $value);
				$where[] = "$key <> '$newvalue'";
			}
			$sql = "SELECT $column_list FROM $table_name where " .implode('and ', $where);
		}
		else{
			$sql = "SELECT $column_list FROM $table_name where status <>'AUTO' ";
		}
		
		$res = mysqli_query($con,$sql . $orderby) or die("Error In Loading Data : ".mysqli_error($con));
		$ct =mysqli_num_rows($res);
		if ($ct >=1)
		{
			while($row =mysqli_fetch_assoc($res))
			{
				$data[] = $row;
			}
			$result['count']=$ct;
			$result['status']='success';
			$result['data'] =$data;
		}	
		else{
			$result['count']=0;
			$result['status']='error';
			$result['data'] =null;
		}
		return $result;
	}

// EXECUTE ANY SQL STATMENT DIRECTLY AND GET FORMATED RESULT
	
function direct_sql($sql, $type='get')
	{
		global $con;
		$res = mysqli_query($con,$sql) or die("Error In Loding Data : ".mysqli_error($con));
		if($type=='set')
		{
			$ct =mysqli_affected_rows($con);
		}else{
			$ct =mysqli_num_rows($res);	
		}
		if ($ct >=1)
			{
				while($row =mysqli_fetch_assoc($res))
				{
					$data[] = $row;
				}
			$result['count']=$ct;
			$result['status']='success';
			$result['data']=$data;
			}	
		else{
			$result['count']=0;
			$result['status']='error';
			$result['data']=null;
			}	
		return $result;
	}

function direct_sql_file($filename)
{
	global $con;
	// Temporary variable, used to store current query
	$templine = '';
	// Read in entire file
	$lines = file($filename);
	// Loop through each line
	foreach ($lines as $line) {
	// Skip it if it's a comment
		if (substr($line, 0, 2) == '--' || $line == '')
			continue;

	// Add this line to the current segment
		$templine .= $line;
	// If it has a semicolon at the end, it's the end of the query
		if (substr(trim($line), -1, 1) == ';') {
			// Perform the query
			$con->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $con->error() . '<br /><br />');
			// Reset temp variable to empty
			$templine = '';
		}
	}
	$res['msg'] = $filename. " imported successfully";
	$res['status'] = "success";
	return $res;
}

// GET SINGLE DATA FORM TABLE BASED ON CONDITION

function get_data($table_name, $id , $field_name =null, $pkey ='id')
	{
		global $con;
		$result['count'] =0;
		$result['status'] ='error';
		$sql = "SELECT * FROM $table_name where $pkey ='$id' ";
		$res = mysqli_query($con,$sql) or die(" Data Information Error : ".mysqli_error($con));
		$ct = mysqli_num_rows($res);
		$result['count']=$ct;
		if ($ct >=1)
		{
		$row =mysqli_fetch_assoc($res);
		extract($row);
			if($field_name)
			{
			$result['status']='success';
			$result['data'] = $row[$field_name];
			}
			else{
				$result['status']='success';
				$result['data'] = $row;
			}
		}else{
			$result['count'] =0;
			$result['status']='success';
			$result['data'] = null;
		}
	return $result;
	}
	
// GET DATA FORM TABLE BASED ON MULTIPLE CONDITION

function get_multi_data( $table_name, $whereArr , $order =null )
	{
		global $con;
		
		foreach($whereArr as $key=>$value) 
			{
				$newvalue = preg_replace('/[^A-Za-z.@_,:+0-9\-]/', ' ', $value);
				$where[] = "$key = '$newvalue'";
			}
		
	    $sql = "select * from ". $table_name. " WHERE " .implode('and ', $where) .$order ;
		$res=mysqli_query($con,$sql) or mysqli_error($con);
		$num = mysqli_num_rows($res);
		if($num>0)
		{
			while($row =mysqli_fetch_assoc($res))
			{
				$data[] =$row;
			}
			$result['status'] ='success';	
			$result['count'] = $num;
			$result['data'] = $data;
			
		}
		else{
			$result['status'] ='error';	
			$result['count'] = 0;
			$result['data'] = mysqli_error($con);
		}
		return $result;	
	}	

function upload_img ($file_name , $imgkey = 'rand', $target_dir = "images")
    {
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0755, true);
		}
        if ($imgkey =='rand') { $imgkey = rand(10000,99999); }
        $target_file = $imgkey."_". basename($_FILES[$file_name]["name"]);
		$target_file = strtolower(preg_replace("/[^a-zA-Z0-9.]+/", "", $target_file));
        $uploadOk = 1;
		
		$res['id'] =0;
		$res['status'] ='error';
		$res['msg'] ='';
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        
            $check = getimagesize($_FILES[$file_name]["tmp_name"]);
            if($check !== false) {
                $res['msg']= "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $res['msg']= "File is not an image.";
                $uploadOk = 0;
            }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            unlink($target_file);
            $res['msg']= "Sorry, file already exists.";
            $uploadOk = 1;
        }
        // Check file size
        // if ($_FILES[$file_name]["size"] > 5000000) {
        //     $res['msg']= "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "jfif" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" ) {
            $res['msg']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $msg= "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$file_name]["tmp_name"],$target_dir."/".$target_file)) {
                $res['msg'] = "The file ". basename( $_FILES[$file_name]["name"]). " has been uploaded.";
                $res['id'] = $target_file;
				$res['status'] ='success';
            } else {
                $res['msg']= "Sorry, there was an error uploading your file.";
            }
        }
		return $res;
    }

function rtfmail($to, $subject, $msg)
{
	global $inst_logo;
	global $inst_name;
	global $inst_email;
	global $inst_url;
	global $base_url;
	global $inst_address1;
	global $inst_address2;
	global $noreply_email;
	
	$from = $noreply_email;
	 
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 
	// Create email headers
	$headers .= 'From: '.$from."\r\n".
		'Reply-To: '.$from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
	 
	// Compose a simple HTML email message
	$message = '<html><body>';
	$message .= "<table width='1000px' cellpadding='20px' cellspacing='0px' border='0' rules='all'>";
	$message .= "<tr><td colspan='3' aling='center' valign='middle'><img src='".$base_url.$inst_logo."' alt='".$inst_name."' height='80px' /></td><td colspan='2'> <h3>$inst_name </h3> </td></tr>";

	$message .= "<tr><td colspan='5' aling='center' valign='top' height='350px'><p> $msg </p></td></tr>";
	$message .= "<tr><td colspan='5' bgcolor='lightgreen' align='left'>Regards, <br> $inst_name <br> $inst_address1 $inst_address2 <br> $inst_email  | $inst_url | $app_link </td></tr>";
	$message .= '</table>';
	$message .= '</body></html>';
	 
	// Sending email
	if(mail($to, $subject, $message, $headers)){
		$res['msg'] = 'Your mail has been sent successfully.';
		$res['status'] =='success';
	} else{
		$res =  'Unable to send email. Please try again.';
		$res['status'] =='error';
	}
	return $res;
}

function api_call ($api_url)
		{
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$api_url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		return $result;
		}

function csv_export ($table_name, $col_list ='*')
{
	global $con;
	global $db_name;
	$filename = $table_name.".csv";
	$fp = fopen('php://output', 'w');
	
	if($col_list =='*')
	{
	$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table_name'";
	$result = mysqli_query($con,$query);
	while ($row = mysqli_fetch_row($result)) {
		$header[] = $row[0];
	}
	}
	else{
		$header =explode(',',$col_list);
	}	

	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	fputcsv($fp, $header);

	$query = "SELECT $col_list FROM $table_name";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	//exit;
}


function csv_import($table, $pkey='id') // Import CSV FILE to Table
	{
		 // Allowed mime types
   		 $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    	// Validate whether selected file is a CSV file
    	if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
			$change =$new=0;
			if(is_uploaded_file($_FILES['file']['tmp_name'])){
						
				// Open uploaded CSV file with read-only mode
				$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
				$col_list= array_map('trim',fgetcsv($csvFile));
				print_r($col_list);
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$all_data = array_combine($col_list,$line);
					//$search[$pkey] =trim($all_data[$pkey]);
					//$search_result = get_all($table,'*', $search, $pkey);
					$search_result = get_data($table,$all_data[$pkey],null,$pkey);
						echo "<pre>";
						print_r($search_result);
						if($search_result['count']<1)
						{
							$res= insert_data($table,$all_data);
							if($res['id']!=0)
							{
								$new++;	
							}		
						}
						else{
							//echo $all_data[$pkey];
							$res =update_data($table,$all_data, $all_data[$pkey],$pkey);
							if($res['status']=='success')
							{
								$change++;
							}
						}
						$res = array( 'status'=>'success', 'change'=>$change ,'new'=>$new ,'msg'=>" $new New Data and $change change found and updated."); 
				}
			}
			
		}
		else{
			$res = array( 'status'=>'error', 'change'=>$change ,'new'=>$new ,'msg'=>'Please upload a valid CSV file.'); 
			}
		return  $res;
	}	
	
function qrcode( $data) {
	
	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'qrcode'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'qrcode/';

    include "assets/lib/qrlib.php";    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR)) mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    $errorCorrectionLevel = 'H';
    $matrixPointSize = 4;
   
    if (isset($data)) { 
    
        //it's very important!
        if (trim($data) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'OFFERPLANT'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
        //default data
        echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }       
    //display generated file
    //echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />';  
    return $PNG_WEB_DIR.basename($filename);  
    }
	


function get_bal_msg()
		{
		global $auth_key_msg;	
		$api_url = 'http://mysms.msgclub.net/rest/services/sendSMS/getClientRouteBalance?AUTH_KEY='.$auth_key_msg;
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$api_url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		$data  =json_decode($result,true);
		return $data[0]['routeBalance'];	
		}	
		

function get_bal_sms()
		{
		global $auth_key_sms;	
		$api_url = 'http://sms.morg.in/api/balance.php?&type=4&authkey='.$auth_key_sms;
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$api_url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		$data  =json_decode($result,true);
		return $data;	
		}	

function send_msg($number,$sms)
		{
			$res =null;
		if(preg_match('/^[6-9]{1}[0-9]{9}+$/', $number) ==1)
			{
			$no ='91'.urlencode($number);
			$msg = substr(urlencode($sms),0,340);
			global $sender_id;
			global $auth_key_msg;
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    	$url ="http://msg.morg.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=$auth_key_msg&message=$msg&senderId=$sender_id&routeId=1&mobileNos=$no&smsContentType=english";
			curl_setopt($ch,CURLOPT_URL, $url);
	    	$res= curl_exec($ch);
			curl_close($ch);
			
			}
			return $res;
		}	
		
function send_sms($number,$sms,$dlt_id ='10071618245450XXXXX') // for sms.morg.in 
		{
		    global $sms_auth_key;
		    global $sender_id;
			$res =null;
		if(preg_match('/^[6-9]{1}[0-9]{9}+$/', $number) ==1)
			{
			$no =urlencode($number);
			$msg = substr(urlencode($sms."\nThanks \nTEAM OFFERPLANT"),0,340);
			// Download op_sms.sql for Data Structure 
			$idata = insert_data('op_sms',array('mobile'=>$no,'text'=>$msg, 'sender_id'=>$sender_id));
		
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		    $url ="http://sms.morg.in/api/sendhttp.php?authkey=$sms_auth_key&mobiles=$no&message=$msg&sender=$sender_id&route=4&country=91&DLT_TE_ID=$dlt_id";
	    	curl_setopt($ch,CURLOPT_URL, $url);
	    	$res= curl_exec($ch);
			curl_close($ch);
			update_data('op_sms', array('request_id'=>$res), $idata['id']);
			}
			return $res;
		}			

function date_range($gap=15 ){
     
        $startDate = date('Y-m-d');
        $endDate = date ("Y-m-d",strtotime("+$gap days",strtotime($startDate))); 
        $startStamp = strtotime(  $startDate );
        $endStamp   = strtotime(  $endDate );
    
        if( $endStamp > $startStamp ){
            while( $endStamp >= $startStamp ){
    
                $data['dv'] = date( 'Y-m-d', $startStamp );
                $data['dd'] = date( 'd M D', $startStamp );
                $data['day'] = date( 'D', $startStamp );
                $dateArr[] = $data; // date( 'Y-m-d', $startStamp );
    
                $startStamp = strtotime( ' +1 day ', $startStamp );
    
            }
            return $dateArr;    
        }else{
            return $startDate;
        }
    }

// HTML UI CREATE

	
function input_text($name, $value, $display =null )	
		{
			if($display ==null) { $display = add_space($name); }
			$str = "<div class='form-group'>
                            <label> $display</label>
                            <input type ='text' class='form-control' value='$value' name='$name' id ='$name'  >
                   </div>";
			return $str;
		}
		
function input_date($name, $value ='', $display =null )	
		{
			if($value =='') { $value =  date('Y-m-d'); }
			if($display ==null) { $display = removespace($name); }
			$str = "<div class='form-group'>
						<label> $display</label>
                        <input type ='date' class='form-control' value='$value' name='$name' id ='$name'>
                   </div>";
			return $str;
		}
	
function btn_delete($table, $id,  $disabled ="")
		{
			$str ="<button class='delete_btn btn btn-danger btn-sm'  data-table='$table' data-id='$id' data-pkey='id' title='Detete This Permanently' $disabled > <i class='fa fa-trash'></i> </button> ";
			return $str ;
		}

function btn_edit($page_url, $id)
		{
			$link =$page_url."?link=".encode("id=".$id);
			$str ="<a href='$link' class=' btn btn-info btn-sm text-light' title='Edit Information '> <i class='fa fa-edit'></i> </a> ";
			return $str ;
		}
		
function btn_view($table, $id ,$title ='' )
		{
			$view_link = 'view_data.php?link='.encode('table='.$table.'&id='.$id);
			$str ="<a data-href='$view_link' class='view_data btn btn-success btn-sm text-light' data-title='$title'><i class='fa fa-eye'></i></a> ";
			return $str ;										
		}

function display_img($url , $width='100px' , $height='100px')	
		{
			$str ="<img src='$base_url/upload/$photo' width='$width'  height='$height'  class='img-thumbnail d-self-centered'>";
			return $str; 
		}



function dropdown($array_list, $selected =null)
		{
			foreach($array_list as $list)
			{
				?>
				<option value='<?php echo $list; ?>' <?php if($list ==$selected) echo "selected"; ?>><?php echo $list; ?></option>
				<?php
			}
		}

function dropdown_with_key($array_list, $selected =null)
		{
			foreach($array_list as $list)
			{
				$key = array_search ($list, $array_list);
                ?>
				<option value='<?php echo $key; ?>' <?php if($key ==$selected) echo "selected"; ?>><?php echo $list; ?></option>
				<?php
			}
		}
		
function dropdown_where($table_name,$id,$list,$whereArr, $selected =null)
	{
			global $con;

				foreach($whereArr as $key=>$value)
			{
			$newvalue = post_clean($value);
			$where[] = "$key = '$newvalue'";
			}

			$sql = "select * from ".  $table_name ." WHERE " .implode('and ', $where);
			$res=mysqli_query($con,$sql) or mysqli_error($con);
			while($row =mysqli_fetch_array($res))
			{
			$id_inner =$row[$id];
			$show =$row[$list];
			?>
			<option value='<?php echo $id_inner; ?>' <?php if($id_inner ==$selected) echo "selected";?> ><?php echo $show; ?></option>
			<?php
			}
	}
	
function dropdown_multiple($array_list, $selectedArr =null)
		{
			foreach($array_list as $list)
			{
				//$key=-1;
				$key = array_search ($list, $selectedArr);
                ?>
				<option value='<?php echo $list; ?>' <?php if($key !='') echo "selected"; ?>><?php echo $list ."-".$key; ?></option>
				<?php
			}
		}

function dropdown_list($tablename,$value,$list,$selected =null, $list2=null)
		{
    		global $con;
    		$i =0;
    		$query ="select * from $tablename where status ='ACTIVE' order by $list";
    		$res = mysqli_query( $con,$query) or die(" Creating Drop down Error : ".mysqli_error($con));
    		while($row =mysqli_fetch_array($res))
    		{
    			$key =$row[$value];
    			$show =$row[$list];
    			$col2 ='';
    			if($list2 <> null)
    			{
    				$col2 = "[ " . $row[$list2]. " ]";
    			}
    			
    		?>
    		<option value='<?php echo $key; ?>'<?php if($key ==$selected) echo "selected";?> ><?php echo $show ." ". $col2; ?></option>
    		<?php
    		}		
		}

function dropdown_list_multiple($tablename,$value,$list,$selectedArr =null)
		{
    		global $con;
    		$i =0;
    		$query ="select * from $tablename where status ='ACTIVE' order by $list";
    		$res = mysqli_query( $con,$query) or die(" Creating Drop down Error : ".mysqli_error($con));
    		while($row =mysqli_fetch_array($res))
    		{
    			$key =$row[$value];
    			$show =$row[$list];
				$found = array_search ($key, $selectedArr);
                ?>
				<option value='<?php echo $key; ?>' <?php if($found !='') echo "selected"; ?> ><?php echo $show; ?></option>
				<?php
    		}		
		}
		
function check_list($name, $array_list, $selected=null, $height='160px' )
		{
			$selected = explode(',',$selected);
			echo "<div style='overflow-y:auto;height:$height'>";
			?>
			<span class='btn btn-sm btn-info float-right'  onclick="selectcheck('<?php echo $name;?>')" ><i class='fa fa-check'></i></span><hr>
			<?php
			foreach(array_filter($array_list) as $list)
			{
				$checked =null;
				$x = array_search(trim($list), array_map('trim', $selected));
				
				if( $x >=-1){ $checked ='checked';}
				?>
				<div class="checkbox">
					  <input type="checkbox" value="<?php echo $list;?>" id="Checkbox_<?php echo $list;?>" <?php echo $checked; ?> name='<?php echo $name.'[]';?>'> 
					  <label for="Checkbox_<?php echo $list;?>"><?php echo $list?></label>
				</div>
				<?php
			}
			echo "</div>";
		}
		
function create_list($table_name, $field,  $whereArr =null)
		{
		global $con;
		$cols = array();
			if($whereArr != null)
			{
				foreach($whereArr as $key=>$value) 
					{
						$newvalue = preg_replace('/[^A-Za-z.@,:+0-9\-]/', ' ', $value);
						$where[] = "$key = '$newvalue'";
					}
				$sql = "select distinct($field) from ". $table_name ." WHERE " .implode('and ', $where);		
			}
			else{
				$sql = "select distinct($field) from ". $table_name;
			}
	
		$res = mysqli_query($con,$sql) or die(" Error in creating List : ".mysqli_error($con));
			if (mysqli_num_rows($res)>=1)
			{
				while($row =mysqli_fetch_assoc($res))
				{
					$list[] =$row[$field];
				}
			}
			else{
				return null;
			}
		return $list;
		}

 function html_table($array, $isedit =false , $isdelete =false , $edit_link='', $table =''){
		// start table
		$html = "<table class='table'  rules='all'>";
		// header row
		$html .= '<tr>';
		foreach($array[0] as $key=>$value){
				$html .= '<th>' . add_space(htmlspecialchars($key)) . '</th>';
			}
			if($isedit == true)
			{
			$html .= '<th> Edit </th>';
			}
			if($isdelete ==true)
			{
			$html .= '<th> Delete </th>';
			}
		$html .= '</tr>';

		// data rows
		foreach( $array as $key=>$value){
			$html .= '<tr>';
			foreach($value as $key2=>$value2){
				$html .= '<td>' . htmlspecialchars($value2) . '</td>';
			}
			if($isedit ==true)
			{
			$html .= '<td>' . btn_edit($edit_link, $value['id']) . '</td>';
			}
			if($isdelete ==true)
			{
			$html .= '<td>' . btn_delete('student', $value['id']) . '</td>';
			}
			$html .= '</tr>';
		}

		// finish table and return it

		$html .= '</table>';
		return $html;
	}
	
	// GET REMOTE FILE SIZE 
function remote_file_size( $url ) { 
  // Assume failure.
  $result = -1;

  $curl = curl_init( $url );

  // Issue a HEAD request and follow any redirects.
  curl_setopt( $curl, CURLOPT_NOBODY, true );
  curl_setopt( $curl, CURLOPT_HEADER, true );
  curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
  //curl_setopt( $curl, CURLOPT_USERAGENT, get_user_agent_string() );

  $data = curl_exec( $curl );
  curl_close( $curl );

  if( $data ) {
    $content_length = "unknown";
    $status = "unknown";

    if( preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
      $status = (int)$matches[1];
    }

    if( preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
      $content_length = (int)$matches[1];
    }

    // http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
    if( $status == 200 || ($status > 300 && $status <= 308) ) {
      $result = $content_length;
    }
  }
$filesize = round($result / (1024*1024), 2); // kilobytes with two digits
  return $filesize;
}
/*=============== CONFIG MANAGAMENT ===========*/

function update_config()
{
    global $CONFIG;
    foreach ($CONFIG as $key => $value) {
        $arr['option_name'] = $key;
        if(is_array($value)){
          $arr['option_value'] =json_encode($value);  
        }
        else{
          $arr['option_value'] =$value;    
        }
       $rescheck = get_data('op_config', $key, null, 'option_name');
       if($rescheck['count']==0)
       {
           $res = insert_data('op_config', $arr);
       }
       else{
           $res = update_data('op_config', $arr, $key, 'option_name');
       }
    }
    return $res;
}

function set_config($key, $value=null)
{
        $arr['option_name'] = $key;
        if(is_array($value)){
          $arr['option_value'] =json_encode($value);  
        }
        else{
          $arr['option_value'] =$value;    
        }
       $rescheck = get_data('op_config', $key, null, 'option_name');
       if($rescheck['count']==0)
       {
          $res = insert_data('op_config', $arr);
       }
       else{
          $res = update_data('op_config', $arr, $key, 'option_name');
       }
        return $res;
}

function get_config($key)
{
     $res = get_data('op_config', $key, 'option_value', 'option_name');
       if($res['count']>0)
       {
           return $res['data'];
       }
       else{
           return null;
       }
}

function delete_config($key)
{
     $res = delete_data('op_config', $key, 'option_name');
     return $res;
}

function all_config()
{
    $res = get_all('op_config');
    foreach($res['data'] as $data)
    {
      $vardata = array($data['option_name']=>$data['option_value']);
      extract($vardata);
    }
}

function create_log($arMsg)  
{  
	 //define empty string                                 
	 $stEntry="";  
	 //get the event occur date time,when it will happened  
	 $arLogData['event_datetime']='['.date('D Y-m-d h:i:s A').'] [client '.$_SERVER['REMOTE_ADDR'].']';  
	 //if message is array type  
	 if(is_array($arMsg))  
	 {  
	 //concatenate msg with datetime  
	 foreach($arMsg as $msg)  
	 $stEntry.=$arLogData['event_datetime']." ".$msg."\r\n";  
	}  
	else  
	{   //concatenate msg with datetime  

	 $stEntry.=$arLogData['event_datetime']." ".$arMsg."\r\n";  
	}  
	//create file with current date name  
	$stCurLogFileName='log_'.date('Ymd').'.txt';  
	//open the file append mode,dats the log file will create day wise  
	$fHandler=fopen($stCurLogFileName,'a+');  
	//write the info into the file  
	fwrite($fHandler,$stEntry);  
	//close handler  
	fclose($fHandler);  
}

function amount_in_word(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    $netamt =  ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    return ucwords($netamt);
}	

function remove_from_string($str, $item) {
    $parts = explode(',', $str);

    while(($i = array_search($item, $parts)) !== false) {
        unset($parts[$i]);
    }

    return implode(',', $parts);
}

function add_to_string($str, $item) {
    $parts = explode(',', $str);

    while(($i = array_search($item, $parts)) == false) {
		array_push($parts,$item);
    }
    return implode(',', $parts);
}

function expiry($date1) // service Start Date
{
  $date=date_create($date1);
  date_add($date,date_interval_create_from_date_string("365 days"));
  $date2 = date_format($date,"Y-m-d");
  $cdate = date('Y-m-d');
  $date1=date_create($cdate);
  $date2=date_create($date2);
  $diff=date_diff($date1,$date2);
  $da = $diff->format("%a");
  if($da <0 or $da >365)
  {
     die("Subscription Expired ! Please Contact to Service Provider");
  }
  else{
  return $diff->format("%a days");
  }
}

function del_cookie($key_id)
    {
        if (isset($_COOKIE[$key_id])) {
        unset($_COOKIE[$key_id]); 
        setcookie($key_id, null, -1, '/'); 
        return true;
        } else {
            return false;
        }
    }


function post_without_wait($url, $params)
	{
		foreach ($params as $key => &$val) {
		  if (is_array($val)) $val = implode(',', $val);
			$post_params[] = $key.'='.urlencode($val);
		}
		$post_string = implode('&', $post_params);
		$parts=parse_url($url);
		$fp = fsockopen($parts['host'],
			isset($parts['port'])?$parts['port']:80,
			$errno, $errstr, 30);
		
		
		$out = "POST ".$parts['path']." HTTP/1.1\r\n";
		$out.= "Host: ".$parts['host']."\r\n";
		$out.= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out.= "Content-Length: ".strlen($post_string)."\r\n";
		$out.= "Connection: Close\r\n\r\n";
		if (isset($post_string)) $out.= $post_string;

		fwrite($fp, $out);
		//fclose($fp);
	}
function backup_sql($con, $tables = '*')
{
	//global $con;
	$return = '';
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($con, 'SHOW TABLES');
		while($row = mysqli_fetch_array($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}

	//cycle through
	foreach($tables as $table)
	{
		$result = mysqli_query($con, 'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);

		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		
		$row2 = mysqli_fetch_array(mysqli_query($con, 'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";

		for ($i = 0; $i < $num_fields; $i++)
		{
			while($row = mysqli_fetch_array($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++)
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("/\\n/","\\n",$row[$j]);
					if (isset($row[$j]) and $row[$j] !="") { $return.= '"'.$row[$j].'"' ; } else { $return.= "NULL"; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}

	$myfile = fopen("backup.sql", "w") or die("Unable to open file!");
	fwrite($myfile, $return);
	fclose($myfile);
	return $myfile;
}	


function backup_zip($host='localhost',$user='root',$pass='',$name='test' ,$tables = '*')
{

  $connection = mysqli_connect($host, $user, $pass, $name);
    if (mysqli_connect_error()){
        trigger_error("Connection Error: " . mysqli_connect_error());
    }
	$return = '';

	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($connection, 'SHOW TABLES');
		while($row = mysqli_fetch_array($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}

	//cycle through
	foreach($tables as $table)
	{
	    global $inst_name;
	    $site_name= strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $inst_name));
		$result = mysqli_query($connection, 'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);

		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysqli_fetch_array(mysqli_query($connection, 'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";

		for ($i = 0; $i < $num_fields; $i++)
		{
			while($row = mysqli_fetch_array($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++)
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("/\\n/","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}

	//save file
	
	if (!file_exists('database_backups')) {
 	   mkdir('database_backups', 0777, true);
 	}
	$filename = 'database_backups/db-'.time().'-'.(md5(implode(',',$tables))).'.sql.gz';
	$handle = fopen($filename,'w+');
	$gzdata = gzencode($return, 9);
	fwrite($handle,$gzdata);
	fclose($handle);
	return $filename;
}


function email_file($filename, $to =MAIL_TO){
	# Put your own email code in here.
	    global $inst_name;
	    global $dev_email;
	    global $inst_url;
	    global $noreply_email;
         
        // Sender 
        $from = $noreply_email; 
        $fromName = $inst_name;; 
         
        // Email subject 
        $subject = $inst_name .' :All DB Backup as on ' .date('Y-m-d h:i A');  
         
        // Attachment file 
        //$file = "database_backups/".$filename; 
        $file = $filename; 
         
        // Email body content 
        $htmlContent = " 
            <h3>PHP Email with Attachment with SQL File of $inst_name </h3> 
            <p>This email Contains SQL Backup till ". date("Y-m-d H:i A")." </p>"; 
         
        // Header for sender info 
        $headers = "From: $fromName"." <".$from.">"; 
         
        // Boundary  
        $semi_rand = md5(time());  
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
         
        // Headers for attachment  
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
         
        // Multipart boundary  
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
         
        // Preparing attachment 
        if(!empty($file) > 0){ 
            if(is_file($file)){ 
                $message .= "--{$mime_boundary}\n"; 
                $fp =    @fopen($file,"rb"); 
                $data =  @fread($fp,filesize($file)); 
         
                @fclose($fp); 
                $data = chunk_split(base64_encode($data)); 
                $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
                "Content-Description: ".basename($file)."\n" . 
                "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
            } 
        } 
        $message .= "--{$mime_boundary}--"; 
        $returnpath = "-f" . $from; 
         
        // Send email 
        $mail = @mail($to, $subject, $message, $headers, $returnpath);  
         
        // Email sending status 
        echo $mail?"<p>Email Sent Successfully $to !</p><br>":"<p>Email sending failed.</p><br>";
}

function get_file_size($filename) {

    $bytes = filesize($filename);
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
?>
