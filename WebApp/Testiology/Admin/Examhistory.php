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

$dua="";
$subid="";
$eid="";
$uid="";
$subname="";
$str="select * from exams";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$str1="<table class='table table-bordered'>";
$str1.="<thead>
            <tr>  
                <th> <font size='2'>Sr. No</font></th>
                <th><font size='2'> Date of Conduct </th>
                <th><font size='2'> Place </th>
                <th><font size='2'> SubjectName </th>
                <th><font size='2'> no. of Questions</th>
                <th><font size='2'>Attendance</th>
                <th><font size='2'>Action List</th>
            </tr>
        </thead>";
$no=1;
while($row=$result->fetch_assoc())
{
	$eid=$row["eid"];
	$subid=$row["subjectid"];
	$str11="select * from subject where subjectid='$subid'";
	$conn11=mysqli_connect("localhost","root","","testiology");
	$result11=$conn11->query($str11);
	$row11=$result11->fetch_assoc();
	$subname=$row11["name"];

	$str12="select * from report where rank='1' and eid='$eid'";
	$conn12=mysqli_connect("localhost","root","","testiology");
	$result12=$conn12->query($str12);
	$row12=$result12->fetch_assoc();
	$uid=$row12["userid"];

	$str2="select * from users where userid='$uid'";
	$conn2=mysqli_connect("localhost","root","","testiology");
	$result2=$conn2->query($str2);
	$row2=$result2->fetch_assoc();
	$uname=$row2["uname"];
	

  $str1.="<tr class='table'><td>".$no."</td><td>".$row["doc"]."</td><td>".$row["place"]."</td><td>".$subname."</td><td>".$row["totalque"]."</td><td>".$row["attendance"]."</td><td> <a href='Winners.php?ID=".$row["eid"]."'class='btn btn-primary'>Show List of Winners</a> </td></tr>";
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
?>