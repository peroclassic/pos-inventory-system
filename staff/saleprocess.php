<?php
//error_reporting( ~E_NOTICE ); // avoid notice
session_start();
$adminname = $_SESSION['username'];


include("../secure/connect.php");

$datecreated= $_POST['datecreated'] = date('Y-m-d H:i:s');
$datecreated2= $_POST['datecreated'] = date('Y/m/d');
$datecreated3= $_POST['datecreated'] = date('H:i');
$remark= $_POST['remark'] = 'registered by '.' '.$adminname;


function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }

if(isset($_POST['confirmPurchase'])){
$summedcost = test_input($_POST["summedcost"]);
$discount = test_input($_POST["discount"]);
$totalcosting = test_input($_POST["totalcosting"]);
$paymentmethod = test_input($_POST["paymentmethod"]);
$cphone = test_input($_POST["cphone"]);
$cname = test_input($_POST["cname"]);
$caddress = test_input($_POST["caddress"]);
$cemail = test_input($_POST["cemail"]);
$transcode = test_input($_POST["transcode"]);
$staff = $_POST['staff'] = $adminname;


$db = getDB();
$result = $db->prepare("SELECT * FROM customer WHERE cphone='$cphone'");
$result->execute();
$row = $result->fetch();

$result2 = $db->prepare("SELECT * FROM sale WHERE transcode='$transcode'");
$result2->execute();
$row2 = $result2->rowcount();


//Code for inputing data into customers table
if($row>0){


  $cid = $row['cid'];
  $purchaseno = $row['purchaseno'];
  $newpurchaseno = $purchaseno+1;
}else{
  $cust = $db->lastInsertId();
  $purchaseno=0;
}


?>
<!DOCTYPE html>
<html>
<head>


<!-- Alien -->
<script language="JavaScript" type="text/javascript" src="alien/suggest.js"></script>
<script language="JavaScript" type="text/javascript" src="alien/productsearch.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">

  <script src="alien/jquery-2.1.1.min.js" type="text/javascript"></script>


  

  <title>Demo Retail System RECEIPT</title>
</head>
<style type="text/css">
  @media print{
    .noprint{
      visibility: hidden;
    }
  }
</style>
<body>

  <form method="POST" action="">
    <div style="display: none;">
      <input type="text" name="summedcost" value="<?php echo $summedcost; ?>">
      <input type="text" name="discount" value="<?php echo $discount; ?>">
      <input type="text" name="totalcosting" value="<?php echo $totalcosting; ?>">
      <input type="text" name="paymentmethod" value="<?php echo $paymentmethod; ?>">
      <input type="text" name="cphone" value="<?php echo $cphone; ?>">
      <input type="text" name="cname" value="<?php echo $cname; ?>">
      <input type="text" name="caddress" value="<?php echo $caddress; ?>">
      <input type="text" name="cemail" value="<?php echo $cemail; ?>">
      <input type="text" name="transcode" value="<?php echo $transcode; ?>">
      <input type="text" name="staff" value="<?php echo $staff; ?>">
    </div>
  <div align="center">
    <a href="index.php"><img src="../dist/img/logo.jpg" width="100px" height="100px"></a>
    <h1>Demo Retail System</h1>
    <p><U><strong>Official Receipt</strong></U></p>
  </div>
<div align="center">
  <table>
    <tr>
      <td colspan="5"><b>Receipt No:</b> <?php echo $transcode;?></td>
      <td></td>
    </tr>
    <tr>
      <td><b>Date:</b> </td>
      <td> <?php echo $datecreated2;?></td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <th colspan="2"> Time: </th>
      <td colspan=""> <?php echo $datecreated3;?></td>
    </tr>
    <tr>
      <td><b>Staff:</b> </td>
      <td colspan=""> <?php echo $staff;?></td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <th colspan="2"> Position: </th>
      <td colspan=""> Sales</td>
    </tr>
    <tr>
      <td><b>Email:</b> </td>
      <td> <?php echo $cemail;?></td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <th colspan="2"> Address: </th>
      <td> <?php echo $caddress;?></td>
        
    </tr>
    <tr>
      <td colspan="5"><hr></td>
    </tr>
  </table>
  <table width="60%" border="1">
    <thead>
      <tr>
      <th><div align="center">Product</div></th>
      <th><div align="center">Quantity</div></th>
      <th><div align="center">Retail Price</div></th>
      <th><div align="center">Amount</div></th>
    </tr>
    </thead>
    <tbody>
      <?php
$result = $db->prepare("SELECT * FROM sale Where status = 'PENDING' AND staff='$staff' ORDER BY saleid ASC");
                
                $result->execute();
                for($i=1; $row = $result->fetch(); $i++){
                  ?>
      <tr>
      <td>&nbsp;&nbsp;&nbsp;<?php echo $row['pname']; ?></td>
      <td><div align="center"><?php echo $row['qty']; ?>&nbsp;&nbsp;&nbsp;</div></td>
      <td><div align="right"><?php echo number_format($row['saleprice']); ?>&nbsp;&nbsp;&nbsp;</div></td>
      <td><div align="right"><?php echo number_format($row['totalcost']); ?>&nbsp;&nbsp;&nbsp;</div></td>
    </tr>
    <?php } ?>
    <tr>
       <th colspan="4"><div align="right">&nbsp;</div></th>
    </tr>

    <tr>
      
      <th colspan="3"><div align="right">Total Retail:&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo number_format($summedcost);?>&nbsp;&nbsp;&nbsp;</div></td>
    </tr>
    <tr>
      
      <th colspan="3"><div align="right">Discount:&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo number_format($discount);?>&nbsp;&nbsp;&nbsp;</div></td>
    </tr>
    <tr>
      <th colspan="3"><div align="right">Total Payable:&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo number_format($totalcosting);?>&nbsp;&nbsp;&nbsp;</div></td>
    </tr>
    <tr>
      <th colspan="3"><div align="right">Mode of Payment:&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo $paymentmethod;?>&nbsp;&nbsp;&nbsp;</div></td>
    </tr>
</tbody>
  </table>
  <p>Please Note: No Refund After Payment</p>
  <h5>Customer Careline: 09012210005</h5>
  <h5>Thanks for your patronage</h5>
</div>

<div class="noprint text-center">
  <button type="submit" class="btn btn-success" name="confirmPurchase2" value="submit" id="submit">Submit</button>
  <a href="sell.php"><button type="button" class="btn btn-danger" name="confirmPurchase2" id="submit">Cancel</button></a>
</div>
</form>
</body>
</html>


<?php
}

