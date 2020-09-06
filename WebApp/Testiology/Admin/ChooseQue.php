<?php 
include_once("header.php");
?>

                   
<form name='frm' method='post' action='memexport.php'>
<?php
$no="";
$str="";
$id1;
$id="";
$suname="";
$add="";
$remove="";

$que = $_SESSION['examque'];
$subjectid = $_SESSION['subjectid'];
$place = $_SESSION['examplace'];

$str="select * from question where subjectid = '$subjectid'";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$no=1;
$cnt=mysqli_num_rows($result);


$str1='<div class="row">           <div class="col-12 grid-margin">
<div class="card">
                <div class="card-body"><font size=5 style="margin-left: -12px;"><b>Choose Questions</b> 
                	</font>
        ';

$cnt1 = 0;
$cnt2 = 0;
$cnt3 = 0;
$cnt4 = 0;

while($row=$result->fetch_assoc())
{
$subid=$row['subjectid'];
$str0="select * from subject where subjectid='$subid'";	
$conn0=mysqli_connect("localhost","root","","testiology");
$result0=$conn0->query($str0);
$row0=$result0->fetch_assoc();

$name = $row0['name'];

                  $str1.='<br><div class="fluid-container">
                    <div class="row ticket-card mt-0 pb-0 border-bottom pb-0 mb-0">
                      <div class="ticket-details col-md-15">
                        <div class="d-flex">
                          <textarea rows="2" cols="87" style="border-width: 0px;">Q.'.$no.'  '.$row['questions']; 

                          $str1.='</textarea>';
                        $str1.='</div>';
                          
                          $str1.='<br>';
                          $str1.='<div class="form-check form-check-flat">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="'.$no.'" value="'.$row["qid"].'"> Add
                            <i class="input-helper"></i></label>
                          </div>';
            				$str1.='</font>            
            			 </div>
                  </div>
              </div>';
$no++;
}

$str1.='          </div>
      </div>
  </div>  
</div>';



// Selection
$totalques=0;
$diff=0;
$cnt=0;
if(isset($_POST['btnsubmit']))
{
  for($i=1;$i<$no;$i++)
  {
    if(isset($_POST[$i]))
    {
      $id=$_POST[$i];
      $cnt++;
    }
  }

        if($cnt==$que)
        {
			  date_default_timezone_set('Asia/Kolkata');
	  			$doc=date("Y-m-d");

                	  $str0="insert into exams values('','$doc','$subjectid','$cnt','0','$place')"; 
                      $conn0=mysqli_connect("localhost","root","","testiology");
                      $result0=$conn0->query($str0);

					$str0="select eid from exams where attendance = '0'"; 
                      $conn0=mysqli_connect("localhost","root","","testiology");
                      $result0=$conn0->query($str0);
                      $row0 = $result0->fetch_assoc();
                      $eid=$row0['eid'];

                      $_SESSION['examid'] = $eid;


            for($i=1;$i<$no;$i++)
            {
                if(isset($_POST[$i]))
                {
                      $id=$_POST[$i];
                      $str0="insert into questionpaper values('','$id','$eid')"; 
                      $conn0=mysqli_connect("localhost","root","","testiology");
                      $result0=$conn0->query($str0);
                }
            }
            echo "<script>location.href='Qrgen.php'</script>";
          } 
        elseif($cnt<$que)
        {
          echo "<script>alert('More questions must be selected')</script>";
        }
       	elseif($cnt>$que)
        {
         echo "<script>alert('Less questions must be selected')</script>";
        }
}


echo $str1;
?>

    <input type='submit' style='margin-left: 530px;' name='btnsubmit' class='btn btn-primary' value="Submit Questions">
     </form> 

<?php 
include_once("footer.php");
?>
