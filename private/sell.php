<?php

//error_reporting( ~E_NOTICE ); // avoid notice
session_start();



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

if($_SESSION['permission'] != 3){ 

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

$adminname = $_SESSION['username'];
$uid = $_SESSION['uid'];

$errorMsgReg=''; $usernameErr = ''; $passwordErr= '';
$fnameErr = ""; $emailErr = ""; $phoneErr = "";

$username = $password = $fname = $email = $phone = "";

function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }


if (isset($_POST['addCart'])) {
  # code...


 if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["pname"])) {
               echo $pnameErr = "<span style=\"color:red;\">Product Name is required</span>";
            }else {
               $pname = test_input($_POST["pname"]);
            }
 }


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["saleprice"])) {
               echo $salepriceErr = "<span style=\"color:red;\">Product Price is required</span>";
            }else {
               $saleprice = test_input($_POST["saleprice"]);
            }
 }

 
 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["transcode"])) {
             echo $transcodeErr = "<span style=\"color:red;\">Receipt No cannot be Empty</span>";
            }else {
               $transcode = test_input($_POST["transcode"]);
            }
  }
 
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["qty"])) {
             echo $qtyErr = "<span style=\"color:red;\">Stock Quantity cannot be Empty</span>";
            }else {
               $qty = test_input($_POST["qty"]);
            }
  }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["totalcost"])) {
             echo $totalcostErr = "<span style=\"color:red;\">Total Cost cannot be Empty</span>";
            }else {
               $totalcost = test_input($_POST["totalcost"]);
            }
  }

    
$pid = $_POST['pid'];
$pleft = $_POST['pleft'];
$psold = $_POST['psold'];
$newpsold = $psold + $qty;
$newpleft = $pleft - $qty;
$datecreated= $_POST['datecreated'] = date('Y-m-d H:i:s');
$status= $_POST['status'] = 'PENDING';
$updatedby= $_POST['updatedby'] = 'updated by '.' '.$adminname;
$staff = $_POST['staff'] = $adminname;
  # code...

    $cartid=$userClass->addCart($pname, $saleprice, $transcode, $qty, $totalcost, $datecreated, $status, $pid, $newpleft, $newpsold, $updatedby, $staff );
    if($cartid)
    {
      ?>
    <script>
        alert('Added Successfully to Cart Click OK to continue...');
        window.location.href='sell.php';
        </script>  
      <?php
    }
    else
    {
      echo $errorMsgReg="<span style=\"color:red;\">Error in Data Entry.</span>";
    }

   } 



   if (isset($_POST['confirmPurchase'])) {
  # code...


 if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["pname"])) {
               echo $pnameErr = "<span style=\"color:red;\">Product Name is required</span>";
            }else {
               $pname = test_input($_POST["pname"]);
            }
 }


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["saleprice"])) {
               echo $salepriceErr = "<span style=\"color:red;\">Product Price is required</span>";
            }else {
               $saleprice = test_input($_POST["saleprice"]);
            }
 }

 
 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["transcode"])) {
             echo $transcodeErr = "<span style=\"color:red;\">Receipt No cannot be Empty</span>";
            }else {
               $transcode = test_input($_POST["transcode"]);
            }
  }
 
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["qty"])) {
             echo $qtyErr = "<span style=\"color:red;\">Stock Quantity cannot be Empty</span>";
            }else {
               $qty = test_input($_POST["qty"]);
            }
  }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["totalcost"])) {
             echo $totalcostErr = "<span style=\"color:red;\">Total Cost cannot be Empty</span>";
            }else {
               $totalcost = test_input($_POST["totalcost"]);
            }
  }

    
$pid = $_POST['pid'];
$pleft = $_POST['pleft'];
$psold = $_POST['psold'];
$newpsold = $psold + $qty;
$newpleft = $pleft - $qty;
$datecreated= $_POST['datecreated'] = date('Y-m-d H:i:s');
$status= $_POST['status'] = 'PENDING';
$updatedby= $_POST['updatedby'] = 'updated by '.' '.$adminname;
$staff = $_POST['staff'] = $adminname;
  # code...

    $cartid=$userClass->addCart($pname, $saleprice, $transcode, $qty, $totalcost, $datecreated, $status, $pid, $newpleft, $newpsold, $updatedby, $staff );
    if($cartid)
    {
      ?>
    <script>
        alert('Added Successfully to Cart Click OK to continue...');
        window.location.href='sell.php';
        </script>  
      <?php
    }
    else
    {
      echo $errorMsgReg="<span style=\"color:red;\">Error in Data Entry.</span>";
    }

   } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Demo Retail System | Admin</title>

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

