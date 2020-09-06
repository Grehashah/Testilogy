<?php
include_once("Header.php");
?>
<script>

function charnumonly()
  {
    if((event.keyCode>=65 && event.keyCode<=90) || (event.keyCode>=97 && event.keyCode<122) || (event.keyCode>=48 && event.keyCode<=57) || event.keyCode==32)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

function charactersonly()
{
  if((event.keyCode>=65 && event.keyCode<=90) || (event.keyCode>=97 && event.keyCode<122))
  {
    return true;
  }
  else
  {
    return false;
  }
}

function numbersonly()
{
  if(event.keyCode>=48 && event.keyCode<=57)
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
$mgendererr1="";
$str="select * from admin where adminid='$aid'";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str); 
$row=$result->fetch_assoc();

$name=$row["name"];
$uname=$row["uname"];
$pwd=$row["passwd"];
$cno=$row["contactno"];
$email=$row["email"];
$address=$row["address"];
$dob=$row["dob"];
$gender=$row["gender"];
$pic = $row['pic'];

if(isset($_POST["btnupdate"]))
{
	$name1=$_POST["txtname"];
	$uname1=$_POST["txtuname"];
	$pwd1=$_POST["txtpwd"];
	$cno1=$_POST["txtcno"];
	$email1=$_POST["txtemail"];
	$address1=$_POST["txtaddress"];
	$dob1=$_POST["txtdob"];
	$gender1=$_POST["txtgender"];

	if(empty($uname1))
	{
	    $uname1=$row["uname"]; 
	}
	if(empty($pwd1))
	{
	  $pwd1=$row["passwd"];
	}
	if(empty($name1))
	{
	  $name1=$row["name"];
	}
	if(empty($gender1))
	{
	 $gender1=$row["gender"];
	}
	if(empty($dob1))
	{
	  $dob1=$row["dob"];
	}
	if(empty($cno1))
	{
	  $cno1=$row["contactno"];
	}
	if(empty($email1))
	{
	  $email1=$row["email"];
	}
	if(empty($address1))
	{
	  $address1=$row["address"];
	}
	if($gender1!="M" && $gender1!="F")
  	{
      $gendererr1="Gender must be either M or F";  
  	}
  	else
  	{
  		$str4="update admin set name='$name1', uname='$uname1', passwd='$pwd1', gender='$gender1', dob='$dob1', contactno='$cno1', email='$email1', address='$address1' where adminid='$aid' ";
                    
        $conn4=mysqli_connect("localhost","root","","testiology");
        $result4=$conn4->query($str4);

        echo "<script>location.href='Profile.php'</script>";
  	}
}

if(isset($_POST["btncancel"]))
{
	echo "<script>location.href='Index.php'</script>";
}
?>

<form name="form" method="POST">
<div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h3>Your Profile</h3>
                      <br>
                      <form class="forms-sample">
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Profile Picture</label>
                          <div class="col-sm-9">
                        <img src="images/user-photos/<?php echo $pic; ?>" alt="logo" height="100px" width='100px' style="margin-top: 3px;">
                          </div>
                        </div> 
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="txtuname" value="<?php echo $uname; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputPassword2" name="txtpwd" value="<?php echo $pwd; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Contactno</label>
                          <div class="col-sm-9" value="<?php echo $cno; ?>">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="txtcno" value="<?php echo $cno; ?>" onkeypress="return numbersonly();">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="exampleInputEmail2" name="txtemail" value="<?php echo $email; ?>">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Address</label>
                          <div class="col-sm-9">
                            <textarea rows=5 cols=5 class="form-control" id="exampleInputEmail2" name="txtaddress"><?php echo $address; ?></textarea>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Gender</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="txtgender" value="<?php echo $gender; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Date of Birth</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="txtdob" value="<?php echo $dob; ?>">
                          </div>
                        </div>

                        <button type="submit" class="btn btn-success mr-2" name="btnupdate">Update</button>
                        <button type="submit" class="btn btn-light" name="btncancel">Cancel</button>
                      </form>
                    </div>
                  </div>
                 </div>
             </form>

<?php
include_once("Footer.php");
?>