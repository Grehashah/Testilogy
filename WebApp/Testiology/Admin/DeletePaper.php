
<?php

session_start();
$cnt=0;
$str="select * from questionpaper";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$row=$result->fetch_assoc();
$eid=$row["eid"];

$str1="select * from userexam where eid='$eid'";
$conn1=mysqli_connect("localhost","root","","testiology");
$result1=$conn1->query($str1);
while($row1=$result1->fetch_assoc())
{
	$cnt++;
}


$str1="update exams set attendance='$cnt' where eid='$eid'";
$conn1=mysqli_connect("localhost","root","","testiology");
$result1=$conn1->query($str1);

$str="delete from questionpaper";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);

$str="delete from usersanswer";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);

$str="update devices set ready = '0'";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);

echo "<script>location.href='index.php'</script>";

?>