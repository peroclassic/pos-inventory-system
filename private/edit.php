<?php

//error_reporting( ~E_NOTICE ); // avoid notice
session_start();



// Test the session to see if is_auth flag was set (meaning they logged in successfully)

// If test fails, send the user to login.php and prevent rest of page being shown.
if($_SESSION['ban'] == 1){ 

        ?>
                          <script>
        alert('Your Account has been Suspended, for complains or plea to unsuspend your account, contact your Branch Manager');
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Demo Retail System | Edit</title>

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
        <a href="index3.html" class="nav-link">Home</a>
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
          <a href="#" class="d-block">Super Admin<br/>[<span style="color: red;"><?php echo $_SESSION['username'];?></span>]</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class=""></i>
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
            <h1 class="m-0">Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit</li>
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


           <?php

if(isset($_GET['id'])){

$db = getDB();
    $id = $_GET['id'];        
        
    $result = $db->prepare("SELECT * FROM user WHERE uid = '$id'");
$result->execute();
$stmp = $result->rowCount();
for($i=0; $row = $result->fetch(); $i++)
        
        {



          



                
            ?>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Admin Profile</h3>
              </div>
              <div class="card-body">
                <form action="update.php" method="POST">
                

<input type="text" name="id" value="<?php echo $row['uid'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask hidden>
                <!-- Username -->
                <div class="form-group">
                  <label>Username:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa--alt">@</i></span>
                    </div>
                    <input type="text" name="username" value="<?php echo $row['username'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="" readonly="">
                  </div>  
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <div class="form-group">
                  <label>Fullname:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="fname" value="<?php echo $row['fullname'];?>" class="form-control" data-inputmask-alias="fullname" data-inputmask-inputformat="text" data-mask required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- Email -->
<div class="form-group">
                  <label>Email:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="email" name="email" value="<?php echo $row['email'];?>" class="form-control" data-inputmask-alias="email" data-inputmask-inputformat="email" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>                <!-- /.form group -->

                <!-- phone mask -->
                <div class="form-group">
                  <label>Phone:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="phone" value="<?php echo $row['phone'];?>" class="form-control"
                           data-inputmask="" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
            
                <div class="form-group">
                  <label>Position:</label>
                  <select class="form-control select2 select2-success" name="position" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    <option value="<?php echo $row['position'];?>" selected="selected"><?php echo $row['position'];?></option>
                    <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM staffposition");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  $position = "<option value='".$row['posname']."' >". $row['posname'] ."</option>";
}
?>
                  </select>
                </div>
                <!-- /.form-group -->
             
                <div class="card-footer">
                  <button type="submit" name="updateadminprofile" class="btn btn-success">Update Admin Details</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <?php
}
}






// Edit Terminal details

if(isset($_GET['tid'])){

$db = getDB();
    $tid = $_GET['tid'];        
        
    $result = $db->prepare("SELECT * FROM terminal WHERE t_id = '$tid'");
$result->execute();
$stmp = $result->rowCount();
for($i=0; $row = $result->fetch(); $i++)
        
        {



          



                
            ?>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Terminal Details</h3>
              </div>
              <div class="card-body">
                <form action="update.php" method="POST">
                

<input type="text" name="tid" value="<?php echo $row['t_id'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask hidden>
                <!-- Username -->
                <div class="form-group">
                  <label>Terminal name:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" name="tname" value="<?php echo $row['tname'];?>" class="form-control" data-inputmask-alias="terminalname" data-inputmask-inputformat="text" data-mask readonly>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <div class="form-group">
                        <label>Terminal Address:</label>
                        <textarea class="form-control" name="taddress" rows="3" placeholder="Enter Address..."><?php echo $row['taddress'];?></textarea>
                      </div>
                <!-- /.form group -->
            
                <div class="form-group">
                  <label>Terminal State:</label>
                  <select class="form-control select2 select2-success" name="tstate" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    <option value="<?php echo $row['tstate'];?>" selected="selected"><?php echo $row['tstate'];?></option>
                    <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM states");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  $bus = "<option value='".$row['name']."' >". $row['name'] ."</option>";
}
?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Terminal City:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-road"></i></span>
                    </div>
                    <input type="text" name="tcity" value="<?php echo $row['tcity'];?>" class="form-control" data-inputmask-alias="city" data-inputmask-inputformat="text" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>

                <!-- /.form group -->
                <div class="card-footer">
                  <button type="submit" name="updateterminal" class="btn btn-success">Update Terminal Details</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <?php
}
}







