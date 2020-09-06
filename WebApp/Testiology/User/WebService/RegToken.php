<?php

	include_once "../Includes/Operations.php";

	$response = array();	

	if($_SERVER['REQUEST_METHOD']=='POST')
	{

		if(isset($_POST['Token']))
		{
			$db = new Operations();

			if($db->RegToken(($_POST['Token'])))
			{
			$response['error'] = false;
			$response['message'] = "Token Registerd Successfully";
			}	
			else
			{		
			$response['error'] = true;
			$response['message'] = "Some Error Occured Please Try again";
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