?>








<?php

if(isset($_POST['confirmPurchase2'])){

$summedcost = test_input($_POST["summedcost"]);
$discount = test_input($_POST["discount"]);
$totalcosting = test_input($_POST["totalcosting"]);
$paymentmethod = test_input($_POST["paymentmethod"]);
$cphone = test_input($_POST["cphone"]);
$cname = test_input($_POST["cname"]);
$caddress = test_input($_POST["caddress"]);
$cemail = test_input($_POST["cemail"]);
$transcode = test_input($_POST["transcode"]);
$staff = test_input($_POST['staff'] = $adminname);


$db = getDB();
$result = $db->prepare("SELECT * FROM customer WHERE cphone='$cphone'");
$result->execute();
$row = $result->fetch();
$purchaseno = $row['purchaseno']=0;

$result2 = $db->prepare("SELECT * FROM sale WHERE status='PENDING' AND staff='$staff'");
$result2->execute();
$row2 = $result2->fetch();
//$cust = $row2['id'];


//Code for inputing data into customers table
if($row>0){


  $cid = $row['cid'];
  $purchaseno = $row['purchaseno'];
  $newpurchaseno = $purchaseno+1;

  $sty = $db->prepare("UPDATE customer SET purchaseno='$newpurchaseno' WHERE cphone='$cphone' AND cid='$cid'");  
    $sty->execute();
}else{

   $sty = $db->prepare("INSERT into customer (cname, cphone, caddress, cemail, purchaseno, datecreated, regby)VALUES('$cname','$cphone','$caddress','$cemail',1,'$datecreated','$remark')");  
    $sty->execute();

}

//code for inputing data into booking table
if($sty){

$stmt = $db->prepare("INSERT into salesummary (sumdate, transcode, summedcost, discount, totalcost, paymentmode, cname, cphone, staff)VALUES('$datecreated','$transcode','$summedcost','$discount','$totalcosting','$paymentmethod','$cname', '$cphone', '$staff')");  
    $stmt->execute();
$new_id = $db->lastInsertId();


    if($stmt){

      $sttmt = $db->prepare("UPDATE sale SET cphone='$cphone', status='COMPLETED', transcode='$transcode' WHERE status='PENDING' AND staff='$staff'");
      $sttmt->execute();  
    
    
    
if($sttmt){

?>
 <!DOCTYPE html>
<html>
<head>

<!-- Alien -->
<script language="JavaScript" type="text/javascript" src="alien/suggest.js"></script>
<script language="JavaScript" type="text/javascript" src="alien/productsearch.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallbackz">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.cssz">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.cssz">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.cssz">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.cssz">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.cssz">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.cssz">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.cssz">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.cssz">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.cssz">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.cssz">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.cssz">

  <script src="alien/jquery-2.1.1.min.js" type="text/javascript"></script>


  <script type="text/javascript">
    
    $(document).ready(function(){
      window.print();
      setTimeout("closePrintView()", 3000);
    });

    function closePrintView(){
      document.location.href='index.php';
    }

    function doPrint(){
      window.print();
      document.location.href="index.php";
    }
  </script>
  <title>Demo Retail System RECEIPT</title>
</head>
<style type="text/css">
  @media print{
    .noprint{
      visibility: hidden;
    }
  }


* {
    font-size: 13px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 0px solid black;
    border-collapse: collapse;
}

td.description,
th.description {
    width: 85px;
    max-width: 85px;
}

td.quantity,
th.quantity {
    width: 25px;
    max-width: 25px;
    word-break: break-all;
}

td.price,
th.price {
    width: 50px;
    max-width: 50px;
    word-break: break-all;
}

td.amt,
th.amt {
    width: 50px;
    max-width: 50px;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 210px;
    max-width: 210px;
    display: block;
    margin: 0 auto; 
}

img {
    max-width: inherit;
    width: inherit;
    display: block;
    margin: 0 auto; 
}

.button {
  transition-duration: 0.4s;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  background-color: white;
  color: black;
  border: 2px solid #f44336; /* Green */
 
}

.button:hover {
  background-color: #f44336; /* Red */
  color: white;
  border: 2px solid #008CBA; /* Green */

}


@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}


</style>
<body>
  <form method="POST" action="">
    <div style="display: none;">
      <input type="text" name="summedcost" value="<?php echo $summedcost; ?>">
      <input type="text" name="discount" value="<?php echo $discount; ?>">
      <input type="text" name="totalcosting" value="<?php echo $totalcosting; ?>">
      <input type="text" name="paymentmethod" value="<?php echo $paymentmethod; ?>">
      <input type="text" name="cphone" value="<?php echo $cphone; ?>">
      <input type="text" name="cname" value="<?php echo $cname; ?>">
      <input type="text" name="caddress" value="<?php echo $caddress; ?>">
      <input type="text" name="cemail" value="<?php echo $cemail; ?>">
      <input type="text" name="transcode" value="<?php echo $transcode; ?>">
      <input type="text" name="staff" value="<?php echo $staff; ?>">
    </div>
  
<div class="ticket">

  <a href="index.php"><img src="../dist/img/logo2.jpg" align="centered"></a>
    <p class="centered"><strong>Demo Retail System</strong><br> 
    Opp Enogie Palace, Ogheghe Off Sapele Road, B/C<br>
    <strong>09012210005</strong><br>
    <U>OFFICIAL RECEIPT(Re-Print)</U><br> 
    <b>Receipt No:</b> <?php echo $transcode;?>
    </p>

<div align="center">
  <table width="100%">
    <tr>
      <td><b>Date:</b> </td>
      <td> <?php echo $datecreated2;?></td>
       <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <th colspan="2"> Time: </th>
      <td colspan=""> <?php echo $datecreated3;?></td>
    </tr>
    <tr>
      <td><b>Staff:</b> </td>
      <td> <?php echo $staff;?></td>
    </tr>
    <tr>  
    <td><b>Position:</b> </th>
      <td> Sales</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0">
    <thead>
 <tr>
      <th class="description"><div align="center">Product</div></th>
      <th class="quantity"><div align="center">Qty</div></th>
      <th class="price"><div align="center">Price</div></th>
      <th class="amt"><div align="center">Total</div></th>
    </tr>
    </thead>
    <tbody>
      <?php
$result = $db->prepare("SELECT * FROM sale Where transcode='$transcode' AND staff='$staff' ORDER BY saleid ASC");
                
                $result->execute();
                for($i=1; $row = $result->fetch(); $i++){
                  ?>
      <tr>
      <td class="description">&nbsp;<?php echo $row['pname']; ?></td>
      <td class="quantity"><div align="center"><?php echo $row['qty']; ?>&nbsp;</div></td>
      <td class="price"><div align="right"><?php echo number_format($row['saleprice']); ?>&nbsp;</div></td>
      <td class="amt"><div align="right"><?php echo number_format($row['totalcost']); ?>&nbsp;&nbsp;</div></td>
    </tr>
    <?php } ?>
    <tr>
       <th colspan="4"><div align="right">&nbsp;</div></th>
    </tr>
<hr>
    <tr>
      
      <th colspan="3"><div align="right">Total Retail:&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo number_format($summedcost);?>&nbsp;&nbsp;</div></td>
    </tr>
    <tr>
      
      <th colspan="3"><div align="right">Discount:&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo number_format($discount);?>&nbsp;&nbsp;</div></td>
    </tr>
    <tr>
      <th colspan="3"><div align="right">Total Paid: &#8358;&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo number_format($totalcosting);?>&nbsp;&nbsp;</div></td>
    </tr>
    <tr>
      <th colspan="3"><div align="right">Mode of Payment:&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo $paymentmethod;?>&nbsp;&nbsp;&nbsp;</div></td>
    </tr>
</tbody>
  </table>
<p><strong>Note:</strong> No Refund After Payment <br>
  Thanks for your patronage<br>&nbsp;<br>&nbsp;</p>
  <hr>
</div>
</div>
<div class="noprint centred">
  <p> make sure you print before leaving this page else you will not be able to print again</p>
  <a href="index.php">GO HOME</a>
  <button type="submit" name="" onclick="window.print();" value="" id="submit" class="button">Print</button>
</div>
</form>
</body>
</html>
    <?php
}
    }



}else
    {
      echo $errorMsgReg="<span style=\"color:red;\">Error on input, contact administrator.</span>";
    }

}
?>








