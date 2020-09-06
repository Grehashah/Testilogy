<?php
 
$userid = "";
$userid= $_GET['userid'];
 
$result1 = array();
 
	$con1 = mysqli_connect("localhost","root","","testiology"); 

	$sql1 = "select * from users where userid = '$userid'";
	 
	$res1 = mysqli_query($con1,$sql1);
	 
	$result1 = array();

	while($row1 = $res1->fetch_array())
	{
		array_push($result1,array('UName'=>$row1['uname']));

	}
 
echo json_encode(array("result"=>$result1));
 
mysqli_close($con1);
 
?>s