<?php 
include_once('../../secure/connect.php');
$db = getDB();

$route=$_REQUEST['route'];


$result = $db->prepare("SELECT * FROM route WHERE r_id='$route'");
$result->execute();
$row = $result->fetch();

echo $model = $row['route'];
echo ' || ';
echo $totalseats = $row['amount'];

?>
