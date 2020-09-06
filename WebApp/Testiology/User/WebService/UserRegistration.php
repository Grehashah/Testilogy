<?php

	include_once "../Includes/Operations.php";

	$response = array();	

	if($_SERVER['REQUEST_METHOD']=='POST')
	{

		if(isset($_POST['UName']) and isset($_POST['Pass']) and isset($_POST['ContactNo'])and isset($_POST['Email']) and isset($_POST['Qual']))
		{
			$db = new Operations();

			if($db->RegisterUser(($_POST['UName']),($_POST['Pass']),($_POST['ContactNo']),($_POST['Email']),($_POST['Qual'])))
			{
			$response['error'] = false;
			$response['message'] = "User Registerd Successfully";
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