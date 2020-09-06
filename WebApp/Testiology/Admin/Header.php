<?php


$lastseen="";
$name="";
$aid="";
session_start();
$aid = $_SESSION['AdminID'];
$adminName = $_SESSION['AdminName'];

$strr="select * from admin where adminid='$aid'";
$connn=mysqli_connect("localhost","root","","testiology");
$resultt=$connn->query($strr);
$roww=$resultt->fetch_assoc();
$name=$roww["name"];
$pic=$roww['pic'];

if(isset($_POST["btnlogout"]))
{
  date_default_timezone_set('Asia/Kolkata');
  $lastseen=date("Y-m-d h-i-s");
  $str="update admin set lseen='$lastseen'";
  $conn=mysqli_connect("localhost","root","","testiology");
  $result=$conn->query($str); 
  echo("<script>location.href='http://localhost/testiology/Admin/Login.php'</script>");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Testiology</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/main_logo.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a  href="index.php">
          <img src="images/logo.png" alt="logo" height="60px" style="margin-top: 3px;">
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
             <form name="frm" method="POST">
        <button class="btn btn-primary submit-btn btn-block" name="btnlogout" type="submit">Sign Out</button>
                </
              </form>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                  <img src="images/user-photos/<?php echo $pic; ?>" alt="profile image" height="200%" width="200%" style="margin-top: 10px;">
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title"><font size="3">Dashboard</font></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Profile.php">
           <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title"><font size="3">Your Profile</font></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ConductExam.php">
         <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title"><font size="3">Conduct Exam</font></span>
            </a>   
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ExamHistory.php">
          <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title"><font size="3">Exam History</font></span>
            </a>   
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Questions.php">
         <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title"><font size="3">Questions</font></span>
            </a>   
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Userdetails.php">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title"><font size="3">User Details</font></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ViewFeedback.php">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title"><font size="3">View Feedback</font></span>
            </a>   
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          