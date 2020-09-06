<?php

	include_once "../Includes/Operations.php";

	$response = array();	

$uname = "";
$uname =$_GET['UName'];
			$db = new Operations();

			$res = $db->getemail($uname); 

			while($row = $res->fetch_array())
			{
				array_push($response,array('Email'=>$row['email']));	
			} 


			$response['error'] = false;
		
	echo json_encode(array("result"=>$response));
?>