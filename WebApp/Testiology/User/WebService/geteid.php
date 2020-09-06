<?php
 

$con = mysqli_connect("localhost","root","","testiology"); 

$sql = "select eid from questionpaper";

 $res = mysqli_query($con,$sql);
$result = array();
 
$row = $res->fetch_array();
 
array_push($result,array('Eid'=>$row['eid']));

echo json_encode(array("result"=>$result)); 
mysqli_close($con);
 
?>