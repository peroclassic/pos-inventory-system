<?php
session_start();

$error = "";
$nameErr="";
 // First start a session. This should be right at the top of your login page.



 // Check to see if this run of the script was caused by our login submit button being clicked.

if (isset($_POST['submit'])) {

function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }

// Also check that our email address and password were passed along. If not, jump

        // down to our error message about providing both pieces of information.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["username"])) {
                $nameErr = "<span style=\"color:red;\">Username and Password is required </span>";
            }else {
               $username = test_input($_POST["username"]);
            }
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["password"])) {
                $nameErr = "<span style=\"color:red;\">Username and Password is required </span>";
            }else {
               $password = test_input($_POST["password"]);
            }
 }


 // Connect to the database and select the user based on their provided username address.
  // Be sure to retrieve their password and any other information you want to save for the user session.
if($nameErr==""){

include("secure/connect.php");
 $pdo = getDB();


 $stmt = $pdo->prepare("SELECT uid, username, password, permission, ban FROM user WHERE username=:username");

  $stmt->bindParam(":username", $username,PDO::PARAM_STR) ;
   $result = $stmt->execute();

   if (($result !==false) && ($stmt->rowCount())) {
    
    $row = $stmt->fetch();

     // If the user record was found, compare the password on record to the one provided hashed as necessary.

    if ($row['password'] == hash('sha256', $password)) {


             // is_auth is important here because we will test this to make sure they can view other pages
                    // that are needing credentials.
                    $_SESSION['is_auth'] = true;
                    $_SESSION['uid'] = $row['uid'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['permission'] = $row['permission'];
                    $_SESSION['ban'] = $row['ban'];
                    
             // Once the sessions variables have been set, redirect them to the landing page / home page.

//if a user has been banned take the following action.
                  if($_SESSION['ban'] == 1){ 

        ?>
                          <script>
        alert('Your Account has been Suspended, for complains or plea to unsuspend your account, contact your Branch Manager');
        window.location.href='index.php';
        </script>

<?php
    }else{

      if($_SESSION['permission'] == 3){

                    header('location:private/index.php');
                    exit;
           }elseif ($_SESSION['permission'] == 2) {
              header('location:staff/index.php');
                    exit;
           }else{
            header('location:ticket/index.php');
                    exit;
           }
                  }
                }
                else {
                    $error = "Invalid password. Please try again.";
                }
            }
            else {
                $error = "Invalid username. Please try again.";
            }

        }else{
        }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Demo Retail Systems | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><img src="dist/img/Logo.jpg"  alt="Demo Retail System Logo">
    </a>
    <h3>Demo Retail System</h3>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
<span style="color:red;"><?php  echo $error. $nameErr; ?></span>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-success btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot.php">I forgot my password</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
