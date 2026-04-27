<?php 
//error_reporting( ~E_NOTICE ); // avoid notice
session_start();
$adminname = $_SESSION['username'];
$terminalname = $_SESSION['terminal'];


// Test the session to see if is_auth flag was set (meaning they logged in successfully)

// If test fails, send the user to login.php and prevent rest of page being shown.
if($_SESSION['ban'] == 1){ 

        ?>
                          <script>
        alert('Your Account has been Suspended, for complains or plea to unsuspend your account, contact your Terminal Manager');
        window.location.href='../index.php';
        </script>

<?php
}

if($_SESSION['permission'] < 1){ 

        ?>
                          <script>
        alert('Restricted Area');
        window.location.href='../index.php';
        </script>

<?php
}

if (!isset($_SESSION["is_auth"])) {

    header("location: ../index.php");

    exit;

}

else if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == "true") {

    // At any time we can logout by sending a "logout" value which will unset the "is_auth" flag.

    // We can also destroy the session if so desired.

    unset($_SESSION['is_auth']);

    session_destroy();

 

    // After logout, send them back to login.php

    header("location: ../index.php");

    exit;

}



include("../secure/connect.php");
require_once('../secure/library.php');
$rand = get_rand_id(8);
$rand;
include('../secure/user_class.php');
$userClass = new userClass();

$errorMsgReg=''; $busnoErr = ''; $routeErr= '';
$departuredateErr = ""; $departuretimeErr = ""; $drivernameErr = "";

$busno = $route = $departuredate = $departuretime = $drivername = "";

function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }



if(isset($_POST['dispatch'])){

$bus_no = $_POST['bus_no'];

$db = getDB();
$result = $db->prepare("SELECT terminal_name FROM bus WHERE busno='$bus_no'");
$result->execute();
$row = $result->fetch();




$from = $row['terminal_name'];
$to = $_POST['terminal'];
$datecreated= $_POST['datecreated'] = date('Y-m-d H:i:s');
$remark= $_POST['remark'] = 'created by '.' '.$adminname;
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
        alert('Bus Successfully Dispatched, Call receiving terminal to confirm request. Click OK to continue...');
        window.location.href='index.php';
        </script>
    <?php
  }
    }else
    {
      echo $errorMsgReg="<span style=\"color:red;\">Error on input, contact administrator.</span>";
    }
}






if(isset($_POST['assignterminalmanager'])){


$terminal = $_POST['terminal'];
$manager = $_POST['manager'];
$dateupdated= $_POST['dateupdated'] = date('Y-m-d H:i:s');
$remark= $_POST['remark'] = 'updated by '.' '.$adminname;
$permission=$_POST['permission'] = 2;
$position=$_POST['position'] = 'Terminal Admin';


$db = getDB();
     $stt = $db->prepare("UPDATE admin SET terminal='$terminal', permission='$permission', position='$position' WHERE fullname='$manager'");  
    $stt->execute();

    if($stt){
      $db = getDB();
     $st = $db->prepare("UPDATE terminal SET tmanager='$manager', dateupdated='$dateupdated', updatedby='$remark' WHERE tname='$terminal'");  
    $st->execute();

    if($st){
?>
      <script>
        alert('New Manager Successfully Assigned, Click OK to continue...');
        window.location.href='index.php';
        </script>
    <?php
  }
    }else
    {
      echo $errorMsgReg="<span style=\"color:red;\">Error on input, contact administrator.</span>";
    }
}

if (isset($_POST['assignbus'])) {
  # code...


 if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["bus_no"])) {
               echo $busnoErr = "<span style=\"color:red;\">Vehicle Number is required</span>";
            }else {
               $busno = test_input($_POST["bus_no"]);
            }
 }

$bus_model = $_POST['bus_model'];
$totalseats = $_POST['totalseats'];
 
 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["route"])) {
             echo $routeErr = "<span style=\"color:red;\">Route cannot be Empty</span>";
            }else {
               $route = test_input($_POST["route"]);
            }
  }


$route_id = $_POST['route_id'];
$amount = $_POST['amount'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["departuredate"])) {
               echo $departuredateErr = "<span style=\"color:red;\">Date of Departure input is required</span>";
            }else {
               $departuredate = test_input($_POST["departuredate"]);
            }
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["departuretime"])) {
               echo $departuretimeErr = "<span style=\"color:red;\">Time of Departure is required</span>";
            }else {
               $departuretime = test_input($_POST["departuretime"]);
            }
  }


 if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["drivername"])) {
               echo $drivernameErr = "<span style=\"color:red;\">Driver name is required</span>";
            }else {
               $drivername = test_input($_POST["drivername"]);
            }
  }

