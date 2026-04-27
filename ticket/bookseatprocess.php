<?php
//error_reporting( ~E_NOTICE ); // avoid notice
session_start();
$adminname = $_SESSION['username'];
$terminalname = $_SESSION['terminal'];

include("../secure/connect.php");

$datecreated= $_POST['datecreated'] = date('Y-m-d H:i:s');
$datecreated2= $_POST['datecreated'] = date('Y-m-d');
$remark= $_POST['remark'] = 'created by '.' '.$adminname;


function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }

if(isset($_POST['bookseat'])){
$phone = test_input($_POST["phone"]);
$fname = test_input($_POST["fname"]);
$NOKname = test_input($_POST["NOKname"]);
$NOKphone = test_input($_POST["NOKphone"]);
$payment_method = test_input($_POST["payment_method"]);
$route_id = test_input($_POST["route_id"]);
$route = test_input($_POST["route"]);
$amount = test_input($_POST["amount"]);
$bus_no = test_input($_POST["bus_no"]);
$seat_no = test_input($_POST["seat_no"]);
$av_id = test_input($_POST["av_id"]);


$db = getDB();
$result = $db->prepare("SELECT * FROM customer WHERE phone='$phone'");
$result->execute();
$row = $result->fetch();

$result2 = $db->prepare("SELECT * FROM booking");
$result2->execute();
$row2 = $result2->rowcount();


//Code for inputing data into customers table
if($row>0){


  $cust_id = $row['cust_id'];
  $times_travelled = $row['times_travelled'];
  $new_time_travel = $times_travelled+1;
}else{
  $cust = $db->lastInsertId();
  $times_travelled=0;
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


  

  <title>NIS TRANSPORT RECEIPT</title>
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
      <input type="text" name="phone" value="<?php echo $phone; ?>">
      <input type="text" name="fname" value="<?php echo $fname; ?>">
      <input type="text" name="NOKname" value="<?php echo $NOKname; ?>">
      <input type="text" name="NOKphone" value="<?php echo $NOKphone; ?>">
      <input type="text" name="payment_method" value="<?php echo $payment_method; ?>">
      <input type="text" name="route_id" value="<?php echo $route_id; ?>">
      <input type="text" name="route" value="<?php echo $route; ?>">
      <input type="text" name="amount" value="<?php echo $amount; ?>">
      <input type="text" name="bus_no" value="<?php echo $bus_no; ?>">
      <input type="text" name="seat_no" value="<?php echo $seat_no; ?>">
      <input type="text" name="av_id" value="<?php echo $av_id; ?>">
    </div>
  <div align="center">
    <a href="index.php"><img src="../dist/img/AdminLTELogo2.png" width="100px" height="100px"></a>
    <h1>SURVEYOR'S BUS</h1>
    <p><U><strong>BOARDING TICKET</strong></U></p>
  </div>
<div align="center">
  <table>
    <tr>
      <td><b>Availability ID:</b> </td>
      <td> NIS-00-<?php echo $av_id;?></td>
      <td><b>Ticket No:</b> </td>
      <td> T00-0-<?php echo $row2+1;?></td>
    </tr>
    <tr>
      <td><b>Date:</b> </td>
      <td> <?php echo $datecreated2;?></td>
      <td><b>No of Trips:</b> </td>
      <td> <?php echo $times_travelled;?></td>
    </tr>
    <tr>
      <td><b>Name:</b> </td>
      <td colspan="3"><strong> <?php echo $fname;?></strong></td>
    </tr>
    <tr>
      <td><b>Route:</b> </td>
      <td colspan="2"> <?php echo $route;?></td>
    </tr>
    <tr>
      <td><b>Price:</b> </td>
      <td> N<?php echo $price = number_format($amount);?></td>
    </tr>
    <tr>
      <td><b>Seat No:</b> </td>
      <td> <?php echo $seat_no;?></td>
    </tr>
    <tr>
      <td><b>Vehicle No:</b> </td>
      <td> <?php echo $bus_no;?></td>
    </tr>
    <tr>
      <td colspan="4"><hr></td>
    </tr>
  </table>
  <p>Please Note: No Refund After Payment</p>
  <h3>Customer Careline: 08028821169</h3>
  <p>T&C Apply</p>
  <h1>TRAVEL SAFELY</h1>
  <p>website: www.surveyorsbus.com </p>
</div>

<div class="noprint text-center">
  <button type="submit" class="btn btn-success" name="bookseat2" value="submit" id="submit">Submit</button>
  <a href="index.php"><button type="button" class="btn btn-danger" name="bookseat2" id="submit">Cancel</button></a>
</div>
</form>
</body>
</html>


<?php
}

?>








<?php

if(isset($_POST['bookseat2'])){

$phone = test_input($_POST["phone"]);
$fname = test_input($_POST["fname"]);
$NOKname = test_input($_POST["NOKname"]);
$NOKphone = test_input($_POST["NOKphone"]);
$payment_method = test_input($_POST["payment_method"]);
$route_id = test_input($_POST["route_id"]);
$route = test_input($_POST["route"]);
$amount = test_input($_POST["amount"]);
$bus_no = test_input($_POST["bus_no"]);
$seat_no = test_input($_POST["seat_no"]);
$av_id = test_input($_POST["av_id"]);


$db = getDB();
$result = $db->prepare("SELECT * FROM customer WHERE phone='$phone'");
$result->execute();
$row = $result->fetch();
$times_travelled = $row['times_travelled']+0;

$result2 = $db->prepare("SELECT * FROM booking WHERE availability_id='$av_id' AND booking_id='$bus_no' AND cust_phone='$phone'");
$result2->execute();
$row2 = $result2->fetch();
$cust = $row2['id'];


//Code for inputing data into customers table
if($row>0){


  $cust_id = $row['cust_id'];
  $times_travelled = $row['times_travelled'];
  $new_time_travel = $times_travelled+1;

  $sty = $db->prepare("UPDATE customer SET fname='$fname', NOKname='$NOKname', NOKphone='$NOKphone', times_travelled='$new_time_travel' WHERE phone='$phone' AND cust_id='$cust_id'");  
    $sty->execute();
}else{

   $sty = $db->prepare("INSERT into customer (fname, phone, NOKname, NOKphone, times_travelled, datecreated, remark)VALUES('$fname','$phone','$NOKname','$NOKphone',1,'$datecreated','$remark')");  
    $sty->execute();

}

//code for inputing data into booking table
if($sty){

$result1 = $db->prepare("SELECT * FROM availability WHERE av_id='$av_id'");
$result1->execute();
$row1 = $result1->fetch();
$bus_model = $row1['bus_model'];
$driver_name = $row1['driver_name'];
$departuretime = $row1['departuretime'];
$availableseats = $row1['available_seats'];

$stmt = $db->prepare("INSERT into booking (availability_id, booking_id, cust_name, cust_phone, NOK_name, NOK_phone, bus_model, seat_no, route_id, route, price, payment_method, driver_name, departuretime, date_created, remark)VALUES('$av_id','$bus_no','$fname','$phone','$NOKname','$NOKphone','$bus_model', '$seat_no', '$route_id','$route','$amount', '$payment_method','$driver_name','$departuretime','$datecreated','$remark')");  
    $stmt->execute();
$new_id = $db->lastInsertId();


    if($stmt){

    $newavailable_seats = $availableseats-1;
    $newstatus = 'fully booked';
    if($newavailable_seats<1){
      $sttmt = $db->prepare("UPDATE availability SET available_seats='$newavailable_seats', status='$newstatus' WHERE av_id='$av_id' AND bus_no='$bus_no'");
      $sttmt->execute();  
    }else{

      $sttmt = $db->prepare("UPDATE availability SET available_seats='$newavailable_seats' WHERE av_id='$av_id' AND bus_no='$bus_no'");
      $sttmt->execute();
    }
    
if($sttmt){

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
  <title>NIS TRANSPORT RECEIPT</title>
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
      <input type="text" name="phone" value="<?php echo $phone; ?>">
      <input type="text" name="fname" value="<?php echo $fname; ?>">
      <input type="text" name="NOKname" value="<?php echo $NOKname; ?>">
      <input type="text" name="NOKphone" value="<?php echo $NOKphone; ?>">
      <input type="text" name="payment_method" value="<?php echo $payment_method; ?>">
      <input type="text" name="route_id" value="<?php echo $route_id; ?>">
      <input type="text" name="route" value="<?php echo $route; ?>">
      <input type="text" name="amount" value="<?php echo $amount; ?>">
      <input type="text" name="bus_no" value="<?php echo $bus_no; ?>">
      <input type="text" name="seat_no" value="<?php echo $seat_no; ?>">
      <input type="text" name="av_id" value="<?php echo $av_id; ?>">
    </div>
  <div align="center">
    <a href="index.php"><img src="../dist/img/AdminLTELogo2.png" width="100px" height="100px"></a>
    <h1>SURVEYOR'S BUS</h1>
    <p><U><strong>BOARDING TICKET</strong></U></p>
  </div>
<div align="center">
  <table>
    <tr>
      <td><b>Availability ID:</b> </td>
      <td> NIS-00-<?php echo $av_id;?></td>
      <td><b>Ticket No:</b> </td>
      <td> T00-0-<?php echo $new_id;?></td>
    </tr>
    <tr>
      <td><b>Date:</b> </td>
      <td> <?php echo $datecreated2;?></td>
      <td><b>No of Trips:</b> </td>
      <td> <?php echo $times_travelled;?></td>
    </tr>
    <tr>
      <td><b>Name:</b> </td>
      <td colspan="3"><strong> <?php echo $fname;?></strong></td>
    </tr>
    <tr>
      <td><b>Route:</b> </td>
      <td colspan="2"> <?php echo $route;?></td>
    </tr>
    <tr>
      <td><b>Price:</b> </td>
      <td> N<?php echo $price = number_format($amount);?></td>
    </tr>
    <tr>
      <td><b>Seat No:</b> </td>
      <td> <?php echo $seat_no;?></td>
    </tr>
    <tr>
      <td><b>Vehicle No:</b> </td>
      <td> <?php echo $bus_no;?></td>
    </tr>
    <tr>
      <td colspan="4"><hr></td>
    </tr>
  </table>
  <p>Please Note: No Refund After Payment</p>
  <h3>Customer Careline: 08028821169</h3>
  <p>T&C Apply</p>
  <h1>TRAVEL SAFELY</h1>
  <p>website: www.surveyorsbus.com </p>
</div>

<div class="noprint">
  <p> make sure you print before leaving this page else you won be able to print again</p>
  <a href="index.php">GO HOME</a>
  <button type="submit" name="" onclick="window.print();" value="" id="submit">Print</button>
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

if(isset($_POST['reprintticket'])){

$ticket_id = test_input($_POST["ticket_id"]);



$db = getDB();
$result = $db->prepare("SELECT * FROM booking WHERE id='$ticket_id'");
$result->execute();
$row = $result->fetch();
if($row>0){

$availability_id = $row['availability_id'];
$ticket_id  = $row['id'];
$name = $row['cust_name'];
$phone = $row['cust_phone'];
$route = $row['route'];
$price = $row['price'];
$seatno = $row['seat_no'];
$vehicleno = $row['booking_id'];

$result2 = $db->prepare("SELECT * FROM customer WHERE phone='$phone'");
$result2->execute();
$row2 = $result2->fetch();
$times_travelled  = $row2['times_travelled'];

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
  <title>NIS TRANSPORT RECEIPT</title>
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
      <input type="text" name="phone" value="<?php echo $phone; ?>">
      <input type="text" name="fname" value="<?php echo $fname; ?>">
      <input type="text" name="NOKname" value="<?php echo $NOKname; ?>">
      <input type="text" name="NOKphone" value="<?php echo $NOKphone; ?>">
      <input type="text" name="payment_method" value="<?php echo $payment_method; ?>">
      <input type="text" name="route_id" value="<?php echo $route_id; ?>">
      <input type="text" name="route" value="<?php echo $route; ?>">
      <input type="text" name="amount" value="<?php echo $amount; ?>">
      <input type="text" name="bus_no" value="<?php echo $bus_no; ?>">
      <input type="text" name="seat_no" value="<?php echo $seat_no; ?>">
      <input type="text" name="av_id" value="<?php echo $av_id; ?>">
    </div>
  <div align="center">
    <a href="index.php"><img src="../dist/img/AdminLTELogo2.png" width="100px" height="100px"></a>
    <h1>SURVEYOR'S BUS</h1>
    <p><U><strong>BOARDING TICKET(RE-PRINT)</strong></U></p>
  </div>
<div align="center">
  <table>
    <tr>
      <td><b>AVAILABILITY ID:</b> </td>
      <td> NIS-00-<?php echo $availability_id;?></td>
      <td><b>Ticket No:</b> </td>
      <td> T00-0-<?php echo $ticket_id;?></td>
    </tr>
    <tr>
      <td><b>Date:</b> </td>
      <td> <?php echo $datecreated2;?></td>
      <td><b>No of Trips:</b> </td>
      <td> <?php echo $times_travelled;?></td>
    </tr>
    <tr>
      <td><b>Name:</b> </td>
      <td colspan="3"><strong> <?php echo $name;?></strong></td>
    </tr>
    <tr>
      <td><b>Route:</b> </td>
      <td colspan="2"> <?php echo $route;?></td>
    </tr>
    <tr>
      <td><b>Price:</b> </td>
      <td> N<?php echo $prices = number_format($price);?></td>
    </tr>
    <tr>
      <td><b>Seat No:</b> </td>
      <td> <?php echo $seatno;?></td>
    </tr>
    <tr>
      <td><b>Vehicle No:</b> </td>
      <td> <?php echo $vehicleno;?></td>
    </tr>
    <tr>
      <td colspan="4"><hr></td>
    </tr>
  </table>
  <p>Please Note: No Refund After Payment</p>
  <h3>Customer Careline: 08028821169</h3>
  <p>T&C Apply</p>
  <h1>TRAVEL SAFELY</h1>
  <p>website: www.surveyorsbus.com </p>
</div>

<div class="noprint text-center">
  <p> make sure you print before leaving this page else you won be able to print again</p>
  <button type="submit" class="btn btn-success" name="" onclick="doPrint(); return false;" value="" id="submit"><i class="fas fa-print"></i> Print</button>
  <a href="index.php">GO HOME</a>
</div>
</form>
</body>
</html>
    <?php
}else{
  ?>
<script>
  Alert('Ticket ID does not exist, please check booking list for correct ID');
  window.location.href="index.php";
</script>

  <?php
}
    }

?>
