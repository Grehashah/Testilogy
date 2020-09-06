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

  $message = array("message" => "sorry");
  $message_status = send_notification($tokens, $message);


$str="delete from questionpaper";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);

$str="Select * from exams";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
while($row=$result->fetch_assoc())
{
	$eid=$row['eid'];
}

$str="delete from exams where eid='$eid'";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);

echo "<script>location.href='ConductExam.php'</script>";

?>