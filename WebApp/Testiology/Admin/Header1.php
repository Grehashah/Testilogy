<?php

session_start();
if(isset($_POST["btnstart"]))
{
  echo "<script>location.href='StartExam.php'</script>";
}
if(isset($_POST["btncancel"]))
{
  echo "<script>location.href='CancelExam.php'</script>";
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
      <div>
             <form name="frm" method="POST">
        <button class="btn btn-primary submit-btn btn-block" name="btncancel" type="submit">Cancel Exam</button>
                </
              </form>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
             <form name="frm" method="POST">
        <button class="btn btn-primary submit-btn btn-block" name="btnstart" type="submit">Start Exam</button>
                </
              </form>
        </ul>
      </div>
    </nav>
    <!-- partial -->