// Edit Bus details

if(isset($_GET['bid'])){

$db = getDB();
    $bid = $_GET['bid'];        
        
    $result = $db->prepare("SELECT * FROM bus WHERE bus_id = '$bid'");
$result->execute();
$stmp = $result->rowCount();
for($i=0; $row = $result->fetch(); $i++)
        
        {



          



                
            ?>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Vehicle Details</h3>
              </div>
              <div class="card-body">
                <form action="update.php" method="POST">
                

<input type="text" name="bid" value="<?php echo $row['bus_id'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask hidden>
                <!-- Username -->
                <div class="form-group">
                  <label>Vehicle Number:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-book"></i></span>
                    </div>
                    <input type="text" name="busno" value="<?php echo $row['busno'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="" readonly>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
            <div class="form-group">
                  <label>Vehicle Model:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-bus"></i></span>
                    </div>
                    <input type="text" name="model" value="<?php echo $row['model'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>

                 <div class="form-group">
                  <label>Available Seats:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-chair"></i></span>
                    </div>
                    <input type="number" name="avseats" value="<?php echo $row['avseats'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <label>Terminal Name:</label>
                  <select class="form-control select2 select2-success" name="terminal_name" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    <option value="<?php echo $row['terminal_name'];?>" selected="selected"><?php echo $row['terminal_name'];?></option>
                   <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM terminal");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  $terminal = "<option value='".$row['tname']."' >". $row['tname'] ."</option>";
}
?>
                  </select>
                </div>


                <!-- /.form group -->
                <div class="card-footer">
                  <button type="submit" name="updatebus" class="btn btn-success">Update Bus Details</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <?php
}
}








// Edit Product details

if(isset($_GET['pid'])){

$db = getDB();
    $pid = $_GET['pid'];        
        
    $result = $db->prepare("SELECT * FROM product WHERE pid = '$pid'");
$result->execute();
$stmp = $result->rowCount();
for($i=0; $row = $result->fetch(); $i++)
        
        {



          



                
            ?>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Product Details</h3>
              </div>
              <div class="card-body">
                <form action="update.php" method="POST">
                

<input type="text" name="pid" value="<?php echo $row['pid'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask hidden>
                <div class="form-group">
                  <label>Product Code:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="pcode" value="<?php echo $row['pcode'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="" readonly="" >
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- Username -->
                <div class="form-group">
                  <label>Product Name:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="pname" value="<?php echo $row['pname'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <!-- Product Desc -->
                <div class="form-group">
                  <label>Product Desc:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="pdesc" value="<?php echo $row['pdesc'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
            <div class="form-group">
                  <label>Sale Price:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    </div>
                    <input type="number" name="saleprice" value="<?php echo $row['saleprice'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="number" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>

                <!-- /.form group -->
                <div class="card-footer">
                  <button type="submit" name="updateproduct" class="btn btn-success">Update Product Details</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <?php
}
}






// Edit Route details

