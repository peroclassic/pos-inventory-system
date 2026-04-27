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
                $nameErr = "<span style=\"color:red;\">Username is required </span>";
            }else {
               $username = test_input($_POST["username"]);
            }
 }


 // Connect to the database and select the user based on their provided username address.
  // Be sure to retrieve their password and any other information you want to save for the user session.
if($nameErr==""){

include("secure/connect.php");
require_once('secure/library.php');
$rand = get_rand_id(8);
$rand;
 $pdo = getDB();


 $stmt = $pdo->prepare("SELECT uid, username, fullname, email, reset_key FROM user WHERE username=:username");

  $stmt->bindParam(":username", $username,PDO::PARAM_STR) ;
   $result = $stmt->execute();

   if (($result !==false) && ($stmt->rowCount())) {
    
    $row = $stmt->fetch();

     // If the user record was found, collect necessary information, and send reset key to email.
        $uid = $row['uid'];
        $fullname = $row['fullname'];
        $email = $row['email'];
        $resetkey = $row['reset_key'];

        $hash_password= hash('sha256', $resetkey);

        $smmt = $pdo->prepare("UPDATE user SET password='$hash_password', reset_key='$rand' WHERE uid='$uid' AND username='$username'");  
    $smmt->execute();

if($smmt){
      $message= 'Dear '. $fullname .'.CONGRATULATIONS your password have being reset Successfully on the Demo Retail System platform, your new password is -> password: '. $resetkey .' - Your login link is www.brightelectricals.com . Login and change your password immediately to a new password. Please disregard this mail and contact your office administrator immediately if you did not initiate a password reset.';

$subject='SUCCESSFUL!!! Demo Retail System PASSWORD RESET';

$email2='info@brightelectricals.com';
 
 $headers = 'From:'. $email2 . "\r\n"; // Sender's Email
 $headers .= 'Cc:'. $email2 . "\r\n"; // Carbon copy to Sender

 // message lines should not exceed 70 characters (PHP rule), so wrap it
 $message = wordwrap($message, 250);

 // Send mail by PHP Mail Function
 mail($email, $subject, $message, $headers);
 


      ?>
      <script>
        alert('Password Reset Successful, check email for password reset information...');
        window.location.href='index.php';
        </script>
    <?php
}

                }
                else {
                    $error = "Invalid Username. Please try again.";
                }

        }else{

           $nameErr;
        }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Demo Retail System | Forgot Password</title>

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
    <a href="index.php"><img src="dist/img/logo.jpg"  alt="Demo Retail System Logo">
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily reset your password.</p>
<span style="color:red;"><?php echo $error; ?></span>
<span style="color:red;"><?php echo $nameErr; ?></span>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-success btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="index.php">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
