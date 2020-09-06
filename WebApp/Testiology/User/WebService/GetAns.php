
<?php

	include_once "../Includes/Operations.php";

	$response = array();	

	if($_SERVER['REQUEST_METHOD']=='POST')
	{

		if(isset($_POST['Ans']) and isset($_POST['QId']) and isset($_POST['UserId']))
		{
			$db = new Operations();

			if($db->GetAns(($_POST['Ans']),($_POST['QId']),($_POST['UserId'])))
			{
			$response['error'] = false;
			$response['message'] = "Answer Registered Successfully";
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