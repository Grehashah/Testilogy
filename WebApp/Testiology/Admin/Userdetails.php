
<?php
include_once "header.php";
?>
        <div class="content-wrapper">
          <div class="row">
			<div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h3>User Details</h3>
                  <br>
                  <div class="table-responsive">
<?php

$uid="";
$str11="";
$str="select * from users";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$str1="<table class='table table-bordered'>";
$str1.="<thead>
            <tr>  
                <th> <font size='3'>Sr. No</font></th>
                <th><font size='3'> UserName </th>
                <th><font size='3'> Email </th>
                <th><font size='3'> ContactNo </th>
                <th><font size='3'> Qualification </th>
                <th><font size='3'>Action List</th>
            </tr>
        </thead>";
$no=1;
while($row=$result->fetch_assoc())
{
  $isauth=$row["isauth"];
  if($isauth=="yes")
  {
      $str11="Blocked";
  }
  else
  {
      $str11="Unblocked";
  }
  $str1.="<tr class='table-primary'><td>".$no."</td><td>".$row["uname"]."</td><td>".$row["email"]."</td><td>".$row["contactno"]."</td><td>".$row["qualification"]."</td><td> <a href='Blockuser.php?ID=".$row["userid"]."'class='btn btn-danger'>$str11</a> </td></tr>";
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
