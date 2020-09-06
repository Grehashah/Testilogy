<?php
 

$con = mysqli_connect("localhost","root","","testiology"); 

$sql = "select name,p1,tq1 from subject join (select subjectid,place as p1,totalque as tq1 from exams join questionpaper on exams.eid=questionpaper.eid) as r1 on r1.subjectid = subject.subjectid";
 
 $res = mysqli_query($con,$sql);
$result = array();
 
$row = $res->fetch_array();
array_push($result,array('Subject'=>$row['name'],
'Place'=>$row['p1'],
'TotalQue'=>$row['tq1']));
 
echo json_encode(array("result"=>$result));
 
mysqli_close($con);
 
?>