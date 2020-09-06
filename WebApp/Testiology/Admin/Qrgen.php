<?php 
include_once("Header1.php");
$eid = $_SESSION['examid'];
include("qr/qrlib.php");

QRcode::png($eid,"new.png","H","12","12");
?>

<form name="form" method="POST">
<div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body"  align='center'>
                      <br>
                      <br>

                      <h1>Scan this QR CODE</h1>
					<img src="new.png"/>
                      <br>
                    </div>
                  </div>
                 </div>
             </form>
