<?php
include_once "header.php";
?>

<script type="text/javascript">
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
$ques="";
$op1="";
$op2="";
$op3="";
$op4="";
$subid="";
$ans="";
$time="";
$sub="";

$queserr="";
$op1err="";
$op2err="";
$op3err="";
$op4err="";
$suberr="";
$anserr="";
$timeerr="";

if(isset($_POST["btninsert"]))
{
	$ques=$_POST["txtque"];
	$op1=$_POST["txtop1"];
	$op2=$_POST["txtop2"];
	$op3=$_POST["txtop3"];
	$op4=$_POST["txtop4"];
	$subid=$_POST["cmbsub"];
	$ans=$_POST["txtans"];
	$time=$_POST["txttime"];

  if(!$_POST["cmbsub"])
  {
      $suberr="Any one of them must be chosen.";
  }
else if(empty($_POST["txtque"]))
  {
      $queserr="Must be filled.";
  }
  else if(empty($_POST["txtop1"]))
  {
      $op1err="Must be filled.";
  } 
  else if(empty($_POST["txtop2"]))
  {
      $op2err="Must be filled.";
  }
  else if(empty($_POST["txtop3"]))
  {
    $op3err="Must be filled.";
  }
  else if(empty($_POST["txtop4"]))
  {
      $op4err="Must be filled.";
  }
  else if(empty($_POST["txttime"]))
  {
      $timeerr="Must be filled.";
  }
  else
  {
  		$str="select * from question where questions='$ques'";
        $conn=mysqli_connect("localhost","root","","testiology");
        $result=$conn->query($str);
        $cnt=mysqli_num_rows($result);

        if($cnt==0)
        {
            $str="insert into question values('','$subid','$ques','$op1','$op2','$op3','$op4','$ans')";
            $conn=mysqli_connect("localhost","root","","testiology");
            $result=$conn->query($str);
            echo("<script>location.href='Questions.php'</script>");
        }
        else
        {
        	echo "<script> alert('This question is already added.'); </script>";
        }
  }
}

?>
<div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 ><font size="3">Add a new Question</font></h4>
                      <form class="forms-sample" method="POST">

                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Subject</label>
                          <div class="col-sm-9">
                            <select name="cmbsub">
                          <option value='0'>Select Subject</option>
                          <?php
    							$str="select * from subject";
    							$conn=mysqli_connect("localhost","root","","testiology");
    							$result=$conn->query($str);

                            while($row=$result->fetch_assoc())
                            {
                              echo "<option value=".$row["subjectid"].">".$row["name"]."</option>";
                            } 
                          ?>
                          </select>

                          <font color="red"><?php echo $suberr; ?></font>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Question</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="txtque" value="<?php echo $ques; ?>" onkeypress="return charactersonly();">

                          <font color='red'><?php echo $queserr; ?></font>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Option 1</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="txtop1" value="<?php echo $op1; ?>">
                             <font color='red'><?php echo $op1err; ?></font>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Option 2</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="txtop2" value="<?php echo $op2; ?>">
                             <font color='red'><?php echo $op2err; ?></font>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Option 3</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="txtop3" value="<?php echo $op3; ?>">
                             <font color='red'><?php echo $op3err; ?></font>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Option 4</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="txtop4" value="<?php echo $op4; ?>">
                             <font color='red'><?php echo $op4err; ?></font>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Answer</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputEmail2" name="txtans" value="<?php echo $ans; ?>">
                             <font color='red'><?php echo $anserr; ?></font>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-success mr-2" name="btninsert">Add</button>
                        <button type="submit" class="btn btn-light" name="btncancel">Cancel</button>
                      </form>
                    </div>
                  </div>
                 </div>
  

<?php
include_once "footer.php";
?>
