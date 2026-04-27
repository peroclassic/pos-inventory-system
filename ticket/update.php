<?php
include("../secure/connect.php");




//Admin Edit Process

if (isset($_POST['updateadminprofile'])) {

 $id = $_POST['id'];
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $phone = $_POST['phone']; 
 $terminal = $_POST['terminal'];      
 
 $db = getDB();
$sta=$db->prepare("UPDATE admin
                        SET fullname = '$fname', phone = '$phone', email='$email', terminal='$terminal' 
               WHERE admin_id = '$id'");
$sta->execute();
if($sta){    
?>

<script>
        alert('Admin Detail Successfully Updated...');
        window.location.href='admin.php';
        </script>
<?php 
}
}




// Terminal Edit Process

if (isset($_POST['updateterminal'])) {

 $tid = $_POST['tid'];
 $taddress = $_POST['taddress'];
 $tstate = $_POST['tstate'];
 $tcity = $_POST['tcity']; 
      
 
 $db = getDB();
$sta=$db->prepare("UPDATE terminal
                        SET tstate = '$tstate', tcity = '$tcity', taddress='$taddress' 
               WHERE t_id = '$tid'");
$sta->execute();
if($sta){    
?>

<script>
        alert('Terminal Detail Successfully Updated...');
        window.location.href='terminal.php';
        </script>
<?php 
}
}




// Vehicle Edit Process

if (isset($_POST['updatebus'])) {

 $bid = $_POST['bid'];
 $busno = $_POST['busno'];
 $model = $_POST['model'];
 $avseats = $_POST['avseats']; 
 $terminal_name = $_POST['terminal_name'];
      
 
 $db = getDB();
$sta=$db->prepare("UPDATE bus
                        SET model = '$model', avseats = '$avseats', terminal_name='$terminal_name' 
               WHERE bus_id = '$bid'");
$sta->execute();
if($sta){    
?>

<script>
        alert('Vehicle Detail Successfully Updated...');
        window.location.href='bus.php';
        </script>
<?php 
}
}





// Captain Edit Process

if (isset($_POST['updatecaptain'])) {

 $did = $_POST['did'];
 $fname = $_POST['fname'];
 $phone = $_POST['phone'];
      
 
 $db = getDB();
$sta=$db->prepare("UPDATE driver
                        SET fname = '$fname', phone = '$phone' 
               WHERE d_id = '$did'");
$sta->execute();
if($sta){    
?>

<script>
        alert('Captain Detail Successfully Updated...');
        window.location.href='driver.php';
        </script>
<?php 
}
}





// Route Edit Process

if (isset($_POST['updateroute'])) {

 $rid = $_POST['rid'];
 $route = $_POST['route'];
 $amount = $_POST['amount'];
      
 
 $db = getDB();
$sta=$db->prepare("UPDATE route
                        SET route = '$route', amount = '$amount' 
               WHERE r_id = '$rid'");
$sta->execute();
if($sta){    
?>

<script>
        alert('Route Detail Successfully Updated...');
        window.location.href='route.php';
        </script>
<?php 
}
}





// Customer Edit Process

if (isset($_POST['updatecustomer'])) {

 $cid = $_POST['cid'];
 $fname = $_POST['fname'];
 $NOKname = $_POST['NOKname'];
 $NOKphone = $_POST['NOKphone'];
      
 
 $db = getDB();
$sta=$db->prepare("UPDATE customer
                        SET fname = '$fname', NOKname = '$NOKname', NOKphone = '$NOKphone' 
               WHERE cust_id = '$cid'");
$sta->execute();
if($sta){    
?>

<script>
        alert('Customer Detail Successfully Updated...');
        window.location.href='customer.php';
        </script>
<?php 
}
}





// Availability Edit Process

if (isset($_POST['updateavailability'])) {

 $avid = $_POST['avid'];
 $departuredate = $_POST['departuredate'];
 $departuretime = $_POST['departuretime'];
 $driver_id = $_POST['driver_id'];
      
 
 $db = getDB();
 
$result1 = $db->prepare("SELECT * FROM driver WHERE d_id='$driver_id'");
$result1->execute();
$row1 = $result1->fetch();

$driver_name = $row1['fname'];



$sta=$db->prepare("UPDATE Availability
                        SET departuredate = '$departuredate', departuretime = '$departuretime', driver_name = '$driver_name' 
               WHERE av_id = '$avid'");
$sta->execute();
if($sta){    
?>

<script>
        alert('Availability Detail Successfully Updated...');
        window.location.href='availability.php';
        </script>
<?php 
}
}
?>