$terminal = $_POST['terminal'];
$status = $_POST['status'] = 'Available';
$datecreated= $_POST['datecreated'] = date('Y-m-d H:i:s');
$remark= $_POST['remark'] = 'created by '.' '.$adminname;
$driver_id = $_POST['driver_id'];
$busstatus = $_POST['busstatus'] = 'Booked';

  # code...

    $asb=$userClass->assignBus($busno, $bus_model, $totalseats, $route, $route_id, $amount, $departuredate, $departuretime, $drivername, $terminal, $status, $datecreated, $remark, $driver_id, $busstatus);
    if($asb)
    {

    # code...

    $db = getDB();
     $stt = $db->prepare("UPDATE bus SET driver='$drivername', driver_id='$driver_id', status='$busstatus'  WHERE busno='$busno'");  
    $stt->execute();
          
    if($stt){ 
        $st = $db->prepare("UPDATE driver SET status='$busstatus' WHERE d_id='$driver_id' AND fname='$drivername'");  
        $st->execute();
                   
if($st){

      ?>
      <script>
        alert('Bus Successfully Assigned, Click OK to continue...');
        window.location.href='index.php';
        </script>
    <?php
    }
    }
    }
    else
    {
      echo $errorMsgReg="<span style=\"color:red;\">Error on input, contact administrator.</span>";
    }

   } 


 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NIS Transport | Dashboard</title>

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

<style>

