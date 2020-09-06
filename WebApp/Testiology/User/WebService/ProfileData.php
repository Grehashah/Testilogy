<?php
 
$uname = "";
$uname = $_GET['UName'];

$con = mysqli_connect("localhost","root","","testiology"); 

$sql = "select * from users where uname = '$uname'";
 
$res = mysqli_query($con,$sql);
 
$result = array();
 
while($row = $res->fetch_array())
{
array_push($result,array('UName'=>$row['uname'],
'Password'=>$row['passwd'],
'ContactNo'=>$row['contactno'],
'Email'=>$row['email'],
'Qual'=>$row['qualification']));
}
 
echo json_encode(array("result"=>$result));
 
mysqli_close($con);
 
?>
