<?php 
include_once('../../secure/connect.php');
$db = getDB();

$phonenumber=$_REQUEST['phonenumber'];


$result = $db->prepare("SELECT * FROM customer WHERE phone='$phonenumber'");
$result->execute();
$row = $result->fetch();

echo $fname = $row['fname'];
echo ' || ';
echo $NOKname = $row['NOKname'];
echo ' || ';
echo $NOKphone = $row['NOKphone'];


?>
