<?php
 
$qpid = "";
$qpid = $_GET['qpid'];

$con = mysqli_connect("localhost","root","","testiology"); 

$sql = "select qid from questionpaper where qpid = '$qpid'";
 
$res = mysqli_query($con,$sql);

$row = $res->fetch_assoc();
$qid = $row['qid']; 
 

	$con1 = mysqli_connect("localhost","root","","testiology"); 
	$sql1 = "select * from question where qid = '$qid'";
	$res1 = mysqli_query($con1,$sql1);
	$result1 = array();

		$row1=$res1->fetch_array();
		array_push($result1,array('option1'=>$row1['option1'],
			'option2'=>$row1['option2'],
			'option3'=>$row1['option3'],
			'option4'=>$row1['option4'],
			'qid'=>$row1['qid']));
 
echo json_encode(array("result"=>$result1));
 
mysqli_close($con);
 
?>