.frmSearch {border: 0px solid #dc3545;background-color: #dc3545;margin: 0px 0px;padding:3px;border-radius:0px;}

#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:220px;position: left;}
#country-list li{padding: 10px; background: #dc3545; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#1d93a6;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
<style>
  input[type="button"]{
    border-radius: 0px;
    background-color: #17a2b8;
    border: 2px solid #fff;
    width: 100%;
    height: 100%;
  }

  input[type="button"]:hover{
    background-color: #fd7e14;
    width: 100%;
    height: 100%;
  }

  input[type="button"]:active{
    background-color: #fd7e14;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }

    input[type="button"]:focus{
    background-color: #fd7e14;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }

  input[type="button"]:not(input[type="button"]):focus{
    background-color: #fff;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }  


  .btnbooked{
    background-color: #28a745;
    box-shadow: 0 5px #fff;
    transform: translateY(4px);
    cursor: not-allowed;
    pointer-events: none;
  }

  .btnbooked:hover{
    background-color: #28a745;
    box-shadow: 0 5px #fff;
    transform: translateY(4px);
    cursor: not-allowed;
    pointer-events: none;
  }

  #disabled{
    opacity: 0.6;
    cursor: not-allowed;
  }
</style>
<script>


//fuction to return the xml http object
function getXMLHTTP() { 
    var xmlhttp=false;  
    try{
      xmlhttp=new XMLHttpRequest();
    }
    catch(e)  {   
      try{      
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e){
        try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e1){
          xmlhttp=false;
        }
      }
    }
      
    return xmlhttp;
  }
  
  
  
function getCurrencyCode(strURL)
{   
  var req = getXMLHTTP();   
  if (req) 
  {
    //function to be called when state is changed
    req.onreadystatechange = function()
    {
      //when state is completed i.e 4
      if (req.readyState == 4) 
      {     
        // only if http status is "OK"
        if (req.status == 200)
        { 

        var responseArray = req.responseText.split("||");          
          document.getElementById('cur_code').value=responseArray[0];
          document.getElementById('cur_code2').value=responseArray[1];
          document.getElementById('cur_code3').value=responseArray[2];
          document.getElementById('cur_code4').value=responseArray[3];
                     
        } 
        else 
        {
          alert("There was a problem while using XMLHTTP:\n" + req.statusText);
        }
      }       
     }      
     req.open("GET", strURL, true);
     req.send(null);
  }     
}


function getRoute(strURL)
{   
  var req1 = getXMLHTTP();   
  if (req1) 
  {
    //function to be called when state is changed
    req1.onreadystatechange = function()
    {
      //when state is completed i.e 4
      if (req1.readyState == 4) 
      {     
        // only if http status is "OK"
        if (req1.status == 200)
        { 

        var responseArray = req1.responseText.split("||");          
          document.getElementById('route_id').value=responseArray[0];
          document.getElementById('route_amount').value=responseArray[1];
          
                     
        } 
        else 
        {
          alert("There was a problem while using XMLHTTP:\n" + req1.statusText);
        }
      }       
     }      
     req1.open("GET", strURL, true);
     req1.send(null);
  }     
}



function getRoutes(strURL)
{   
  var req6 = getXMLHTTP();   
  if (req6) 
  {
    //function to be called when state is changed
    req6.onreadystatechange = function()
    {
      //when state is completed i.e 4
      if (req6.readyState == 4) 
      {     
        // only if http status is "OK"
        if (req6.status == 200)
        { 

        var responseArray = req6.responseText.split("||");          
          document.getElementById('routes_id').value=responseArray[0];
          document.getElementById('routes_amount').value=responseArray[1];
          
                     
        } 
        else 
        {
          alert("There was a problem while using XMLHTTP:\n" + req6.statusText);
        }
      }       
     }      
     req6.open("GET", strURL, true);
     req6.send(null);
  }     
}

function getSeatno(strURL)
{   
  var req5 = getXMLHTTP();   
  if (req5) 
  {
    //function to be called when state is changed
    req1.onreadystatechange = function()
    {
      //when state is completed i.e 4
      if (req5.readyState == 4) 
      {     
        // only if http status is "OK"
        if (req5.status == 200)
        { 

         var responseArray = req5.responseText.split("||");          
          document.getElementById('seated').value=responseArray[0];
          document.getElementById('routed').value=responseArray[1];
         
          
                     
        } 
        else 
        {
          alert("There was a problem while using XMLHTTP:\n" + req5.statusText);
        }
      }       
     }      
     req5.open("GET", strURL, true);
     req5.send(null);
  }     
}



function getDriver(strURL)
{   
  var req2 = getXMLHTTP();   
  if (req2) 
  {
    //function to be called when state is changed
    req2.onreadystatechange = function()
    {
      //when state is completed i.e 4
      if (req2.readyState == 4) 
      {     
        // only if http status is "OK"
        if (req2.status == 200)
        { 

        var responseArray = req2.responseText.split("||");          
          document.getElementById('drivername').value=responseArray[0];
          
                     
        } 
        else 
        {
          alert("There was a problem while using XMLHTTP:\n" + req2.statusText);
        }
      }       
     }      
     req2.open("GET", strURL, true);
     req2.send(null);
  }     
}
</script>  





<script>
$(document).ready(function(){
  $("#search-box").keyup(function(){
    $.ajax({
    type: "POST",
    url: "readcountry.php",
    data:'keyword='+$(this).val(),
    beforeSend: function(){
      $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    },
    success: function(data){
      $("#suggesstion-box").show();
      $("#suggesstion-box").html(data);
      $("#search-box").css("background","#FFF");
    }
    });
  });
});

function selectCountry(val) {
//$("#search-box").val(val);
$("#suggesstion-box").hide();

var responseArray = val.split("||");          
document.getElementById('search-box').value=responseArray[0];
document.getElementById('search-box1').value=responseArray[1];
document.getElementById('search-box2').value=responseArray[2];
document.getElementById('search-box3').value=responseArray[3];
}
</script>


<script>
  $(document).ready(function(){
  $('#route').on('change', function(){
    var routeid= $(this).val();
    if(routeid){
      $.ajax({
        type:'POST', 
        url:'ajaxdata.php', 
        data:'route_id='+routeid, 
        success: function(html){
          $('#vehicle').html(html);
          $('#time').html('<option value="">Select Vehicle first</option>');
        }
      });
    }else{
      $('#vehicle').html('<option value="">Select Route first</option>');
      $('#time').html('<option value="">Select Vehicle first</option>');
    }
  });

  $('#vehicle').on('change', function(){
    var vehicleid = $(this).val();
    if(vehicleid){
      $.ajax({
        type:'POST', 
        url:'ajaxdata.php', 
        data:'vehicle_id='+vehicleid, 
        success: function(html){
          $('#time').html(html);
        }
      });


      $.ajax({
        type:'POST', 
        url:'alien/find_seat.php', 
        data:'vehicle_id='+vehicleid, 
        success: function(data){
       var tty = $('#seat').val(data);
      var str =    JSON.stringify(data);
var stri = str.slice(1,-1);

var strArr = stri.split(",");


//alert(strArr[0]);
//alert(strArr[1]);
//alert(strArr[2]);

for(var i = 0; i<strArr.length;i++){
  //alert(strArr[i]);
       
          if(strArr[i] == 1 ){

$('#input1').css('background-color', '#28a745');
$('#input1').css('cursor', 'not-allowed');
$('#input1').css('pointer-events', 'none');
//alert('hey');
          }

         if(strArr[i] == 2 ){

$('#input2').css('background-color', '#28a745');
$('#input2').css('cursor', 'not-allowed');
$('#input2').css('pointer-events', 'none');
//alert('hey');
          }

          if(strArr[i] == 3 ){

$('#input3').css('background-color', '#28a745');
$('#input3').css('cursor', 'not-allowed');
$('#input3').css('pointer-events', 'none');
//alert('hey');
          }          if(strArr[i] == 4 ){

$('#input4').css('background-color', '#28a745');
$('#input4').css('cursor', 'not-allowed');
$('#input4').css('pointer-events', 'none');
//alert('hey');
          }          if(strArr[i] == 5 ){

$('#input5').css('background-color', '#28a745');
$('#input5').css('cursor', 'not-allowed');
$('#input5').css('pointer-events', 'none');
//alert('hey');
          }          if(strArr[i] == 6 ){

$('#input6').css('background-color', '#28a745');
$('#input6').css('cursor', 'not-allowed');
$('#input6').css('pointer-events', 'none');
//alert('hey');
          }          if(strArr[i] == 7 ){

$('#input7').css('background-color', '#28a745');
$('#input7').css('cursor', 'not-allowed');
$('#input7').css('pointer-events', 'none');
//alert('hey');
          }



        }
        }
      });


    }else{
      $('#time').html('<option value="">Select time first</option>');
    }
  });

  });
</script>


<script>
  //function for displaying values
  function dis(val){
    document.getElementById("edu").value=""
    document.getElementById("edu").value=val
    $nbsp;}
</script>


<script>


  function checkseat(val){

alert('Successfully');
    document.getElementById("test").innerHTML=val;
  }
</script>




</head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-success elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../dist/img/AdminLTELogo2.png" alt="NIS Mass Transit Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-dark">NIS Mass Transit</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="alert alert-default alert-dismissible" class="close" data-dismiss="alert"><strong>Welcome</strong> <?php echo $_SESSION['username'];?>.</div>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="edit.php" class="d-block">Ticket Admin<br/>[<span style="color: red;"><?php echo $_SESSION['username'];?></span>]</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class=""></i>
              </p>
            </a>
          </li>
          <!--<li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Create Admins
              </p>
            </a>
          </li>-->
          <li class="nav-item">
            <a href="terminal.php" class="nav-link">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Terminals
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="bus.php" class="nav-link">
              <i class="nav-icon fas fa-bus"></i>
              <p>
                Bus
                </p>
            </a>
          </li>
          <!--<li class="nav-item">
            <a href="driver.php" class="nav-link">
              <i class="nav-icon fas fa-hands"></i>
              <p>
                Driver
              </p>
            </a>
          </li>-->
          <li class="nav-item">
            <a href="route.php" class="nav-link">
              <i class="nav-icon fas fa-road"></i>
              <p>
                Routes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="customer.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="availability.php" class="nav-link">
              <i class="nav-icon fas fa-plus-square"></i>
              <p>
                Availability
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="booking.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Bookings
              </p>
            </a>
          </li>
          <!--<li class="nav-item">
            <a href="hire.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Hires
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dispatch.php" class="nav-link">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>
                Dispatch
              </p>
            </a>
          </li>-->
          <li class="nav-item">
            <a href="../logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   


      <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
          <div class="modal-content bg-gradient-info">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fas fa-building"></i> Assign Terminal Manager</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="POST">
            <div class="modal-body">
              <p>Select Terminal and Assign New Manager&hellip;</p>
              <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                  <label>Terminal:</label>
                  <select class="form-control select2 select2-success" name="terminal" data-dropdown-css-class="select2-primary" required="" style="width: 100%;">
                    <option selected="selected" value=""> </option>
                    <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM terminal");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  $terminaln = "<option value='".$row['tname']."' >". $row['tname'] .' ---> '. $row['tmanager']. "</option>";
}
?>
                  </select>
                </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                  <label>Manager:</label>
                  <select class="form-control select2 select2-success" name="manager" data-dropdown-css-class="select2-primary" required="" style="width: 100%;">
  <option selected="selected" value=""> </option>
                    <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM admin WHERE permission!=3");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  "<option value='".$row['fullname']."' >". $row['fullname'] .' ---> '. $row['position']. "</option>";
}
?>
                  </select>
                </div>
                    </div>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="assignterminalmanager" class="btn btn-success">Save changes</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




      <div class="modal fade" id="modal-print">
        <div class="modal-dialog">
          <div class="modal-content bg-gradient-success">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fas fa-building"></i> Print Manifest</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="printmanifest.php" method="POST">
            <div class="modal-body">
              <p>Enter accurate Details to print&hellip;</p>
              <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                  <label>Availability ID:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="av_id" class="form-control"
                           data-inputmask="" data-mask required="">
                  </div>
                </div>
                    </div>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="printmanifest" class="btn btn-danger">Search</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




      <div class="modal fade" id="modal-reprint">
        <div class="modal-dialog">
          <div class="modal-content bg-gradient-info">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fas fa-print"></i> Re-Print Booked Ticket</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="bookseatprocess.php" method="POST">
            <div class="modal-body">
              <p>Enter Last range digits of Ticket ID to re-print&hellip;</p>
              <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                  <label>Ticket ID:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="ticket_id" class="form-control"
                           data-inputmask="" data-mask required="">
                  </div>
                </div>
                    </div>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="reprintticket" class="btn btn-danger">Search</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->








      <div class="modal fade" id="modal-seat">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <form action="bookseatprocess.php" method="POST">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fas fa-bus"></i> Book a Seat</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Enter details correctly, always starting with customers phone number&hellip;</p>
              <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                  <label>Phone:</label>

                  <div class="input-group frmSearch">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" id="search-box" name="phone" class="form-control" data-inputmask="" autocomplete="off" data-mask required="">
                           <div id="suggesstion-box"></div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                  <label>Fullname:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="fname" id="search-box1" value="" class="form-control"
                           data-inputmask="" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <div class="form-group">
                  <label>NOK Name:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-book"></i></span>
                    </div>
                    <input type="text" name="NOKname" id="search-box2" value="" class="form-control"
                           data-inputmask="" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                    
                <div class="form-group">
                  <label>NOK Phone:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                    </div>
                    <input type="text" name="NOKphone" id="search-box3" value="" class="form-control"
                           data-inputmask="" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>
                

