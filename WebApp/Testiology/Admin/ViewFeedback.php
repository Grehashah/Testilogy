
<?php
include_once "header.php";
?>
        <div class="content-wrapper">
          <div class="row">
			<div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                 <h3>View Feedback</h3>
                  <br>
                   <div class="table-responsive">
<?php

$uid="";
$str11="";
$str="select * from feedback";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$str1="<table class='table table-hover'>";
$str1.="<thead>
            <tr>  
                <th> <font size='3'>Sr. No</font></th>
                <th><font size='3'> Username </th>
                <th><font size='3'> Experience </th>
                <th><font size='3'> Comment </th>
            </tr>
        </thead>";
$no=1;
while($row=$result->fetch_assoc())
{
  $email = $row['email'];
$str11="select * from users where email = '$email'";
$conn1=mysqli_connect("localhost","root","","testiology");
$result1=$conn1->query($str11);
$row1=$result1->fetch_assoc();

  $str1.="<tr><td>".$no."</td><td>".$row1["uname"]."</td><td>".$row["exp"]."</td><td>".$row["comment"]."</td><td> <a href='Fdresponse.php?ID=".$email."'class='btn btn-primary'>Response</a></td></tr>";
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
