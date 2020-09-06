<script>

function charactersonly()
{
  if((event.keyCode>=65 && event.keyCode<=90) || (event.keyCode>=97 && event.keyCode<=122))
  {
    return true;
  }
  else
  {
    return false;
  }
}
function numsonly()
{
  if((event.keyCode>=48 && event.keyCode<=59))
  {
    return true;
  }
  else
  {
    return false;
  }
}

</script>


<?php

$no=0;
$flag=0;
$admincnt1=0;
$r1="";
$r2="";
$uname="";
$name="";
$pwd="";
$gender="";
$address="";
$contactno="";
$email="";
$dob="";
$doj="";
$pic="";
$lastseen="";
$isauth="";
$str="";
$result="";
$conn="";
$confirmpwd="";
$unameerr="";
$nameerr="";
$pwderr="";
$pwderr1="";
$gendererr="";
$addresserr="";
$contactnoerr="";
$emailerr="";
$doberr="";
$dojerr="";
$confirmpwderr="";
$confirmpwderr1="";
$contactnoerr1="";
$pic="";
$str1="";
$conn1="";
$result1="";
$mpicerr="";
$mpicerr1="";
$mpicerr2="";
$mpicerr3="";
$doberr="";

if(isset($_POST["btnsubmit"]))
{
  $name=$_POST["txtname"];
  $uname=$_POST["txtuname"];
  $pwd=$_POST["txtpwd"];
  $address=$_POST["txtaddress"];
  $contactno=$_POST["txtcno"];
  $email=$_POST["txtemail"];
  $confirmpwd=$_POST["txtconpwd"];
  $dob=$_POST["txtdob"];
  $pic="a3.jpg";

  if(!empty($_POST["rdbgender"]))
  {
    $gender=$_POST["rdbgender"];  
      if($gender=="M")
      {
        $r1="checked";
      }
      if($gender=="F")
      {
        $r2="checked";
      }
  }

             //Image Upload 

              $file=$_FILES['image'];
              $fileName=$_FILES['image']['name'];
              $fileTmpName=$_FILES['image']['tmp_name'];
              $fileSize=$_FILES['image']['size'];
              $fileError=$_FILES['image']['error'];
              $fileType=$_FILES['image']['type'];

              $fileExt=explode('.', $fileName);
              $fileActualExt=strtolower(end($fileExt));

              $allowed=array('jpg','jpeg','png');

  if(empty($_POST["txtname"]))
  {
      $nameerr="Must be filled.";
  }
  else if(empty($_POST["txtuname"]))
  {
      $unameerr="Must be filled.";
  }
  else if(empty($_POST["txtpwd"]))
  {
      $pwderr="Must be filled.";
  }
  else if(empty($_POST["txtconpwd"]))
  {
      $confirmpwderr="Must be filled.";
  }
  else if($_POST["txtpwd"]!=$_POST["txtconpwd"])
  {
    $confirmpwderr1="Password did not Match."; 
  }
  else if(empty($_POST["txtcno"]))
  {
      $contactnoerr="Must be filled.";
  }
  else if(empty($_POST["txtemail"]))
  {
      $emailerr="Must be filled.";
  }
  else if(empty($_POST["txtaddress"]))
  {
      $addresserr="Must be filled.";
  }
  else if(empty($_POST["txtdob"]))
  {
    $dobererr="Must be Selected.";
  }
  else if(empty($_POST["rdbgender"]))
  {
    $gendererr="Must be Selected.";
  }
  else if($fileName=="")
  {
    $mpicerr="Pic must be uploaded.";
  }
  else if(!in_array($fileActualExt, $allowed))
  { 
   $mpicerr1="Only jpg , jpeg or png image are allowed.";
  }
  else if($fileError != 0)
  {
    $mpicerr2="There was an error while uploading your Image.";
  }
  else if($fileSize > 1000000)
  { 
   $mpicerr3="Your Image size must be within 10MB.";
  }
  else
  {
    date_default_timezone_set('Asia/Kolkata');
  $doj=date("Y-m-d h-i-s");

  date_default_timezone_set('Asia/Kolkata');
  $lastseen=date("Y-m-d h-i-s");

  $str="select * from admin where uname='$uname'";
  $conn=mysqli_connect("localhost","root","","testiology");
  $result=$conn->query($str);
  $cnt=mysqli_num_rows($result);

  if($cnt!=0)
  {
      echo "<script> alert('Entered Username is already Registred! Enter Another one.') </script";
  }
  else
  {
                   $strr="select * from admin";
                  $connn=mysqli_connect("localhost","root","","testiology");
                  $resultt=$connn->query($strr);
                  while($roww=$resultt->fetch_assoc())
                  {
                    $no++;
                  }
                  $no++;
                    $fileNameNew = "a".mt_rand(100000,999999).$no.".".$fileActualExt;
                    $fileDestination="images/user-photos/".$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                     
      
  $str1="insert into admin values('','$name','$uname','$pwd','$contactno','$email','$address','$doj','$dob','$fileNameNew','$gender','$lastseen')";
  $conn1=mysqli_connect("localhost","root","","testiology");
  $result1=$conn1->query($str1);
  echo("<script>location.href='http://localhost/Testiology/Admin/Login.php'</script>");

  }  
  }

}

