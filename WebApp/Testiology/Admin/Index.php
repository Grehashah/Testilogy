<?php
include_once "header.php";
?>
<?php
$gkcnt="";
$dscnt="";
$dbmscnt="";
$cppcnt="";
$examcnt="";
$usercnt="";
$subjectname1="";
$subjectname2="";
$subjectname3="";
$subjectname4="";
$sub="";
$subid="";

$str="select * from subject";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
while($row=$result->fetch_assoc())
{
	$sub=$row["name"];

	if($sub=="G.K.")
	{
		$str1="select * from subject where name='$sub'";
        $conn1=mysqli_connect("localhost","root","","testiology"); 
        $result1=$conn1->query($str1);
        $row1=$result1->fetch_assoc();
        $subjectname1=$sub;
        $subid=$row1["subjectid"];

		$str1="select * from question where subjectid='$subid'";
        $conn1=mysqli_connect("localhost","root","","testiology"); 
        $result1=$conn1->query($str1);
        $gkcnt=mysqli_num_rows($result1);
	}

	if($sub=="DS")
	{
		$str1="select * from subject where name='$sub'";
        $conn1=mysqli_connect("localhost","root","","testiology"); 
        $result1=$conn1->query($str1);
        $row1=$result1->fetch_assoc();
        $subjectname2=$sub;
        $subid=$row1["subjectid"];

		$str1="select * from question where subjectid='$subid'";
        $conn1=mysqli_connect("localhost","root","","testiology"); 
        $result1=$conn1->query($str1);
        $dscnt=mysqli_num_rows($result1);
	}	

	if($sub=="DBMS")
	{
		$str1="select * from subject where name='$sub'";
        $conn1=mysqli_connect("localhost","root","","testiology"); 
        $result1=$conn1->query($str1);
        $row1=$result1->fetch_assoc();
        $subjectname3=$sub;
        $subid=$row1["subjectid"];

		$str1="select * from question where subjectid='$subid'";
        $conn1=mysqli_connect("localhost","root","","testiology"); 
        $result1=$conn1->query($str1);
        $dbmscnt=mysqli_num_rows($result1);
	}

if($sub=="CPP")
	{
		$str1="select * from subject where name='$sub'";
        $conn1=mysqli_connect("localhost","root","","testiology"); 
        $result1=$conn1->query($str1);
        $row1=$result1->fetch_assoc();
        $subjectname4=$sub;
        $subid=$row1["subjectid"];

		$str1="select * from question where subjectid='$subid'";
        $conn1=mysqli_connect("localhost","root","","testiology"); 
        $result1=$conn1->query($str1);
        $cppcnt=mysqli_num_rows($result1);
	}			
}

$str="select * from exams";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
while($row=$result->fetch_assoc())
{
  $examcnt++;
}

$str="select * from users";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
while($row=$result->fetch_assoc())
{
  $usercnt++;
}

?>
<div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/img/SCHOOL13-128.png" width="120" alt="">
                    </div>

                    <div class="float-right">
                    	<br>
                      <p class="mb-0 text-right">Total Questions of <?php echo $subjectname1; ?></p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $gkcnt; ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="" aria-hidden="true"></i> 
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/img/folder_management_data_structure_setting_-128.png" width="120" alt="">
                    </div>
                    <div class="float-right">
                    	<br>
                      <p class="mb-0 text-right">Total Questions of <?php echo $subjectname2; ?></p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $dscnt; ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="" aria-hidden="true"></i> 
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/img/4_database_management_safe_secure_lock_protection-128.png" width="120" alt="">
                    </div>
                    <div class="float-right">
                    	<br>
                      <p class="mb-0 text-right">Total Questions of <?php echo $subjectname3; ?></p>
                      <div class="fluid-container">

                        <h3 class="font-weight-medium text-right mb-0"><?php echo $dbmscnt; ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="" aria-hidden="true"></i> 
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/img/_cpp-128.png" width="120" alt="">
                    </div>
                    <div class="float-right">
                    	<br>
                      <p class="mb-0 text-right">Total Questions of <?php echo $subjectname4; ?></p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $cppcnt; ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="" aria-hidden="true"></i>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/img/test-128.png" width="120" alt="">
                    </div>
                    <div class="float-right">
                      <br>
                      <p class="mb-0 text-right">Total Exams Conducted</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $examcnt; ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="" aria-hidden="true"></i>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/img/196-128.png" width="120" alt="">
                    </div>
                    <div class="float-right">
                      <br>
                      <p class="mb-0 text-right">Total No. of Users</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $usercnt; ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="" aria-hidden="true"></i>
                  </p>
                </div>
              </div>
            </div>
          </div>
<?php
include_once "footer.php";
?>
