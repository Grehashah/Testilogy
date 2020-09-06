<?php
 
$token = $_GET['token'];

	$con1 = mysqli_connect("localhost","root","","testiology"); 
	$sql1 = "select userid from devices where token = '$token'";
	$res1 = mysqli_query($con1,$sql1);
	$result1 = array();

		$row1=$res1->fetch_array();
		array_push($result1,array('userid'=>$row1['userid']));
			
echo json_encode(array("result"=>$result1));
 
mysqli_close($con1);
 
?>