if(isset($_POST['btncancel']))
{
  echo("<script>location.href='http://localhost/Testiology/Admin/Login.php'</script>");	
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
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <h2 class="text-center mb-4">SignUp Form</h2>
            <div class="auto-form-wrapper">
              <form action="#" name="frm1" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <b>Name :</b>
                  <div class="input-group">
                    <input type="text" class="form-control" name="txtname" placeholder="Name" value="<?php echo $name; ?>" onkeypress="return charactersonly();" maxlength='20'>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                  <font color="red"><?php echo $nameerr; ?></font>
                </div>
                
                
                <div class="form-group">
                    <b>UserName :</b>
                  <div class="input-group">
                    <input type="text" class="form-control" name="txtuname" placeholder="Username" value="<?php echo $uname; ?>"  maxlength='20'>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                  <font color="red"><?php echo $unameerr; ?></font>
                </div>
                <div class="form-group">
                  <b>Password :</b>
                  <div class="input-group">
                    <input type="password" class="form-control" name="txtpwd" placeholder="Password" value="<?php echo $pwd; ?>" maxlength="8">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                  <font color="red"><?php echo $pwderr; ?></font>
                </div>
                <div class="form-group">
                  <b>Confirm password :</b>
                  <div class="input-group">
                    <input type="password" class="form-control" name="txtconpwd" placeholder="Confirm Password" value="<?php echo $confirmpwd; ?>" maxlength="8">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                  <font color="red"><?php echo $confirmpwderr; ?><?php echo $confirmpwderr1; ?></font>
                </div>
                <div class="form-group">
                  <b>Contactno :</b>
                  <div class="input-group">
                    <input type="text" class="form-control" name="txtcno" placeholder="Contact-no" maxlength='10' onkeypress="return numsonly();" value="<?php echo $contactno; ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                  <font color="red"><?php echo $contactnoerr;?></font>
                </div>
                <div class="form-group">
                  <b>Email :</b>
                  <div class="input-group">
                    <input type="text" class="form-control" name="txtemail" placeholder="Email" value="<?php echo $email; ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                  <font color="red"><?php echo $emailerr; ?></font>
                </div>
                <div class="form-group">
                  <b>Address :</b>
                  <div class="input-group">
                    <textarea class="form-control" name="txtaddress" placeholder="Address" rows="5" cols="10" maxlength="300"><?php echo $address; ?></textarea>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                  <font color="red"><?php echo $addresserr; ?></font>
                </div>
                <br>
                <br>
                <div class="form-group">
                  <b>Date of Birth :</b>
                  <div class="input-group">
                    <input class="form-control input-sm" id="dob" name="txtdob" type="date" value="<?php echo $dob; ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <b>Gender :</b>
                  <div class="input-group">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <input type="radio" value="M" name="rdbgender" <?php echo $r1; ?>> Male </input>&nbsp;
                        <input type="radio" value="F" name="rdbgender" <?php echo $r2; ?>> Female </input>&nbsp;
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <font color="red"><?php echo $gendererr; ?></font>
                </div>
              </div>
              
                <div class="form-group">
                  <b>Image Upload :</b>
                  <div class="input-group">
                    <div class="input-group-append">
                    
                      <input type="hidden" name="size" value="1000000">
                      <input type="file" name="image" style="font-size: 15px;"> 
                </div>
              </div>
                 <font color="red"><?php echo $mpicerr; echo $mpicerr1; echo $mpicerr2; echo $mpicerr3; ?></font> 
            </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block" name="btnsubmit" type="submit">Register</button>
                  <button class="btn btn-primary submit-btn btn-block" name="btncancel" type="submit">Cancel</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Already have and account ?</span>
                  <a href="Login.php" class="text-black text-small">Login</a>
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