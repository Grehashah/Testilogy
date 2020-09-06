<?php

	include_once "../Includes/Operations.php";

	$response = array();	

	if($_SERVER['REQUEST_METHOD']=='POST')
	{

		if(isset($_POST['Email']) and isset($_POST['Choice']) and isset($_POST['Cmt']))
		{
			$db = new Operations();
			if($db->feedback(($_POST['Email']),($_POST['Choice']),($_POST['Cmt'])))
			{	
			$response['error'] = false;
			$response['message'] = "Feedback is send Successfully";
			}	
			else
			{		
			$response['error'] = true;
			$response['message'] = "Feedback is send Unsuccessfully";
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