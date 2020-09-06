<?php
include_once "header.php";
?>
<div class="content-wrapper">
          <div class="row">
			<div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h3>Exam's History</h3>
                  <br>
                  <div class="table-responsive">
<?php

$eid=$_GET['ID'];

$str="select * from report where eid='$eid'";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$str1="<table class='table table-bordered'>";
$str1.="<thead>
            <tr>  
                <th> <font size='2'>Sr. No</font></th>
                <th><font size='2'> UserName </th>
                <th><font size='2'> CorrectAnswer </th>
                <th><font size='2'> no. of Questions</th>
             </tr>
        </thead>";
$no=1;
while($row=$result->fetch_assoc())
{
  $correctans=$row["correctans"];
  $uid=$row["userid"];
  $eid=$row["eid"];
	$str11="select * from users where userid='$uid'";
	$conn11=mysqli_connect("localhost","root","","testiology");
	$result11=$conn11->query($str11);
	$row11=$result11->fetch_assoc();
	$uname=$row11["uname"];


$str11="select * from exams where eid='$eid'";
$conn11=mysqli_connect("localhost","root","","testiology");
$result11=$conn11->query($str11);	
$row11=$result11->fetch_assoc();
$tq=$row11["totalque"];

$str12="select MAX(correctans) as max from report where eid='$eid'";
$conn12=mysqli_connect("localhost","root","","testiology");
$result12=$conn12->query($str12);
$row12=$result12->fetch_assoc();
$maxans=$row12["max"];

if($correctans == $maxans)
{
  $str1.="<tr style='background:lightgreen' class='table'><td>".$no."</td><td>".$uname."</td><td>".$correctans."</td><td>".$tq."</td></tr>";
                $no++;
}
else
{
  $str1.="<tr class='table'><td>".$no."</td><td>".$uname."</td><td>".$correctans."</td><td>".$tq."</td></tr>";
                $no++; 
}

  
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
?>