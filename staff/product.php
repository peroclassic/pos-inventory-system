<?php

//error_reporting( ~E_NOTICE ); // avoid notice
session_start();

$adminname = $_SESSION['username'];

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

if($_SESSION['permission'] < 2){ 

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

$errorMsgReg=''; $pnameErr = ''; $salepriceErr= '';

$pname = $saleprice = "";

function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }


if (isset($_POST['create'])) {
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
             echo $salepriceErr = "<span style=\"color:red;\">Sales Price cannot be Empty</span>";
            }else {
               $saleprice = test_input($_POST["saleprice"]);
            }
  }
$pcode = $_POST['pcode'];
$pdesc = $_POST['pdesc'];
$datecreated= $_POST['datecreated'] = date('Y-m-d H:i:s');
$remark= $_POST['remark'] = 'created by '.' '.$adminname;


  # code...

    $pid=$userClass->addProduct($pcode, $pname, $pdesc, $saleprice, $datecreated, $remark);
    if($pid)
    {
      
      ?>
      <script>
        alert('New Product Added Successfully, Click OK to continue...');
        window.location.href='product.php';
        </script>
    <?php
    }
    else
    {
      echo $errorMsgReg="<span style=\"color:red;\">Product already exists.</span>";
    }

   } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Demo Retail System | Product</title>

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
        <a href="dashboard.php" class="nav-link">Home</a>
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
          <a href="edit.php" class="d-block">Staff Admin<br/>[<span style="color: red;"><?php echo $_SESSION['username'];?></span>]</a>
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
            <a href="salesummary.php" class="nav-link">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>
                Sale Summary
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="product.php" class="nav-link active">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Product
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
            <h1 class="m-0">Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
          <section class="col-lg-8 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">List of Registered Products</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Desc </th>
                    <th>Product Sold</th>
                    <th>Product Left</th>
                    <th>Sales Price</th>
                    <th>Date Updated</th>
                    <th>Updated by</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php
                
                $db = getDB();
$result = $db->prepare("SELECT * FROM product");
                
                $result->execute();
                for($i=1; $row = $result->fetch(); $i++){

            ?>
                  <tr>
                    <td><?php echo $row['pcode']; ?></td>
                    <td><?php echo $row['pname']; ?></td>
                    <td><?php echo $row['pdesc']; ?></td>
                    <td><?php echo $row['psold']; ?></td>
                    <td><?php echo $row['pleft']; ?></td>
                    <td><?php echo number_format($row['saleprice']); ?></td>
                    <td><?php echo $row['dateupdated']; ?></td>
                    <td><?php echo $row['updatedby']; ?></td>
                    <td class="text-center"><a href="edit.php?pid=<?php echo $row['pid']; ?>" title="Edit"><button class="btn btn-info"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button></a> 
                      <!--<form method="POST" action="">
                      <input type="text" name="pid" value="<?php //echo $row['pid']; ?>" hidden>
                      <button class="btn btn-danger" title="Delete" type="submit" name="delete"><i class="fa fa-trash-alt"></i></button>
                    </form>--></td>
                  </tr>
                  <?php
                }


                if (isset($_POST['delete'])) {

 $pid = $_POST['pid'];
 
 $db = getDB();
$sta=$db->prepare("DELETE FROM product
               WHERE pid = '$pid'");
$sta->execute();
if($sta){    
?>

<script>
        alert('Product Successfully Deleted...');
        window.location.href='product.php';
        </script>
<?php 
}
}
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Desc </th>
                    <th>Product Sold</th>
                    <th>Product Left</th>
                    <th>Sales Price</th>
                    <th>Date Updated</th>
                    <th>Updated by</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-4 connectedSortable">

            
          <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Add New Product</h3>
              </div>
              <div class="card-body">
                <form action="" method="POST">
                <!-- product code -->
                <div class="form-group">
                  <label>Product Code:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user-secret"></i></span>
                    </div>
                    <input type="text" name="pcode" value="<?php echo $rand;?>" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="" readonly="" >
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- Product name -->
                <div class="form-group">
                  <label>Product Name:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-pen-square"></i></span>
                    </div>
                    <input type="text" name="pname" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <!-- Product Desc -->
                <div class="form-group">
                  <label>Product Desc:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
                    </div>
                    <textarea name="pdesc" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text">  
                    </textarea>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
            <div class="form-group">
                  <label>Sale Price:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-tags"></i></span>
                    </div>
                    <input type="number" name="saleprice" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="number" data-mask required="">
                  </div>
                  <!-- /.input group -->
                </div>

                <!-- /.form group -->
                <div class="card-footer">
                  <button type="submit" name="create" class="btn btn-success" disabled>Add Product</button>
                </div>
              </form>
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