if(isset($_GET['rid'])){

$db = getDB();
    $rid = $_GET['rid'];        
        
    $result = $db->prepare("SELECT * FROM route WHERE r_id = '$rid'");
$result->execute();
$stmp = $result->rowCount();
for($i=0; $row = $result->fetch(); $i++)
        
        {



          



                
            ?>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Route Details</h3>
              </div>
              <div class="card-body">
                <form action="update.php" method="POST">
                

<input type="text" name="rid" value="<?php echo $row['r_id'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask hidden>
                <!-- Username -->
                <div class="form-group">
                  <label>Route:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" name="route" value="<?php echo $row['route'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
            <div class="form-group">
                  <label>Amount:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                    </div>
                    <input type="text" name="amount" value="<?php echo $row['amount'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>

                <!-- /.form group -->
                <div class="card-footer">
                  <button type="submit" name="updateroute" class="btn btn-success">Update Routes</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <?php
}
}






// Edit Customer details

if(isset($_GET['cid'])){

$db = getDB();
    $cid = $_GET['cid'];        
        
    $result = $db->prepare("SELECT * FROM customer WHERE cid = '$cid'");
$result->execute();
$stmp = $result->rowCount();
for($i=0; $row = $result->fetch(); $i++)
        
        {



          



                
            ?>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Customer Details</h3>
              </div>
              <div class="card-body">
                <form action="update.php" method="POST">
                

<input type="text" name="cid" value="<?php echo $row['cid'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask hidden>
                <!-- Username -->
                <div class="form-group">
                  <label>Full name:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" name="cname" value="<?php echo $row['cname'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
            <div class="form-group">
                  <label>Phone:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                    </div>
                    <input type="text" name="cphone" value="<?php echo $row['cphone'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <label>Address:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" name="caddress" value="<?php echo $row['caddress'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                  <label>Email:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" name="cemail" value="<?php echo $row['cemail'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <!-- /.form group -->
                <div class="card-footer">
                  <button type="submit" name="updatecustomer" class="btn btn-success">Update Customer</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <?php
}
}









// Edit Availability details

if(isset($_GET['avid'])){

$db = getDB();
    $avid = $_GET['avid'];        
        
    $result = $db->prepare("SELECT * FROM Availability WHERE av_id = '$avid'");
$result->execute();
$stmp = $result->rowCount();
for($i=0; $row = $result->fetch(); $i++)
        
        {



          



                
            ?>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Availability Details</h3>
              </div>
              <div class="card-body">
                <form action="update.php" method="POST">
                

<input type="text" name="avid" value="<?php echo $row['av_id'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask hidden>
                <!-- Username -->
                <div class="form-group">
                  <label>Bus No:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" name="busno" value="<?php echo $row['bus_no'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
            <div class="form-group">
                  <label>Route:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                    </div>
                    <input type="text" name="route" value="<?php echo $row['route'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <label>Departure Date:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="date" name="departuredate" value="<?php echo $row['departuredate'];?>" class="form-control datepicker-input" required="" data-target="#reservationdate"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <!-- /.form group -->

                <div class="form-group">
                  <label>Time of Departure(24hr Format):</label>
                    <div class="input-group time" id="reservationtime" data-target-input="nearest">
                        <input type="time" name="departuretime" value="<?php echo $row['departuretime'];?>" class="form-control timepicker-input" required="" data-target="#reservationtime"/>
                        <div class="input-group-append" data-target="#reservationtime" data-toggle="timepicker">
                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                        </div>
                    </div>
                </div>
                <!-- /.form group -->


                
                <div class="form-group">
                  <label>Captain Name:</label>
                  <select class="form-control select2 select2-success" name="driver_id" data-dropdown-css-class="select2-primary" required="" style="width: 100%;" required="">
                    
  <?php
//include "connect.php";
  $driver =$row['driver_name'];
   $db = getDB();
$result1 = $db->prepare("SELECT * FROM driver WHERE fname='$driver'");
$result1->execute();
$row1 = $result1->fetch();
?>
    <option value="<?php echo $row1['d_id'];?>"selected="selected" ><?php echo $row1['fname'];?></option>
            
    <?php
$result2 = $db->prepare("SELECT * FROM driver WHERE status='Available'");
$result2->execute();
        for($i=0; $row2 = $result2->fetch(); $i++)
        
        {

echo  $bus = "<option value='".$row2['d_id']."' >". $row2['fname'] ."</option>";
}
?>
                  </select>
                </div>
                <!-- /.form group -->
                <div class="form-group">
                  <label>Terminal Destination:</label>
                  <select class="form-control select2 select2-success" name="terminal_destination" data-dropdown-css-class="select2-primary" required="" style="width: 100%;" required="">
                    
  <?php
//include "connect.php";
  $terminal_destination =$row['terminal_destination'];
   $db = getDB();
$result3 = $db->prepare("SELECT * FROM terminal WHERE tname='$terminal_destination'");
$result3->execute();
$row3 = $result3->fetch();
?>
    <option value="<?php echo $row1['t_id'];?>"selected="selected" ><?php echo $row3['tname'];?></option>
            
    <?php
$result4 = $db->prepare("SELECT * FROM terminal");
$result4->execute();
        for($i=0; $row4 = $result4->fetch(); $i++)
        
        {

echo  $term = "<option value='".$row4['t_id']."' >". $row4['tname'] ."</option>";
}
?>
                  </select>
                </div>
                <!-- /.form group -->

                <!-- /.form group -->
                <div class="card-footer">
                  <button type="submit" name="updateavailability" class="btn btn-success">Update Availability</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <?php
}
}else{


 //$nameErr="";
   //         $Error="";





        
                
            ?>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- /.card -->

          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
<?php
if (isset($_POST['changepassword'])) {

function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }

// Also check that our email address and password were passed along. If not, jump

        // down to our error message about providing both pieces of information.
$nameErr="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["old_pwd"])) {
                $nameErr = "<span style=\"color:red;\">Old Password is required </span>";
            }else {
               $old_pwd = test_input($_POST["old_pwd"]);
            }
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["pwd"])) {
                $nameErr = "<span style=\"color:red;\">New Password is required </span>";
            }else {
               $pwd = test_input($_POST["pwd"]);
            }
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["pwd_rep"])) {
                $nameErr = "<span style=\"color:red;\">New Password Repeat is required </span>";
            }else {
               $pwd_rep = test_input($_POST["pwd_rep"]);
            }
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["ad_id"])) {
                $nameErr = "<span style=\"color:red;\">Unknown Error </span>";
            }else {
               $ad_id = test_input($_POST["ad_id"]);
            }
 }

 // Connect to the database and select the user based on their provided username address.
  // Be sure to retrieve their password and any other information you want to save for the user session.
