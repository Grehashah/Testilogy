<?php

require_once '../includes/operations.php';

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST')
{

	if(isset($_POST['UName'])  and isset($_POST['Email']) and isset($_POST['Pass']) and isset($_POST['Cno']) and isset($_POST['Qual']))
	{
			 $db = new operations();

		 if($db->update($_POST['UName'],$_POST['Email'],$_POST['Pass'],$_POST['Cno'],$_POST['Qual']))
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

?>