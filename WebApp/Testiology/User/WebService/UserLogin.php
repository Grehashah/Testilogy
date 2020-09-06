<?php

	include_once "../Includes/Operations.php";

	$response = array();	

	if($_SERVER['REQUEST_METHOD']=='POST')
	{

		if(isset($_POST['UName']) and isset($_POST['Pass']))
		{
			$db = new Operations();

			if($db->UserLogin(($_POST['UName']),($_POST['Pass'])))
			{
			$result = $db->LoginRecord(($_POST['UName']),($_POST['Pass']));

			while($row = $result->fetch_assoc())
			{

				$response['UName'] = $row['uname'];
				$response['Pass'] = $row['passwd'];
			}

			$response['error'] = false;
			$response['message'] = "Login Successfully";
			}	
			else
			{		
			$response['error'] = true;
			$response['message'] = "Wrong Username or password";
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