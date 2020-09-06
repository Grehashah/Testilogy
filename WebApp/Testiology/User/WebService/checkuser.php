<?php

	include_once "../Includes/Operations.php";

	$response = array();	

	if($_SERVER['REQUEST_METHOD']=='POST')
	{

		if(isset($_POST['UName']))
		{
			$db = new Operations();

			if($db->CheckUser($_POST['UName']))
			{
			$response['error'] = true;
			$response['message'] = "Username already occupied";
			}	
			else
			{		
			$response['error'] = false;
			$response['message'] = "Right Username";
			}
		}
		else
		{
			$response['error'] = true;
			$response['message'] = "Require Fields are Missing";
		}
	}
	else
	{
	$response['error'] = true;
	$response['message'] = "Invalid request";
	}


	echo json_encode($response);
?>