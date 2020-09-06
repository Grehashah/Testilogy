<?php
 
$uname = "";
$uname = $_GET['UName'];

$con = mysqli_connect("localhost","root","","testiology"); 

$sql = "select doc1,name,place1 from subject join (select doc as doc1 ,subjectid,place as place1 from exams join (select eid from userexam join (select userid from users where uname='$uname' ) as r1 on userexam.uid = r1.userid ) as r2 on r2.eid=exams.eid ) as r3 on r3.subjectid = subject.subjectid";
 
 $res = mysqli_query($con,$sql);
$result = array();
 
while($row = $res->fetch_array())
{
array_push($result,array('Doc'=>$row['doc1'],
'Subject'=>$row['name'],
'Place'=>$row['place1']));
}
 
echo json_encode(array("result"=>$result));
 
mysqli_close($con);
 
?>