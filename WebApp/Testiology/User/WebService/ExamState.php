<?php
 

$con = mysqli_connect("localhost","root","","testiology"); 

$sql = "select * from questionpaper";
 
 $res = mysqli_query($con,$sql);
$result = array();
 
 $cnt = mysqli_num_rows($res);

 if($cnt != 0)
 {
 	$result['error'] = "false";
 }
 else
 {
 	$result['error'] = "true"; 	
 }
 
echo json_encode($result);

mysqli_close($con);
 
?>