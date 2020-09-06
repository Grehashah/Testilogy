<?php

require_once '../includes/operations.php';

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST')
{

	if(isset($_POST['UName']))
	{
			 $db = new operations();

		 if($db->logout($_POST['UName']))
		{

		$response['error'] = false;
		$response['message'] = "Logout Successfully";
			 	
			}
			 else
			 {

		$response['error'] = true;
		$response['message'] = "Logout is unsuccessful";
	
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

?>