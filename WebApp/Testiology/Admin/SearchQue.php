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
if(isset($_POST["btnsearch"]))
{
$id=$_POST["txtsuname"];
$suname = $id;
$str="select * from subject where name like '$id%'";
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$row=$result->fetch_assoc();
$id1=$row['subjectid'];

$str="select * from question where subjectid = '$id1'";
}
else
{
$str="select * from question";	
}
$conn=mysqli_connect("localhost","root","","testiology");
$result=$conn->query($str);
$no=1;
$cnt=mysqli_num_rows($result);


$str1='<div class="row">           <div class="col-12 grid-margin">
<div class="card">
                <div class="card-body"><font size=5 style="margin-left: -12px;"><b>List of Questions</b> 
                	</font>
                <b><input style="margin-left: 695px; margin-top: -200px;" type="text" name="txtsuname" value="'.$suname.'" size="30" placeholder="Enter Subject">&nbsp;</b>
                <input class="btn btn-success" type="submit" name="btnsearch" value="Search">&nbsp;&nbsp;
              <br>';

while($row=$result->fetch_assoc())
{
$subid=$row['subjectid'];
$str0="select * from subject where subjectid='$subid'";	
$conn0=mysqli_connect("localhost","root","","testiology");
$result0=$conn0->query($str0);
$row0=$result0->fetch_assoc();

$name = $row0['name'];

                $str1.='<br> 
<h5 class="card-title mb-4" style="margin-left : -12px;"><font size=3><b>Subject : '.$name.'</font></b>'; 

                $str1.='</h5>';
                  $str1.='<div class="fluid-container">
                    <div class="row ticket-card mt-0 pb-0 border-bottom pb-0 mb-0">
                      <div class="ticket-details col-md-15">
                        <div class="d-flex">
                          <textarea rows="2" cols="87" style="border-width: 0px;">Q.'.$no.'  '.$row['questions']; 

                          $str1.='</textarea>';
                        $str1.='</div>
                          <font size="3"><textarea rows="1" cols="87" style="border-width: 0px;">Ans : '.$row['answer'];

                          $str1.='</textarea><br>';
            			$str1.='<a href="Deleteque.php?ID='.$row['qid'].'" class="btn btn-danger" style="margin-top: -160px; margin-left: 1000px;">Delete</a>';

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


echo $str1;
?>

    
     </form>

<?php 
include_once("footer.php");
?>
