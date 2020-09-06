<?php 
include_once("Header2.php");
?>

<?php
$no=1;
$str="select * from questionpaper";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$row=$result->fetch_assoc();
$qpid=$row["qpid"];
$eid=$row["eid"];

session_start();
$_SESSION["eid"]=$eid;

$str1="select * from questionpaper where qpid='$qpid'";
$conn1=mysqli_connect("localhost","root","","testiology");
$result1=$conn1->query($str1);
$row1=$result1->fetch_assoc();
$qid=$row1["qid"];

$str1="select * from question where qid = '$qid'";
$conn1=mysqli_connect("localhost","root","","testiology");
$result1=$conn1->query($str1);
$row1 = $result1->fetch_assoc();
$que=$row1['questions'];

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

  $sql = " Select token From devices where ready='1'";

  $result = mysqli_query($conn,$sql);
  $tokens = array();

  if(mysqli_num_rows($result) > 0 ){

    while ($row = mysqli_fetch_assoc($result)) {
      $tokens[] = $row["token"];
    }
  }

  mysqli_close($conn);

  $message = array("message" => $qpid);
  $message_status = send_notification($tokens, $message);
 
  $str2=" <a href='NextQuestion.php?ID=".$qpid."'class='btn btn-success' style='margin-top:270px; margin-left:1200px'>Next</a>";
echo $str2;

?>

  

                      <br>
                    </div>
                  </div>

                 </div>
             </form>