if($nameErr=="" && $pwd==$pwd_rep){

 $pdo = getDB();


 $stmt = $pdo->prepare("SELECT admin_id, username, password FROM admin WHERE username=:username AND admin_id=:admin_id");

  $stmt->bindParam(":username", $_SESSION['username'],PDO::PARAM_STR) ;
  $stmt->bindParam(":admin_id", $ad_id,PDO::PARAM_STR);
   $result = $stmt->execute();

   if (($result !==false) && ($stmt->rowCount())) {
    
    $row = $stmt->fetch();

     // If the user record was found, compare the password on record to the one provided hashed as necessary.
    $admin_id = $row['admin_id'];
    $password = $row['password'];

    $new_password = hash('sha256', $pwd); 
    $old_password = hash('sha256', $old_pwd);

if($password==$old_password){

 $stmt1 = $pdo->prepare("UPDATE admin 
                        SET password=:new_password
                        WHERE username=:username AND admin_id=:admin_id");

  $stmt1->bindParam(":username", $_SESSION['username'],PDO::PARAM_STR) ;
  $stmt1->bindParam(":new_password", $new_password,PDO::PARAM_STR) ;
  $stmt1->bindParam(":admin_id", $admin_id,PDO::PARAM_STR) ;
   $result = $stmt1->execute();



      ?>
      <script>
        alert('Password Changed Successfully...');
        window.location.href='../logout.php';
        </script>

<?php

                }
                else {
                    echo '<span style="color:red;">'.$error = ' old password incorrect. Please try again.'.'</span>';
                }
            }
            else {
                ?>
                <script>
        alert('User not Logged in Correctly...');
        window.location.href='../logout.php';
        </script>
        <?php
            }

        }else{
            echo '<span style="color:red;">'.$nameErr.' '.' --> Password and repeat password donot match'.'</span>';
        }
    }








$db = getDB();
        
        
    $result = $db->prepare("SELECT * FROM user WHERE username = '$_SESSION[username]'");
$result->execute();

$row = $result->fetch();
?>

              <div class="card-body">
                <form action="" method="POST">
                

<input type="text" name="ad_id" value="<?php echo $row['admin_id'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask hidden>
                <!-- Username -->
                <div class="form-group">
                  <label>Username:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="" value="<?php echo $row['username'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
            <div class="form-group">
                  <label>Fullname:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-book"></i></span>
                    </div>
                    <input type="text" name="route" value="<?php echo $row['fullname'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>


                <div class="form-group">
                  <label>Phone:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    </div>
                    <input type="text" name="route" value="<?php echo $row['phone'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <label>Email:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="text" name="route" value="<?php echo $row['email'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>



                <div class="form-group">
                  <label>Position:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-building-alt"></i></span>
                    </div>
                    <input type="text" name="route" value="<?php echo $row['position'];?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask readonly="">
                  </div>
                  <!-- /.input group -->
                </div>


                <div class="form-group">
                  <label>Old Password:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="password" name="old_pwd" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>


                <div class="form-group">
                  <label>New Password:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="password" name="pwd" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <label>Repeat New Password:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="password" name="pwd_rep" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>

                

                <!-- /.form group -->
                <div class="card-footer">
                  
                  <button type="submit" name="changepassword" class="btn btn-success">Change Password</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <?php
}

          ?>
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