<div class="form-group">
                  <label>Payment Method:</label>
                  <select class="form-control select2 select2-success" name="payment_method" data-dropdown-css-class="select2-primary" style="width: 100%;" required="">
                    <option selected="selected" value="">Select Payment Method</option>
                    <option >Cash</option>
                    <option >Bank Transfer</option>
                    <option >POS</option>
                  </select>



                </div>

<!-- /.form group -->
                </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                  <label>Route:</label>
                  <select class="form-control select2 select2-success" name="route_id" onChange="getRoute('alien/find_route.php?route='+this.value)" id="route" data-dropdown-css-class="select2-primary" style="width: 100%;" required="">
                    <option selected="selected" value=""> </option>
                    <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM route");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  $bus = "<option value='".$row['r_id']."' >". $row['route'] .' ---> '. $row['amount']. "</option>";
}
?>
                  </select>



                </div>
<input type="text" name="route" id="route_id" class="form-control"
                           data-inputmask="" data-mask hidden="">

                <div class="form-group">
                  <label>Price:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                    </div>
                    <input type="text" name="amount" id="route_amount" class="form-control"
                           data-inputmask="" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <div class="form-group">
                  <label>Vehicle:</label>
                  <select class="form-control select2 select2-success" name="bus_no" id="vehicle" data-dropdown-css-class="select2-primary" style="width: 100%;" required="">
                    <option selected="selected"> </option>
                  </select>
                </div>



                  <select class="form-control select2 select2-success" name="av_id" id="time" data-dropdown-css-class="select2-primary" style="width: 100%;" hidden="">
                    <!--<option selected="selected"> </option>-->
                  </select>

