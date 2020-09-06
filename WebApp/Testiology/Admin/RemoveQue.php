<?php 

$id = $_GET['ID'];

$str0="delete from questionpaper where qid = '$id'"; 
$conn0=mysqli_connect("localhost","root","","testiology");
$result0=$conn0->query($str0);

echo "<script>location.href='ChooseQue.php'</script>";
?>

            
