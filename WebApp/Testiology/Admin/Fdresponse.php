<?php
include_once("header.php");
?>


<?php
        // Import PHPMailer classes into the global namespace
        // These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        //Load Composer's autoloader
        require 'vendor/autoload.php';

$email=$_GET['ID'];
$uname="";
$message="";
$subject="";
$msgerr="";
$suberr="";
$flag=0;

$str2="select * from users where Email = '$email'";
$conn2=mysqli_connect("localhost","root","","testiology");
$result2=$conn2->query($str2);
$row2=$result2->fetch_assoc();
$uname=$row2['uname'];  

if(isset($_POST['btnsubmit']))
{
      $message=$_POST['txtmsg'];
      $subject=$_POST['txtsubject'];
  
      if(empty($_POST["txtsubject"]))
      {
        $suberr="Must be filled";
      } 
      else if(empty($_POST["txtmsg"]))
      {
        $msgerr="Must be filled";
      }
      else
      {
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
            
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            echo "<script> alert('Message has been sent.'); </script>";
            $message="";
            $subject="";
         } 
         catch (Exception $e) 
          {        
            echo "<script> alert('Something Went Wrong !'); </script>";
          }
}
}
if(isset($_POST['btncancel']))
{
  header("location:ViewFeedback.php");
}
  
?>

        <div class="content-wrapper">
          <div class="row">
<div class="col-6 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4> Give Response to <b><?php echo $uname; ?></b></h4>
                      <br>
                      <form class="forms-sample">
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email" value='<?php echo $email; ?>' disabled>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Subject</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputPassword2" placeholder="Enter Subject" name='txtsubject' value='<?php echo $subject; ?>'>
                              <font size='2' color="red"><?php echo $suberr; ?></font>
             
                          </div>
                                                
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Message</label>
                          <div class="col-sm-9">
                           <textarea class="form-control" name="txtmsg" placeholder="Enter Message" rows="5"><?php echo $message; ?></textarea>
                     <font size='2' color="red"><?php echo $msgerr; ?></font>
             
                             </div>       
                        </div>
                        <button type="submit" class="btn btn-success mr-2" name='btnsubmit'>Submit</button>
                        <button class="btn btn-light" type = 'submit' name='btncancel'>Cancel</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

<?php
include_once("footer.php");
?>