<input type="text" name="seated" value="0" id="seat" oninput="checkseat(this.value)" class="form-control"
                           data-inputmask="" data-mask hidden="">
                           <p id="test"></p>

                <div class="form-group">
                  <label>Seat No:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-chair"></i></span>
                    </div>
                    <input type="text" name="seat_no" id="edu" class="form-control"
                           data-inputmask="" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                  <table style="background-color:#e84949;" class="table table-bordered">
                    <tr>
                      <td><span class="input-group-text"><i class="fas fa-chair"></i></span></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><input id="input1" type="button" value="1" onclick="dis('1')"> </td>
                    <tr>
                    <tr>
                      <td><input id="input2" type="button" value="2" onclick="dis('2')"> </td>
                      <td><input type="button" id="input3" value="3" onclick="dis('3')"> </td>
                      <td>&nbsp;</td>
                      <td><input type="button" id="input4" value="4" onclick="dis('4')"> </td>
                    </tr>
                    <tr>
                      <td><input type="button" id="input5" value="5" onclick="dis('5')"> </td>
                      <td><input type="button" id="input6" value="6" onclick="dis('6')"> </td>
                      <td>&nbsp;</td>
                      <td><input type="button" id="input7" value="7" onclick="dis('7')"> </td>
                    </tr>
                  </table>
                  <table>
                    <tr>
                      <td><input type="button" style="background-color: #28a745;
    cursor: not-allowed;
    pointer-events: none;"></td>
                      <td><input type="button" style="background-color: #fd7e14;
    cursor: not-allowed;
    pointer-events: none;"></td>
                      <td><input type="button"></td>
                    </tr>
                    <tr>
                      <td>Booked Seat</td>
                      <td>Selected Seat</td>
                      <td>Available Seat</td>
                    </tr>
                  </table>
                </div>
                <!-- /.form group -->
                    </div>
                  </div>
                  
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="bookseat" class="btn btn-success">Save changes</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



        <div class="modal fade" id="modal-dispatch">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fas fa-bus">>>></i><i class="fas fa-bus"></i> Dispatch Bus To another Terminal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="POST">
            <div class="modal-body">
              <p>Select Bus and Dispatch Location&hellip;</p>
              <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                  <label>Bus:</label>
                  <select class="form-control select2 select2-success" name="bus_no" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    <option selected="selected" value=""> </option>
                    <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM bus WHERE terminal_name='$terminalname'");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  $terminaln = "<option value='".$row['busno']."' >". $row['busno'] .' ---> '. $row['model']. "</option>";
}
?>
                  </select>
                </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                  <label>Dispatch/Terminal Location:</label>
                  <select class="form-control select2 select2-success" name="terminal" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    <option selected="selected" value=""> </option>
                    <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM terminal WHERE tname!='$terminalname'");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  $terminaln = "<option value='".$row['tname']."' >". $row['tname'] .' ---> '. $row['tmanager']. "</option>";
}
?>
                  </select>
                </div>
                    </div>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="dispatch" class="btn btn-success">Save changes</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




      <div class="modal fade" id="modal-accept">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h4 class="modal-title"><i class="fas fa-bus"><<<</i><i class="fas fa-bus"></i> Confirm/Accept Vehicle Dispatched to your Terminal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Confirm if only you have received the vehicle at your terminal.&hellip;</p>
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Dispatch ID</th>
                    <th>Busno</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th>Date Sent</th>
                    <th>Date Received</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                
                $db = getDB();
