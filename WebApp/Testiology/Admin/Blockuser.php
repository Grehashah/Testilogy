
<?php
$isauth="";
$uid=$_GET["ID"];

$str2="select * from users where userid='$uid'";
$conn2=mysqli_connect("localhost","root","","testiology");
$result2=$conn2->query($str2);
$row=$result2->fetch_assoc();

$isauth=$row["isauth"];

if($isauth=="yes")
{
	$isauth="no";	
}
else
{
	$isauth="yes";
}

$str2="update users set isauth='$isauth' where userid='$uid'";
$conn2=mysqli_connect("localhost","root","","testiology");
$result2=$conn2->query($str2);

echo("<script>location.href='Userdetails.php'</script>");
?>

