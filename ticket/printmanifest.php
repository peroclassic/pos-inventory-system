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

if(isset($_POST['dispatch'])){

$av_id = test_input($_POST["av_id"]);


$db = getDB();
$result = $db->prepare("SELECT * FROM booking WHERE availability_id='$av_id'");
$result->execute();
$row = $result->fetch();

/*$result2 = $db->prepare("SELECT * FROM booking WHERE availability_id='$av_id'");
$result2->execute();
$row2 = $result2->rowcount();
*/

//Code for inputing data into customers table
if($row>0){


  $booking_id = $row['booking_id'];
  $cust_name = $row['cust_name'];
  $cust_phone = $row['cust_phone'];
  $NOK_name = $row['NOK_name'];
  $NOK_phone = $row['NOK_phone'];
  $seat_no = $row['seat_no'];
  $route = $row['route'];
  $driver_name = $row['driver_name'];
  $date_created = $row['date_created'];

$result2 = $db->prepare("SELECT * FROM availability WHERE av_id='$av_id'");
$result2->execute();
$row2 = $result2->fetch();
$travelstatus=$row2['status'];
$terminal_destination=$row2['terminal_destination'];
$terminal_origin=$row2['terminal_name'];

if($travelstatus!='Transaction Completed'){

  $st = $db->prepare("UPDATE availability SET status='Transaction Completed' WHERE av_id='$av_id' AND bus_no='$booking_id'");  
    $st->execute();

$sst = $db->prepare("UPDATE driver SET status='Available' WHERE fname='$driver_name'");  
    $sst->execute();

$bus_no = $booking_id;

$result2 = $db->prepare("SELECT terminal_name FROM bus WHERE busno='$bus_no'");
$result2->execute();
$row2 = $result2->fetch();

$from = $row2['terminal_name'];
$to = $terminal_destination;
$datecreated= $_POST['datecreated'] = date('Y-m-d H:i:s');
$remark= $_POST['remark'] = 'Auto created by '.' '.$adminname;
$busstatus=$_POST['busstatus'] = 'Dispatched';
$dispatchrequest=$_POST['dispatchrequest'] = 'Sent';
$dispatchstatus=$_POST['dispatchstatus'] = 'Pending';



     $stt = $db->prepare("INSERT into dispatch (busno,dfrom,dto,sent,received,status,datecreated,remark)VALUES('$bus_no','$from','$to',1,0,'$dispatchstatus','$datecreated','$remark')");  
    $stt->execute();

    if($stt){
      $db = getDB();
     $st = $db->prepare("UPDATE bus SET status='$busstatus', dispatch_request='$dispatchrequest' WHERE busno='$bus_no'");  
    $st->execute();
if($st){

?>
<script>
  alert('Vehicle Dispatched Successfully');
  window.print();
  window.location.href="index.php"
</script>

<?php
}


}


 }else{
  ?>

<script>
  alert('Vehicle Already Dispatched');
  window.location.href="index.php"
</script>

  <?php
 } 
}else{
  ?>
<script>
  alert('Vehicle is empty, please book atleast one passenger to proceed');
  window.location.href="index.php"
</script>
  <?php
}
}