$result = $db->prepare("SELECT * FROM dispatch Where status='Pending' AND dto='$terminalname'");
                
                $result->execute();
                for($i=1; $row = $result->fetch(); $i++){

            ?>
                 
                  <tr>
                    <td>DIS-P10-<?php echo $row['id']; ?></td>
                    <td><?php echo $row['busno']; ?></td>
                    <td><?php echo $row['dfrom']; ?></td>
                    <td><?php echo $row['dto']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['datecreated']; ?></td>
                    <td><?php echo $row['date_received']; ?></td>
                    <td class="text-center"><form method="POST" action=""><input type="text" name="id" value="<?php echo $row['id'];?>" hidden><input type="text" name="term" value="<?php echo $row['dto'];?>" hidden><input type="text" name="busno" value="<?php echo $row['busno'];?>" hidden><button name="accept" title="Accept" class="btn btn-success">Confirm<i class="fa fa-handshake" aria-hidden="true"></i></button></form></td>
                  </tr>
                  <?php
if(isset($_POST['accept'])){

$id = $_POST['id'];
$term = $_POST['term'];
$busno = $_POST['busno'];
$datereceived = $_POST['datereceived'] = date('Y-m-d H:i:s');


$stat=$db->prepare("UPDATE bus
                        SET terminal_name = '$term', status = 'Available', dispatch_request  = 'Received'
               WHERE busno='$busno'");
$stat->execute();
if($stat){

  $stat1=$db->prepare("UPDATE dispatch
                        SET received = 1, status = 'Completed', date_received = '$datereceived'
               WHERE id='$id'");
$stat1->execute();

if($stat1){
  ?>
<script>
  alert('Vehicle Accepted into Terminal, you can now assign the vehicle for booking');
  window.location.href='index.php';
</script>
  <?php
}

}
}



                }
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Dispatch ID</th>
                    <th>Busno</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th>Date Sent</th>
                    <th>Date Received</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-success" data-dismiss="modal">Close</button>
              </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




      <div class="modal fade" id="modal-assignbus">
        <div class="modal-dialog">
          <form action="" method="POST">
          <div class="modal-content bg-gradient-info">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fas fa-check-circle"> </i><i class="fas fa-bus"></i> Assign Bus for Booking</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="POST">
            <div class="modal-body">
              <p>Enter details to make a bus available&hellip;</p>
              <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      
                      <div class="form-group">
                  <label>Bus No:</label>
                  <select class="form-control select2 select2-success" name="bus_no" onChange="getCurrencyCode('alien/find_ccode.php?busnumber='+this.value)"  data-dropdown-css-class="select2-primary" required="" style="width: 100%;">
         <option selected="selected" value=""> </option>
                    <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM bus WHERE status='Available'");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  $bus = "<option value='".$row['busno']."' >". $row['busno'] .' ---> '. $row['model']. "</option>";
}
?>
                  </select>
                </div>



                      <div class="form-group">
                  <label>Bus Model:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-bus"></i></span>
                    </div>
                    
                    <input type='text' name='bus_model' id="cur_code" value=""  class='form-control' data-inputmask='' readonly="">
                    </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                  <label>Total Seats:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-chair"></i></span>
                    </div>
                    <input type="text" name="totalseats" id="cur_code2" value="0" class="form-control" data-inputmask="" data-mask readonly="" required="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                  <label>Route:</label>
                  <select class="form-control select2 select2-success" name="route_id" onChange="getRoutes('alien/find_routes.php?routes='+this.value)" data-dropdown-css-class="select2-primary" required="" style="width: 100%;">
                   <option selected="selected" value=""> </option>
                    <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM route");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  $bus = "<option value='".$row['r_id']."' >". $row['route'] .' ---> '. $row['amount']. "</option>";
}
?>
                  </select>
                </div>
                <!-- /.form group -->
                <input type="text" name="route" id="routes_id" value="0" class="form-control" >
                
                
                
                <div class="form-group">
                  <label>Amount:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                    </div>
                    <input type="text" name="amount" id="routes_amount" value="0" class="form-control" data-inputmask="" data-mask required="" readonly="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                
                </div>



                    <div class="col-sm-6">
                      <!-- text input -->
                <div class="form-group">
                  <label>Departure Date:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="date" name="departuredate" class="form-control datepicker-input" required="" data-target="#reservationdate"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <!-- /.form group -->

                <div class="form-group">
                  <label>Time of Departure(24hr Format):</label>
                    <div class="input-group time" id="reservationtime" data-target-input="nearest">
                        <input type="time" name="departuretime" class="form-control timepicker-input" required="" data-target="#reservationtime"/>
                        <div class="input-group-append" data-target="#reservationtime" data-toggle="timepicker">
                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                        </div>
                    </div>
                </div>
                <!-- /.form group -->


                
                <div class="form-group">
                  <label>Captain Name:</label>
                  <select class="form-control select2 select2-success" name="driver_id" onChange="getDriver('alien/find_driver.php?driver='+this.value)" data-dropdown-css-class="select2-primary" required="" style="width: 100%;">
                    <option selected="selected" > </option>
  <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM driver WHERE status='Available'");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  $bus = "<option value='".$row['d_id']."' >". $row['fname'] ."</option>";
}
?>
                  </select>
                </div>
                <!-- /.form group -->
                <input type="text" name="drivername" id="drivername" value="" class="form-control" hidden="">


                <div class="form-group">
                  <label>Terminal Name:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" name="terminal" id="cur_code3" value="" class="form-control" data-inputmask="" data-mask required="" readonly="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                    </div>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="assignbus" class="btn btn-success">Save changes</button>
            </div>
            </form>
          </div>
        
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-12 text-center">
   
            <!--<button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-primary"><i class="fas fa-building"></i><h5>Assign Terminal Manager</h5></button>
