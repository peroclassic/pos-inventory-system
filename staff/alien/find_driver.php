<?php 
include_once('../../secure/connect.php');
$db = getDB();

$driver=$_REQUEST['driver'];


$result = $db->prepare("SELECT * FROM driver WHERE d_id='$driver'");
$result->execute();
$row = $result->fetch();

echo $drivername = $row['fname'];

?>
