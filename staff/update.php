<?php
//error_reporting( ~E_NOTICE ); // avoid notice
session_start();

include("../secure/connect.php");




//Admin Edit Process

if (isset($_POST['updateadminprofile'])) {

 $id = $_POST['id'];
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $phone = $_POST['phone']; 
 $position = $_POST['position'];
 if($position=='Super Admin'){

$permission= $_POST['permission'] = 3;

}elseif ($position=='Staff Admin') {

  $permission= $_POST['permission'] = 2;

}elseif ($position=='Stock Admin') {

$permission= $_POST['permission'] = 1;

}else{

$permission= $_POST['permission'] = 0;

}      
 
 $db = getDB();
$sta=$db->prepare("UPDATE user
                        SET fullname = '$fname', phone = '$phone', email='$email', position='$position', permission='$permission' 
               WHERE uid = '$id'");
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





// Product Edit Process

if (isset($_POST['updateproduct'])) {

 $pid = $_POST['pid'];
 $pname = $_POST['pname'];
 $pdesc = $_POST['pdesc'];
 $saleprice = $_POST['saleprice'];
 $dateupdated= $_POST['dateupdated'] = date('Y-m-d H:i:s');
$remark= $_POST['remark'] = 'updated by '.' '.$_SESSION['username'];
     
 
 $db = getDB();
$sta=$db->prepare("UPDATE product
                        SET pname = '$pname', pdesc = '$pdesc', saleprice = '$saleprice', dateupdated = '$dateupdated', updatedby = '$remark' 
               WHERE pid = '$pid'");
$sta->execute();
if($sta){    
?>

<script>
        alert('Product Detail Successfully Updated...');
        window.location.href='product.php';
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
 $cname = $_POST['cname'];
 $caddress = $_POST['caddress'];
 $cemail = $_POST['cemail'];
      
 
 $db = getDB();
$sta=$db->prepare("UPDATE customer
                        SET cname = '$cname', caddress = '$caddress', cemail = '$cemail' 
               WHERE cid = '$cid'");
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
 $terminald_id = $_POST['terminal_destination'];
 
 $db = getDB();
 
$result1 = $db->prepare("SELECT * FROM driver WHERE d_id='$driver_id'");
$result1->execute();
$row1 = $result1->fetch();

$driver_name = $row1['fname'];


$result2 = $db->prepare("SELECT * FROM terminal WHERE t_id='$terminald_id'");
$result2->execute();
$row2 = $result2->fetch();

$terminal_destination = $row2['tname'];



$sta=$db->prepare("UPDATE Availability
                        SET departuredate = '$departuredate', departuretime = '$departuretime', driver_name = '$driver_name', terminal_destination = '$terminal_destination' 
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