-->
            <button type="button" class=" btn btn-outline-success" data-toggle="modal" data-target="#modal-print"><i class="fas fa-print"></i> <h5>Print Manifest</h5></button>

            <button type="button" class=" btn btn-outline-info" data-toggle="modal" data-target="#modal-reprint"><i class="fas fa-print"></i> <h5>Re-print Ticket</h5></button>
            
            <button type="button" class=" btn btn-outline-danger" data-toggle="modal" data-target="#modal-seat"><i class="fas fa-chair"></i> <h5>Book a Seat</h5></button>
          
            <!--<button type="button" class=" btn btn-outline-info" data-toggle="modal" data-target="#modal-dispatch"><i class="fas fa-paper-plane"></i> <h5>Dispatch bus</h5></button>

            <button type="button" class=" btn btn-outline-success" data-toggle="modal" data-target="#modal-accept"><i class="fas fa-handshake"></i> <h5>Receive Dispatch</h5></button>

            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-assignbus" disabled=""><i class="fas fa-bus"></i><h5>Assign Bus for Booking</h5></button>          
      -->    
        
            
          
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>





    <!-- /.content-header -->


<?php 




   $db = getDB();
$result = $db->prepare("SELECT count(bus_id) as pop FROM bus");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {
   $registeredbus=  $row['pop'];

?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $registeredbus; }?></h3>

                <p>Registered Buses</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
<?php 




   $db = getDB();
$result = $db->prepare("SELECT count(cust_id) as pop FROM customer");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {
   $registeredcust=  $row['pop'];

?>

            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $registeredcust; }?></h3>

                <p>Total Customers</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
<?php 




   $db = getDB();
$result = $db->prepare("SELECT count(d_id) as pop FROM driver");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {
   $registereddriver=  $row['pop'];

?>

            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
                <h3><?php echo $registereddriver; } ?></h3>

                <p>Registered Captains</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <?php 




   $db = getDB();