.frmSearch {border: 0px solid #fff;background-color: #fff;margin: 0px 0px;padding:3px;border-radius:0px;}

#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:220px;position: left;}
#country-list li{padding: 10px; background: #fff; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#1d93a6;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>

  <!-- Search sales details fill up -->
<script>
$(document).ready(function(){
  $("#salesearch-box").keyup(function(){
    $.ajax({
    type: "POST",
    url: "salesearch.php",
    data:'keyword='+$(this).val(),
    beforeSend: function(){
      $("#salesearch-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    },
    success: function(data){
      $("#salesuggesstion-box").show();
      $("#salesuggesstion-box").html(data);
      $("#salesearch-box").css("background","#FFF");
    }
    });
  });
});

function selectProductsearch(val) {
//$("#search-box").val(val);
$("#salesuggesstion-box").hide();

var responseArray = val.split("||");          
document.getElementById('salesearch-box').value=responseArray[0];
document.getElementById('salesearch-box0').value=responseArray[1];
document.getElementById('salesearch-box1').value=responseArray[2];
document.getElementById('salesearch-box2').value=responseArray[3];
document.getElementById('salesearch-box3').value=responseArray[4];
document.getElementById('salesearch-box4').value=responseArray[5];
}
</script>


<!-- Search Customer details fill up -->
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

function selectCustomer(val) {
//$("#search-box").val(val);
$("#suggesstion-box").hide();

var responseArray = val.split("||");          
document.getElementById('search-box').value=responseArray[0];
document.getElementById('search-box1').value=responseArray[1];
document.getElementById('search-box2').value=responseArray[2];
document.getElementById('search-box3').value=responseArray[3];
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
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" data-widget="fullscreen" href="#" role="button">
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
      <img src="../dist/img/logo.jpg" alt="Demo Retail System Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-dark">Demo Retail System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="edit.php" class="d-block">Super Admin<br/>[<span style="color: red;"><?php echo $_SESSION['username'];?></span>]</a>
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
          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Admins
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sale.php" class="nav-link">
              <i class="nav-icon fas fa-check-square"></i>
              <p>
                Sales
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="salesummary.php" class="nav-link">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>
                Sale Summary
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="product.php" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Product
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="stock.php" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Stock
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
            <a href="outofstock.php" class="nav-link">
              <i class="nav-icon fas fa-battery-empty"></i>
              <p>
                Out of Stock
              </p>
            </a>
          </li>
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sell a Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sell a Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-9 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

          <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Sell a Product</h3>
              </div>
              <div class="card-body">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                  <label>Search Product name:</label>
                  <div class="input-group frmSearch">
                    <input type="text" id="salesearch-box" name="product" class="form-control" data-inputmask="" autocomplete="off" data-mask required="">
                           <div id="salesuggesstion-box"></div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
              </div>
              <hr>
              <form action="" method="POST">
              <div class="row">
                <div class="col-sm-6">
                     
                       <div class="form-group">
                  <label>Product Name: </label>
                      
                  <div class="input-group frmSearch">
                    <input type="text" id="salesearch-box0" name="pname" class="form-control" data-inputmask="" autocomplete="off" data-mask required="" style="border:0px;" readonly="">
                  </div>
                  <!-- /.input group -->
                </div>



                 <div class="form-group">
                  <label>Price:</label>
                      
                  <div class="input-group frmSearch">
                    <input type="text" id="salesearch-box1" name="saleprice" class="form-control" data-inputmask="" autocomplete="off" data-mask required="" style="border:0px;" readonly="">
                          </div>
                  <!-- /.input group -->
                </div>
<?php
$db = getDB();
          $st = $db->prepare("SELECT * FROM salesummary");  
          $st->execute();
          $count=$st->rowCount();
           $tid=$db->lastInsertId();
           $bcode = $count+1;
           $rcode = 'BET-'.$uid.'0000'.$bcode;
           ?>
                 <div class="form-group">
                  <label>Receipt No:</label>
                      
                  <div class="input-group frmSearch">
                    <input type="text" name="transcode" value="<?php echo $rcode; ?>" class="form-control" data-inputmask="" autocomplete="off" data-mask required="" style="border:0px;" readonly="">
                           </div>
                  <!-- /.input group -->
                </div>


                <div class="form-group">
                  <label>Available Quantity:</label>

                  <div class="input-group">
                    <input type="text" name="pleft" id="salesearch-box2" value="" class="form-control"
                           data-inputmask="" data-mask required="" style="border:0px;" readonly="">

                    <input type="text" name="psold" id="salesearch-box4" value="" class="form-control"
                           data-inputmask="" data-mask required="" style="border:0px;" readonly="" hidden="">

                  <input type="text" name="pid" id="salesearch-box3" value="" class="form-control"
                           data-inputmask="" data-mask required="" style="border:0px;" readonly="" hidden="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->


                </div>
                

                <div class="col-sm-6">
                


                <div class="form-group">
                  <label>Quantity:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-book"></i></span>
                    </div>
                    <input type="number" name="qty" value="" class="form-control" id="qty" onkeypress="return add_number(event)"
                           data-inputmask="" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                    
                <div class="form-group">
                  <label>Total:</label>

                  <div class="input-group">
                    <input type="text" name="totalcost" id="totalcost" value="" class="form-control"
                           data-inputmask="" data-mask required="" readonly="">
                  </div>
                  <!-- /.input group -->
                </div>

                <button type="submit" name="addCart" class=" btn-lg btn-info" data-toggle="modal" data-target="#modal-dispatch"><i class="fas fa-cart-plus"></i> <h5>Add to Cart</h5></button>
<script>
                      /*function calculateAmount(val) {
                        var val1 = $('input[value="qty"]').val();
                        var tot_price = val * val1;
                        var divobj = document.getElementById('totalcost');
                        divobj.value = tot_price;
                      }
*/
                      function add_number(e) {
  if (isNumberKey(e)) {
    setTimeout(() => {
      var first_number = document.getElementById("qty").value !== "" ? parseInt(document.getElementById("qty").value) : 0;
      var second_number = document.getElementById("salesearch-box1").value !== "" ? parseInt(document.getElementById("salesearch-box1").value) : 0;
      var result = first_number * second_number;
      document.getElementById("totalcost").value = result;
    }, 50)
    return true;
  } else {
    return false;
  }
}

function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}
                    </script>

                </div>
                              </div>
                            </form>
                              <hr>
                <div class="row">
                  <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Retail Price</th>
                    <th>Amount</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                
                $db = getDB();
$result = $db->prepare("SELECT * FROM sale Where status='PENDING' AND staff='$adminname' ORDER BY saleid ASC");
                
                $result->execute();
                for($i=1; $row = $result->fetch(); $i++){

            ?>
                 
                  <tr>
                    <td><?php echo $row['pname']; ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td><?php echo $row['saleprice']; ?></td>
                    <td><?php echo $row['totalcost']; ?></td>
                    <td class="text-center"><form method="POST" action="">
                      <input type="text" name="saleid" value="<?php echo $row['saleid']; ?>" hidden>
                      <button class="btn btn-danger" title="Delete" type="submit" name="delete"><i class="fa fa-trash-alt"></i></button></form></td>
                  </tr>
                  <?php
if (isset($_POST['delete'])) {

 $saleid = $_POST['saleid'];
 
 $db = getDB();
$stmt=$db->prepare("SELECT * FROM sale WHERE saleid= $saleid");
   $result = $stmt->execute();

   if (($result !==false) && ($stmt->rowCount())) {
    
    $row = $stmt->fetch();
    $pid = $row['pid'];
    $qty = $row['qty'];

$stmt=$db->prepare("SELECT * FROM product WHERE pid= $pid");

   $result = $stmt->execute();

   if (($result !==false) && ($stmt->rowCount())) {
  $row = $stmt->fetch();

$pleft = $row['pleft'];
$psold = $row['psold'];

$newproductleft = $pleft+$qty;
$newproductsold = $psold-$qty;



$sta=$db->prepare("UPDATE product SET psold = $newproductsold, pleft = $newproductleft
               WHERE pid = '$pid'");
$sta->execute();

if($sta){ 
$sta=$db->prepare("DELETE FROM sale
               WHERE saleid = '$saleid'");
$sta->execute();

?>

<script>
        alert('Product Successfully Deleted...');
        window.location.href='sell.php';
        </script>
<?php 
}
}
}
                }
              }
                  ?>
                  </tbody>
                 <!-- <tfoot>
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
                  </tfoot> -->
                </table>
                  </div>
                                
                </div>
                <form action="saleprocess.php" method="POST">
              <div class="row">               
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                  <label>Total Retail:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                    </div>            
                    <?php
                    
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT sum(totalcost) as pop FROM sale WHERE status = 'PENDING' AND staff='$adminname'");
$result->execute();
  
for($i=0; $row = $result->fetch(); $i++)
        
        {
  
$totalretail = $row['pop'];

?>
                  

<input type="text" name="summedcost" id="summedcost" value="<?php echo $totalretail; ?>" class="form-control"
                           data-inputmask="" data-mask readonly="">
</div>

                </div>

                <div class="form-group">
                  <label>Discount:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                    </div>
                     <input type="number" name="discount" id="discount" value="0" onkeypress="return add_number1(event)" class="form-control"
                           data-inputmask="" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>
                <div class="form-group">
                  <label>Amount Due:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                    </div>
                    <input type="text" name="totalcosting" id="totalcosting" value="<?php echo $totalretail; }?>" class="form-control"
                           data-inputmask="" data-mask readonly="">
                  </div>
                </div>
<script>
 function add_number1(f) {
  if (isNumberKey(f)) {
    setTimeout(() => {
      var first_number = document.getElementById("summedcost").value !== "" ? parseInt(document.getElementById("summedcost").value) : 0;
      var second_number = document.getElementById("discount").value !== "" ? parseInt(document.getElementById("discount").value) : 0;
      var result = first_number - second_number;
      document.getElementById("totalcosting").value = result;
    }, 50)
    return true;
  } else {
    return false;
  }
}

function isNumberKey1(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}
                    </script>

                  <div class="form-group">
                  <label>Payment Method:</label>
                  <select class="form-control select2 select2-success" name="paymentmethod" data-dropdown-css-class="select2-primary" style="width: 100%;" required="">
                    <option selected="selected" value="">Select Payment Method</option>
                    <option >Cash</option>
                    <option >Bank Transfer</option>
                    <option >POS</option>
                  </select>



                </div>
              </div>



                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                  <label>Phone:</label>

                  <div class="input-group frmSearch">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                   <input type="text" id="search-box" name="cphone" value="07033" class="form-control" data-inputmask="" autocomplete="off" data-mask readonly="">
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
                    <input type="text" name="cname" id="search-box1" value="Customer" class="form-control"
                           data-inputmask="" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <div class="form-group">
                  <label>Address:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-book"></i></span>
                    </div>
                    <input type="text" name="caddress" id="search-box2" value="B/C" class="form-control"
                           data-inputmask="" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                    
                <div class="form-group">
                  <label>Email:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                    </div>
                    <input type="text" name="cemail" id="search-box3" value="customer@gmail.com" class="form-control"
                           data-inputmask="" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>
        
                    <input type="text" name="transcode" value="<?php echo $rcode; ?>" class="form-control"
                           data-inputmask="" data-mask required="" hidden="">
                
<!-- /.form group -->
                </div>
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="confirmPurchase" class="btn btn-success">Print Receipt</button>
            </div>
          </form>        
            </div>
          
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-3 connectedSortable">

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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


      <!--Footer-->
<?php
include('../footer.php');
?>
  <!--/Footer-->

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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>
<!-- jQuery Mapael -->
<script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
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
