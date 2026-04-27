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

$errorMsgReg=''; $usernameErr = ''; $passwordErr= '';
$fnameErr = ""; $emailErr = ""; $phoneErr = "";

$username = $password = $fname = $email = $phone = "";

function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }


if (isset($_POST['create'])) {
  # code...


 if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["username"])) {
               echo $usernameErr = "<span style=\"color:red;\">Username is required</span>";
            }else {
               $username = test_input($_POST["username"]);
            }
 }

 
 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["password"])) {
             echo $passwordErr = "<span style=\"color:red;\">Password cannot be Empty</span>";
            }else {
               $password = test_input($_POST["password"]);
            }
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["fname"])) {
               echo $fnameErr = "<span style=\"color:red;\">Fullname is required</span>";
            }else {
               $fname = test_input($_POST["fname"]);
            }
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["email"])) {
               echo $emailErr = "<span style=\"color:red;\">Email is required</span>";
            }else {
               $email = test_input($_POST["email"]);
            }
  }

 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["phone"])) {
               echo $phoneErr = "<span style=\"color:red;\">Phone is required</span>";
            }else {
               $phone = test_input($_POST["phone"]);
            }
 }

$terminal = $_POST['terminal'];
$recovery_id = $_POST['recovery_id'] = $rand;
$now= $_POST['now'] = date('Y-m-d H:i:s');
$position= $_POST['position'] = 'Ticket Admin';
$permission= $_POST['permission'] = 1;
$ban= $_POST['ban'] = 0;

  # code...

    $uid=$userClass->userRegistration($username, $password, $fname, $phone, $email, $terminal, $recovery_id, $now, $position, $permission, $ban);
    if($uid)
    {
      $message= 'Dear '. $fname .'.CONGRATULATIONS you have just being registered on the NIS Transport platform as a Ticket Administrator with username: '. $username .' and password: '. $password .' - Your login link is www.office.surveyorsbus.com . Please disregard this mail if you are not a staff of the organisation.';

$subject='CONGRATULATIONS!!! SURVEYORS BUS REGISTRATION';

$email2='info@surveyorsbus.com';
 
 $headers = 'From:'. $email2 . "\r\n"; // Sender's Email
 $headers .= 'Cc:'. $email2 . "\r\n"; // Carbon copy to Sender

 // message lines should not exceed 70 characters (PHP rule), so wrap it
 $message = wordwrap($message, 250);

 // Send mail by PHP Mail Function
 mail($email, $subject, $message, $headers);
 


      ?>
      <script>
        alert('New Admin Successfully created, ask new admin to check email for login details ...');
        window.location.href='admin.php';
        </script>
    <?php
    }
    else
    {
      echo $errorMsgReg="<span style=\"color:red;\">Username already exist.</span>";
    }

   } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NIS Transport | Admin</title>

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
      <img src="../dist/img/AdminLTELogo2.png" alt="NIS Mass Transit Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-dark">NIS Mass Transit</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="edit.php" class="d-block">Terminal Admin<br/>[<span style="color: red;"><?php echo $_SESSION['username'];?></span>]</a>
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
            <a href="admin.php" class="nav-link active">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Admins
              </p>
            </a>
          </li>
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
          <li class="nav-item">
            <a href="driver.php" class="nav-link">
              <i class="nav-icon fas fa-hands"></i>
              <p>
                Captain
              </p>
            </a>
          </li>
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
          <li class="nav-item">
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
              <li class="breadcrumb-item active">Admin</li>
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
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Add New Admin</h3>
              </div>
              <div class="card-body">
                <form action="" method="POST">
                <!-- Username -->
                <div class="form-group">
                  <label>Username:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa--alt">@</i></span>
                    </div>
                    <input type="text" name="username" class="form-control" data-inputmask-alias="username" data-inputmask-inputformat="text" data-mask required="">
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
                    <input type="text" name="fname" class="form-control" data-inputmask-alias="fullname" data-inputmask-inputformat="text" data-mask>
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
                    <input type="email" name="email" class="form-control" data-inputmask-alias="email" data-inputmask-inputformat="email" data-mask required="">
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
                    <input type="text" name="phone" class="form-control"
                           data-inputmask="" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
            
                <div class="form-group">
                  <label>Terminal Station:</label>
                  <select class="form-control select2 select2-success" name="terminal" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    <option selected="selected"></option>
                    <?php
//include "connect.php";
   $db = getDB();
$result = $db->prepare("SELECT * FROM terminal");
$result->execute();
    
            
        for($i=0; $row = $result->fetch(); $i++)
        
        {

echo  $terminal = "<option value='".$row['tname']."' >". $row['tname'] .' ---> '. $row['tmanager']. "</option>";
}
?>
                  </select>
                </div>
                <!-- /.form-group -->
             
                <!-- IP mask -->
                <div class="form-group">
                  <label>Password:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" data-inputmask="'alias': 'password'" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="card-footer">
                  <button type="submit" name="create" class="btn btn-success">Create Admin</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
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
                    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Registered Admin Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Terminal</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                
                $db = getDB();
$result = $db->prepare("SELECT * FROM admin");
                
                $result->execute();
                for($i=1; $row = $result->fetch(); $i++){

            ?>
                  <tr>
                    <td><?php echo $row['admin_id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['terminal']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td><?php  $banned = $row['ban'];
                     if($banned==0){ echo 'Active';}else{
                      echo 'Banned';}  ?></td>
                    <td class="text-center"><a href="#" title="Edit"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a> &ensp; <a href="#" title="Delete"><i class="fa fa-trash-alt"></i></a>
                            </td>
                  </tr>
                  <?php
                  }
                  ?>
                    </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Terminal</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
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