$result = $db->prepare("SELECT count(r_id) as pop FROM route");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {
   $registeredroute=  $row['pop'];

?>

            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $registeredroute; }?></h3>

                <p>Total Routes</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


          <div class="col-lg-3 col-6">
            <?php 




   $db = getDB();
$result = $db->prepare("SELECT count(av_id) as pop FROM availability WHERE status='Available'");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {
   $availablebuses=  $row['pop'];

?>

            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $availablebuses; }?></h3>

                <p>Available Buses</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
<?php 




   $db = getDB();
$result = $db->prepare("SELECT count(bus_id) as pop FROM bus WHERE status='Available'");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {
   $waitingbuses=  $row['pop'];

?>
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $waitingbuses; }?></h3>

                <p>Waiting Buses</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
  <?php 




   $db = getDB();
$result = $db->prepare("SELECT count(d_id) as pop FROM driver WHERE status='Available'");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {
   $availabledrivers=  $row['pop'];

?>
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $availabledrivers; }?></h3>

                <p>Waiting Captains</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
 <?php 

$date = date("Y-m-d");
   $db = getDB();
$result = $db->prepare("SELECT count(id) as pop FROM booking WHERE Date(date_created) = ?");
$result->execute(array($date));
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {
   $bookingstoday=  $row['pop'];

?> 
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
                <h3><?php echo $bookingstoday; }?></h3>

                <p>Bookings Today</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->






        <!-- Main row -->
        <div class="row">
          <!-- Left col -->


  <div class="card">
              <div class="card-header">
                <h3 class="card-title">Latest Bookings Today</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Availability ID</th>
                    <th>Booking ID</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Captain Name</th>
                    <th>Bus Model</th>
                    <th>Seat No</th>
                    <th>Departure Time</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                $date = date("Y-m-d");
                $db = getDB();
$result = $db->prepare("SELECT * FROM booking WHERE DATE(date_created) = ? Order by departuretime DESC");
                
                $result->execute(array($date));
                for($i=1; $row = $result->fetch(); $i++){

            ?>
                  <tr>
                    <td><?php echo $row['availability_id']; ?></td>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo $row['cust_name']; ?></td>
                    <td><?php echo $row['cust_phone']; ?></td>
                    <td><?php echo $row['driver_name']; ?></td>
                    <td><?php echo $row['bus_model']; ?></td>
                    <td><?php echo $row['seat_no']; ?></td>
                    <td><?php echo $row['departuretime']; ?></td>   
                  </tr>
                  <?php
                }
                  ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Availability ID</th>
                    <th>Booking ID</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Captain Name</th>
                    <th>Bus Model</th>
                    <th>Seat No</th>
                    <th>Departure Time</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-info">
              <div class="card-header">
                <h3 class="card-title">Available Booking Percentage</h3>

                <div class="card-tools">
                  <span title="0 New Messages" class="badge badge-info">0</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Vehicle No</th>
                      <th>Booking Progress</th>
                      <th style="width: 40px">Percentage</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                $db = getDB();
$result = $db->prepare("SELECT * FROM availability WHERE status!='Transaction Completed' Order by departuredate DESC");
                
                $result->execute(array($date));
                for($i=1; $row = $result->fetch(); $i++){
                    
            ?>
                    <tr>
                      <td><?php echo $row['av_id']; ?>.</td>
                      <td><?php echo $row['bus_no']; ?></td>
                      <td hidden=""><?php 
                      $avseats = $row['available_seats']; 
                      $totalseats=$row['total_seats'];
                      $seatstaken=$totalseats-$avseats;
                      $progress=($seatstaken/$totalseats)*100; ?></td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-<?php if($progress<=30){
                            echo 'danger';
                          }elseif($progress>30&&$progress<61){
                            echo 'info';
                          }elseif($progress>60&&$progress<91){
                            echo 'warning';
                          }elseif($progress>90){
                            echo 'success';}?>" style="width: <?php echo $progress;?>%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-<?php 
                          if($progress<=30){
                            echo 'danger';
                          }elseif($progress>30&&$progress<61){
                            echo 'info';
                          }elseif($progress>60&&$progress<91){
                            echo 'warning';
                          }elseif($progress>90){
                            echo 'success';}?>"><?php echo $progress;?>%</span></td>
                    </tr>
                    <?php
                  }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->

            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- Map card -->
            <div class="card bg-gradient-info">
              
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Safety</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Affordability</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Friendliness</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->


            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
                  
            <!-- /.card -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--Footer-->
<?php
include('../footer.php');
?>
  <!--/Footer-->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<!--<script src="../dist/js/adminlte.js"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
