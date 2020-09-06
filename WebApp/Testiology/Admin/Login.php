
<?php
        
$uname="";
$pwd="";
$isauth="";
$unameerr="";
$pwderr="";
$err="";

if(isset($_POST["btnsubmit"]))
{
     $uname=$_POST["txtuname"];
     $pwd=$_POST["txtpwd"];

   if(empty($_POST["txtuname"]))
   {
    $unameerr="Must be Filled.";
   }
   else if(empty($_POST["txtpwd"]))
   {
    $pwderr="Must be Filled.";
   }
   else
  {
       $admin="select * from admin where BINARY uname='$uname' and BINARY passwd='$pwd'";
       
       $conn=mysqli_connect("localhost","root","","testiology");
       $adminresult=$conn->query($admin);
       $admincnt=mysqli_num_rows($adminresult);
       $row = $adminresult->fetch_assoc();

       if($admincnt!=0)
       {
          session_start();

          $_SESSION['AdminID'] = $row['adminid'];  
          $_SESSION['AdminName'] = $row['name'];

          $row=$adminresult->fetch_assoc();
          
			if(!empty($_POST['chkremeber']))
    	    {
              setcookie("admin_name",$_POST["txtuname"],time()+(10 * 365 * 24 * 60 *60));
              setcookie("admin_password",$_POST["txtpwd"],time()+(10 * 365 * 24 * 60 *60));
            }
            else
            {
              if(isset($_COOKIE['admin_name']))
              {
                setcookie("admin_name","");
              }
              if(isset($_COOKIE['admin_password']))
              {
                setcookie("admin_password","");
              }
            }

            header("location:Index.php");
        }
        else
        {
          $uname = "";
          $pwd = "";
          $err = "Wrong Username or Password";  
        }
      }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin Free Bootstrap Admin Dashboard Template</title>
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
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <form action="#" method="POST">
                <div class="form-group">
                	<h1 align="center" style="font-style: italic;"><strong>Testiology</strong></h1>
          <br><br>
            
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Username" name="txtuname" value="<?php if(isset($_COOKIE["admin_name"])) { echo $_COOKIE["admin_name"]; } ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>

                        <font color="red"><?php echo $unameerr; ?></font>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="*********" name="txtpwd" value="<?php if(isset($_COOKIE["admin_password"])) { echo $_COOKIE["admin_password"]; } ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>

                        <font color="red"><?php echo $pwderr; ?></font>
                </div>
                      <font color="red"><?php echo $err; ?></font>
                
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block" name="btnsubmit" type="submit">Login</button>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="chkremeber" <?php if(isset($_COOKIE["admin_name"])){ echo "checked"; } ?>> Keep me signed in
                    </label>
                  </div>
                  <a href="forgetpassword.php" class="text-small forgot-password text-black">Forgot Password</a>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="Register.php" class="text-black text-small">Create new account</a>
                </div>
              </form>
            </div>
            </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
</body>

</html>