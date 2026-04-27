<?php 
include_once('../../secure/connect.php');
$db = getDB();

$bus=$_REQUEST['bus'];


$result = $db->prepare("SELECT * FROM availability WHERE route_id='$bus'");
$result->execute();
$row = $result->fetch();

echo $model = $row['bus_no'];


?>
