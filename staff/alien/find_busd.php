<?php 
include_once('../../secure/connect.php');
$db = getDB();

$busno=$_REQUEST['busno'];


$result = $db->prepare("SELECT * FROM bus WHERE busno='$busno'");
$result->execute();
$row = $result->fetch();

echo $model = $row['model'];
echo ' || ';
echo $totalseats = $row['avseats'];

?>
