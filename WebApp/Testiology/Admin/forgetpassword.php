
<?php
      
        // Import PHPMailer classes into the global namespace
        // These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        //Load Composer's autoloader
        require 'vendor/autoload.php';

$email="";
$emailerr="";

if(isset($_POST["btnsubmit"]))
{
     $email=$_POST["txtemail"];

   if(empty($_POST["txtemail"]))
   {
    $emailerr="Must be Filled.";
   }
   else
  {
       $admin="select * from admin where email='$email'";
       $conn=mysqli_connect("localhost","root","","testiology");
       $adminresult=$conn->query($admin);
       $admincnt=mysqli_num_rows($adminresult);
       $row = $adminresult->fetch_assoc();

       if($admincnt!=0)
       {
          $pass = $row['passwd'];

                  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'freephotocopycenter@gmail.com';                 // SMTP username
            $mail->Password = 'fpc@@2019';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('freephotocopycenter@gmail.com', 'Testiology');
            $mail->addAddress($email);     // Add a recipient
          
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Forgot Password';
            $mail->Body    = "<p>Your Password for Testiology Application is <strong> $pass </strong>.</p>";

            $mail->send();
           
            echo "<script> alert('Email has been sent. Kindly check your MailBox.'); </script>";
             
         } catch (Exception $e) {
            echo "<script> alert('Something Went Wrong !'); </script>";
          }         

        }
        else
        {
            echo "<script> alert('Wrong Email Address!!!'); </script>";
        }
      }
    }

    if(isset($_POST['btnback']))
    {
      header("location:Login.php");
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
                  <label class="label"><h5><strong>Email :</strong></h5></label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter your Email here" name="txtemail" value="<?php echo $email; ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block" name="btnsubmit" type="submit">Submit</button>
                  <button class="btn btn-primary submit-btn btn-block" name="btnback" type="submit">Back</button>
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