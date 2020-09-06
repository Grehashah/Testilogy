<?php

require_once '../includes/operations.php';

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST')
{

	if(isset($_POST['Token']))
	{
			 $db = new operations();

		 if($db->readystate($_POST['Token']))
		{

		$response['error'] = false;
		$response['message'] = "Update SUCCESSFULLY";
			 	
			}
			 else
			 {

		$response['error'] = true;
		$response['message'] = "Update is unsuccessful";
	
			 }
	}
	else
	{
			$response['error'] = true;
		$response['message'] = "Required fields are missing";
	
	}

}
else
{
	$response['error'] = true;
	$response['message'] = "Invalid request";
}
echo json_encode($response);

?>ś