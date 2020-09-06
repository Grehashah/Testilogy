<?php 

$id = $_GET['ID'];

$str0="delete from question where qid = '$id'"; 
$conn0=mysqli_connect("localhost","root","","testiology");
$result0=$conn0->query($str0);

echo "<script>location.href='SearchQue.php'</script>";
?>

            