if(isset($_POST['printmanifest'])){

$av_id = test_input($_POST["av_id"]);


$db = getDB();
$result = $db->prepare("SELECT * FROM booking WHERE availability_id='$av_id'");
$result->execute();
$row = $result->fetch();

/*$result2 = $db->prepare("SELECT * FROM booking WHERE availability_id='$av_id'");
$result2->execute();
$row2 = $result2->rowcount();
*/

//Code for inputing data into customers table
if($row>0){


  $booking_id = $row['booking_id'];
  $cust_name = $row['cust_name'];
  $cust_phone = $row['cust_phone'];
  $NOK_name = $row['NOK_name'];
  $NOK_phone = $row['NOK_phone'];
  $seat_no = $row['seat_no'];
  $route = $row['route'];
  $driver_name = $row['driver_name'];
  $date_created = $row['date_created'];

$result2 = $db->prepare("SELECT * FROM availability WHERE av_id='$av_id'");
$result2->execute();
$row2 = $result2->fetch();
$travelstatus=$row2['status'];
$terminal_destination=$row2['terminal_destination'];
$terminal_origin=$row2['terminal_name'];
/*
if($travelstatus!='Transaction Completed'){

  $st = $db->prepare("UPDATE availability SET status='Transaction Completed' WHERE av_id='$av_id' AND bus_no='$booking_id'");  
    $st->execute();

$sst = $db->prepare("UPDATE driver SET status='Available' WHERE fname='$driver_name'");  
    $sst->execute();

$bus_no = $booking_id;

$result2 = $db->prepare("SELECT terminal_name FROM bus WHERE busno='$bus_no'");
$result2->execute();
$row2 = $result2->fetch();

$from = $row2['terminal_name'];
$to = $terminal_destination;
$datecreated= $_POST['datecreated'] = date('Y-m-d H:i:s');
$remark= $_POST['remark'] = 'Auto created by '.' '.$adminname;
$busstatus=$_POST['busstatus'] = 'Dispatched';
$dispatchrequest=$_POST['dispatchrequest'] = 'Sent';
$dispatchstatus=$_POST['dispatchstatus'] = 'Pending';



     $stt = $db->prepare("INSERT into dispatch (busno,dfrom,dto,sent,received,status,datecreated,remark)VALUES('$bus_no','$from','$to',1,0,'$dispatchstatus','$datecreated','$remark')");  
    $stt->execute();

    if($stt){
      $db = getDB();
     $st = $db->prepare("UPDATE bus SET status='$busstatus', dispatch_request='$dispatchrequest' WHERE busno='$bus_no'");  
    $st->execute();
}


 } */
}else{
  ?>
<script>
  alert('Vehicle is empty, please book atleast one passenger to proceed');
  window.location.href="index.php"
</script>
  <?php
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


  <script type="text/javascript">
    
   /* $(document).ready(function(){
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
     <div align="center">
    <a href="index.php"><img src="../dist/img/AdminLTELogo2.png" width="60px" height="60px"></a>
    <h1>SURVEYOR'S BUS</h1>
    <p><U><strong>PASSENGER'S MANIFEST</strong></U></p>
  </div>
<div align="center">
  <table>
    <tr>
      <td><b>DATE:</b> </td>
      <td> <?php echo $datecreated2;?></td>
      <td>&ensp;</td>
      <td><b>VEHICLE NUMBER:</b> </td>
      <td> <?php echo $booking_id;?></td>
    </tr>
    <tr>
      <td><b>ROUTE:</b> </td>
      <td> <?php echo $route;?></td>
      <td>&ensp;</td>
      <td><b>VEHICLE CAPTAIN:</b> </td>
      <td> <?php echo $driver_name;?></td>
    </tr>
    <tr>
      <td><b>ORIGIN:</b></td>
      <td> <?php echo $terminal_origin;?></td>
      <td>&ensp;</td>
      <td><b>DESTINATION:</b></td>
      <td> <?php echo $terminal_destination;?></td>
    </tr>
      </table>
      <table border="1">
        <thead>
          <tr>
          <th>S/N</th>
          <th>PASSENGER'S NAME</th>
          <th>SEAT NO</th>
          <th>PHONE NO</th>
          <th>NEXT OF KIN NAME</th>
          <th>NEXT OF KIN PHONE NO</th>
        </tr>
        </thead>
        <tbody>
        <?php
                
                $db = getDB();
$result2 = $db->prepare("SELECT * FROM booking WHERE availability_id='$av_id'");
                
                $result2->execute();
                for($i=1; $row2 = $result2->fetch(); $i++){

            ?>
        <tr>
          <td><?php echo $row2['id'];?></td>
          <td><?php echo $row2['cust_name'];?></td>
          <td><?php echo $row2['seat_no'];?></td>
          <td><?php echo $row2['cust_phone'];?></td>
          <td><?php echo $row2['NOK_name'];?></td>
          <td><?php echo $row2['NOK_phone'];?></td>
        </tr>
        <?php
}
        ?>
      </tbody>
      </table>
  <p>DISPATCHER'S NAME AND SIGNATURE:________________________________________________</p>
  <h1>TRAVEL SAFELY</h1>
  <p>website: www.surveyorsbus.com </p>
</div>

<div class="noprint text-center">

  <button type="submit" class="btn btn-success" name="" onclick="doPrint(); return false;" value="" id="submit">Print</button>
  <form>
    <input type="text" name="av_id" value="<?php echo $av_id; ?>" hidden>
  <button type="submit" class="btn btn-info" name="dispatch" >Dispatch</button>
  </form>
  <a href="index.php">GO HOME</a>
</div>
</form>
</body>
</html>


<?php
}

?>