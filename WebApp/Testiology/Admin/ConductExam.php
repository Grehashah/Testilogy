<?php
include_once("header.php");
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

$uname="";
$msgerr="";
$suberr="";
$err="";
$place="";
$que="";
$subject="";
$err1="";

if(isset($_POST['btnsubmit']))
{
      $place=$_POST['txtplace'];
      $que=$_POST['txtque'];
      $subject=$_POST['cmbsub'];
      
      if(!$_POST["cmbsub"])
      {
          $suberr="Any one of them must be chosen.";
      }
      else if(empty($_POST["txtplace"]))
      {
        $err="Must be filled";
      } 
      else if(empty($_POST["txtque"]))
      {
        $msgerr="Must be filled";
      }
      else
      {

        $_SESSION['subjectid'] = $subject;  
        $_SESSION['examplace'] = $place;
        $_SESSION['examque'] = $que;
     
        echo "<script>location.href='ChooseQue.php'</script>";
	   	}
}
  
?>

        <div class="content-wrapper">
          <div class="row">
<div class="col-6 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4>Fill Details of Exam</b></h4>
                      <br>
                      <form class="forms-sample">
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
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Place</label>
                          <div class="col-sm-9">
                            <input type=text class="form-control" id="exampleInputEmail2" placeholder="Enter Place" value='<?php echo $place; ?>' name='txtplace'>
                          <font color="red"><?php echo $err; ?></font>
                        
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputPassword2" class="col-sm-3 col-form-label">No. of Questions</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="exampleInputPassword2" placeholder="Enter Total Number of Questions" name='txtque' value='<?php echo $que; ?>' onkeypress='return numsonly();'>
                              <font size='2' color="red"><?php echo $msgerr; ?></font>
             
                          </div>
                                                
                        </div>
                        <button type="submit" class="btn btn-success mr-2" name='btnsubmit'>Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

<?php
include_once("footer.php");
?>