<?php

if(isset($_POST['reprintreceipt'])){

$transcode = test_input($_POST["transcode"]);



$db = getDB();
$result = $db->prepare("SELECT * FROM salesummary WHERE transcode='$transcode'");
$result->execute();
$row = $result->fetch();
if($row>0){

$datecreated = $row['sumdate'];
$transcode  = $row['transcode'];
$summedcost = $row['summedcost'];
$discount = $row['discount'];
$totalcosting = $row['totalcost'];
$paymentmethod = $row['paymentmode'];
$cname = $row['cname'];
$cphone = $row['cphone'];
$staff = $row['staff'];

$result2 = $db->prepare("SELECT * FROM customer WHERE cphone='$cphone'");
$result2->execute();
$row2 = $result2->fetch();
$purchaseno  = $row2['purchaseno'];
$caddress = $row2['caddress'];
$cemail = $row2['cemail'];


?>
 <!DOCTYPE html>
<html>
<head>

  <!-- Alien -->
<script language="JavaScript" type="text/javascript" src="alien/suggest.js"></script>
<script language="JavaScript" type="text/javascript" src="alien/productsearch.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallbackz">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.cssz">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.cssz">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.cssz">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.cssz">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.cssz">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.cssz">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.cssz">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.cssz">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.cssz">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.cssz">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.cssz">

  <script src="alien/jquery-2.1.1.min.js" type="text/javascript"></script>


  <script type="text/javascript">
    /*
    $(document).ready(function(){
      window.print();
      setTimeout("closePrintView()", 3000);
    });

    function closePrintView(){
      document.location.href='index.php';
    }
*/
    function doPrint(){
      window.print();
      document.location.href="index.php";
    }
  </script>
  <title>Demo Retail System RECEIPT</title>
</head>
<style type="text/css">
  @media print{
    .noprint{
      visibility: hidden;
    }
  }

  * {
    font-size: 13px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 0px solid black;
    border-collapse: collapse;
}

td.description,
th.description {
    width: 85px;
    max-width: 85px;
}

td.quantity,
th.quantity {
    width: 25px;
    max-width: 25px;
    word-break: break-all;
}

td.price,
th.price {
    width: 50px;
    max-width: 50px;
    word-break: break-all;
}

td.amt,
th.amt {
    width: 50px;
    max-width: 50px;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 210px;
    max-width: 210px;
    display: block;
    margin: 0 auto; 
}

img {
    max-width: inherit;
    width: inherit;
    display: block;
    margin: 0 auto; 
}

.button {
  transition-duration: 0.4s;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  background-color: white;
  color: black;
  border: 2px solid #f44336; /* Green */
 
}

.button:hover {
  background-color: #f44336; /* Red */
  color: white;
  border: 2px solid #008CBA; /* Green */

}


@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
</style>
<body>
  <form method="POST" action="">
    <div style="display: none;">
      <input type="text" name="summedcost" value="<?php echo $summedcost; ?>">
      <input type="text" name="discount" value="<?php echo $discount; ?>">
      <input type="text" name="totalcosting" value="<?php echo $totalcosting; ?>">
      <input type="text" name="paymentmethod" value="<?php echo $paymentmethod; ?>">
      <input type="text" name="cphone" value="<?php echo $cphone; ?>">
      <input type="text" name="cname" value="<?php echo $cname; ?>">
      <input type="text" name="caddress" value="<?php echo $caddress; ?>">
      <input type="text" name="cemail" value="<?php echo $cemail; ?>">
      <input type="text" name="transcode" value="<?php echo $transcode; ?>">
      <input type="text" name="staff" value="<?php echo $staff; ?>">
    </div>
    <div class="ticket">
  <!--<div align="center">-->
    <a href="index.php"><img src="../dist/img/logo2.jpg" align="centered"></a>
    <p class="centered"><strong>Demo Retail System</strong><br> 
    Opp Enogie Palace, Ogheghe Off Sapele Road, B/C<br>
    <strong>09012210005</strong><br>
    <U>OFFICIAL RECEIPT(Re-Print)</U><br> 
    <b>Receipt No:</b> <?php echo $transcode;?>
    </p>
  <!--</div>-->
<div align="center">
  <table width="100%">
    <tr>
      <td><b>Date:</b> </td>
      <td> <?php echo $datecreated2;?></td>
       <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <th colspan="2"> Time: </th>
      <td colspan=""> <?php echo $datecreated3;?></td>
    </tr>
    <tr>
      <td><b>Staff:</b> </td>
      <td> <?php echo $staff;?></td>
    </tr>
    <tr>  
    <td><b>Position:</b> </th>
      <td> Sales</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0">
    <thead>
      <tr>
      <th class="description"><div align="center">Product</div></th>
      <th class="quantity"><div align="center">Qty</div></th>
      <th class="price"><div align="center">Price</div></th>
      <th class="amt"><div align="center">Total</div></th>
    </tr>
    </thead>
    <tbody>
      <?php
$result = $db->prepare("SELECT * FROM sale Where transcode='$transcode' AND staff='$staff' ORDER BY saleid ASC");
                
                $result->execute();
                for($i=1; $row = $result->fetch(); $i++){
                  ?>
      <tr>
      <td class="description">&nbsp;<?php echo $row['pname']; ?></td>
      <td class="quantity"><div align="center"><?php echo $row['qty']; ?>&nbsp;</div></td>
      <td class="price"><div align="right"><?php echo number_format($row['saleprice']); ?>&nbsp;</div></td>
      <td class="amt"><div align="right"><?php echo number_format($row['totalcost']); ?>&nbsp;&nbsp;</div></td>
    </tr>
    <?php } ?>
    <tr>
       <th colspan="4" border="1"><div align="right">&nbsp;</div></th>
    </tr>
<hr>
    <tr>
      
      <th colspan="3"><div align="right">Total Retail:&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo number_format($summedcost);?>&nbsp;&nbsp;</div></td>
    </tr>
    <tr>
      
      <th colspan="3"><div align="right">Discount:&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo number_format($discount);?>&nbsp;&nbsp;</div></td>
    </tr>
    <tr>
      <th colspan="3"><div align="right">Total Paid: &#8358;&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo number_format($totalcosting);?>&nbsp;&nbsp;</div></td>
    </tr>
    <tr>
      <th colspan="3"><div align="right">Mode of Payment:&nbsp;&nbsp;&nbsp;</div></th>
      <td><div align="right"><?php echo $paymentmethod;?>&nbsp;&nbsp;&nbsp;</div></td>
    </tr>
</tbody>
  </table>
  <p><strong>Note:</strong> No Refund After Payment <br>
  Thanks for your patronage<br>&nbsp;<br>&nbsp;</p>
  <hr>
</div>
</div>
<div class="noprint centered">
  <p> make sure you print before leaving this page else you will not be able to print again</p>
  <button type="submit" name="" onclick="doPrint(); return false;" value="" id="submit" class="button"><i class="fas fa-print"></i> Print</button>
  <a href="index.php">GO HOME</a>
</div>
</form>
</body>
</html>
    <?php
}else{
  ?>
<script>
  Alert('Receipt Number does not exist, please check summary list for correct Receipt number');
  window.location.href="index.php";
</script>

  <?php
}
    }

?>
