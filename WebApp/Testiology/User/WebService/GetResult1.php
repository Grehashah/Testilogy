<?php
 
$userid = $_GET['userid'];

$result1 = array();
  

	$con1 = mysqli_connect("localhost","root","","testiology"); 

	$sql1 = "select * from questionpaper";
	 
	$res1 = mysqli_query($con1,$sql1);
	
	$row1 = $res1->fetch_assoc();
	$eid = $row1['eid'];
	
	$sql1 = "select * from report where eid='$eid' and userid = '$userid'";
	 
	$res1 = mysqli_query($con1,$sql1);
		
	while($row1 = $res1->fetch_array())
	{
		array_push($result1,array('correctAns'=>$row1['correctans']));
	}
 
echo json_encode(array("result"=>$result1));
 
mysqli_close($con1);
 
?>