<?php

	include_once "../Includes/Operations.php";

	$response = array();	

	if($_SERVER['REQUEST_METHOD']=='POST')
	{

		if(isset($_POST['UName']) and isset($_POST['EId']))
		{
			$db = new Operations();

			if($db->UserExamReg(($_POST['UName']),($_POST['EId'])))
			{
			$response['error'] = false;
			$response['message'] = "User Registerd Successfully For Exam";
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