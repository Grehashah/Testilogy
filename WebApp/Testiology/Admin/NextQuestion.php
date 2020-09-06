<?php 
include_once("Header2.php");
?>


<?php
$qpid=$_GET["ID"];
$qpid++;
$str0="select * from questionpaper where qpid='$qpid'";
$conn0=mysqli_connect("localhost","root","","testiology");
$result0=$conn0->query($str0);
$row0 = $result0->fetch_assoc();
$qid=$row0['qid'];
$qpid1=$row0['qpid'];


$str="select * from question where qid = '$qid'";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$row = $result->fetch_assoc();
$que=$row['questions'];


?>



<form name="form" method="POST">
<div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body"  align='center'>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <h1><?php echo $que; ?></h1>
        
                    <?php

$str0="select * from questionpaper where qpid='$qpid'";
$conn0=mysqli_connect("localhost","root","","testiology");
$result0=$conn0->query($str0);
$row0 = $result0->fetch_assoc();
$qpid1=$row0['qpid'];
if(!empty($qpid1))
{

  function send_notification ($tokens, $message)
  {
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
       'registration_ids' => $tokens,
       'data' => $message
      );

    $headers = array(
      'Authorization:key = AAAAT86VsZ8:APA91bEbnOtcJRvMIy9ALKtFOoNVLA1j03UwZwS9BBWwe1d1zB7yE7ToMUQ548-BW2NxIG30NyMuSGmli1x9rVy4kdNqDAv4QgddZFnxgweVcnKRwXO9iUQkSASJBCNpaWGi_tX8Ir7B',
      'Content-Type: application/json'
      );

     $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);           
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
  }
  

  $conn = mysqli_connect("localhost","root","","testiology");

  $sql = " Select token From devices where ready ='1'";

  $result = mysqli_query($conn,$sql);
  $tokens = array();

  if(mysqli_num_rows($result) > 0 ){

    while ($row = mysqli_fetch_assoc($result)) {
      $tokens[] = $row["token"];
    }
  }

  mysqli_close($conn);

  $message = array("message" => $qpid1);
  $message_status = send_notification($tokens, $message);

	 $str2=" <a href='NextQuestion.php?ID=".$qpid."'class='btn btn-success' style='margin-top:270px; margin-left:1200px'>Next</a>";
echo $str2;

}
else
{

  function send_notification ($tokens, $message)
  {
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
       'registration_ids' => $tokens,
       'data' => $message
      );

    $headers = array(
      'Authorization:key = AAAAT86VsZ8:APA91bEbnOtcJRvMIy9ALKtFOoNVLA1j03UwZwS9BBWwe1d1zB7yE7ToMUQ548-BW2NxIG30NyMuSGmli1x9rVy4kdNqDAv4QgddZFnxgweVcnKRwXO9iUQkSASJBCNpaWGi_tX8Ir7B',
      'Content-Type: application/json'
      );

     $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);           
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
  }
  

  $conn = mysqli_connect("localhost","root","","testiology");

  $sql = " Select token From devices where ready = '1'";

  $result = mysqli_query($conn,$sql);
  $tokens = array();

  if(mysqli_num_rows($result) > 0 ){

    while ($row = mysqli_fetch_assoc($result)) {
      $tokens[] = $row["token"];
    }
  }

  mysqli_close($conn);

  $message = array("message" => "endexam");
  $message_status = send_notification($tokens, $message);

	echo "<script>location.href='EndExam.php'</script>";
}


?>
                      <br>
                    </div>
                  </div>

                 </div>
             </form>

