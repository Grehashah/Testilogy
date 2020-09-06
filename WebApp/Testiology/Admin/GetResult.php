
<?php
include_once "header.php";

$cnt=0;
$cnt1=0;
$cnt2=0;
$tq=0;

  $str0="select * from questionpaper";
$conn0=mysqli_connect("localhost","root","","testiology");
$result0=$conn0->query($str0);
$row0=$result0->fetch_assoc();
  $eid=$row0["eid"];
$tq=mysqli_num_rows($result0);

$str="select * from userexam where eid = '$eid'";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$cnt2=mysqli_num_rows($result);

while($row=$result->fetch_assoc())
{
	$uid = $row['uid'];
  $str1="select * from usersanswer where userid = '$uid'";
  $conn1=mysqli_connect("localhost","root","","testiology");
  $result1=$conn1->query($str1);
 
while($row1=$result1->fetch_assoc())
{

    $answer=$row1["answer"];
    $qid=$row1["qid"];

    $str2="select * from question where qid = '$qid'";
    $conn2=mysqli_connect("localhost","root","","testiology");
    $result2=$conn2->query($str2);
    $row2=$result2->fetch_assoc();
    $answer1=$row2["answer"];

    if($answer==$answer1)
    {
      $cnt1++;
    }
}

 $str3="insert into report values('','$uid','$eid',0,'$cnt1')";
$conn3=mysqli_connect("localhost","root","","testiology");
$result3=$conn3->query($str3);

$cnt1=0;
}

$str3="select MAX(correctans) as max from report where eid='$eid'";
$conn3=mysqli_connect("localhost","root","","testiology");
$result3=$conn3->query($str3);
$row3 = $result3->fetch_assoc();
$max="";
$max=$row3['max'];

$str3="update report set rank = '1' where correctans = '$max'";
$conn3=mysqli_connect("localhost","root","","testiology");
$result3=$conn3->query($str3);

?>

        <div class="content-wrapper">
          <div class="row">
      <div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h3>Exam Report</h3>
                  <br>
                  <a href='DeletePaper.php' class='btn btn-success' style="margin-left: 1000px; margin-top: -110px;">Submit</a>
                    <div align="center">
                    	<br>
                      <h3>Total Number of Students Appear : <?php echo $cnt2 ?></h3>
                       </div>
                       <br>
                       <br>
                  
                  <div class="table-responsive">

<?php

$uid="";
$str11="";

$str0="select * from report where eid='$eid'";
$conn0=mysqli_connect("localhost","root","","testiology");
$result0=$conn0->query($str0);

$str1="<table class='table table-bordered'>";
$str1.="<thead>
            <tr>  
                <th> <font size='3'>Sr. No</font></th>
                <th><font size='3'> UserName </th>
                <th><font size='3'> Total Ques </th>
                <th><font size='3'> Correct Ans </th>
            </tr>
        </thead>";
$no=1;
while($row0=$result0->fetch_assoc())
{
	$uid = $row0['userid'];

$str="select * from users where userid = '$uid'";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$row=$result->fetch_assoc();

$uname = $row['uname'];

if($row0['rank'] == '1')
{
	$color='lightgreen';
}
else
{
	$color = "";
}

  $str1.="<tr style='background-color : ".$color.";'><td>".$no."</td><td>".$uname."</td><td>".$tq."</td><td>".$row0['correctans']."</td></tr>";
  $no++;
}

$str1.="</table>";
echo $str1;
?>

                </div>
              </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once "footer.php";
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

  $message = array("message" => "getresult");
  $message_status = send_notification($tokens, $message);
?>
