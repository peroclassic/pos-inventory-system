<?php 
include_once('../../secure/connect.php');
$db = getDB();

$busnumber=$_REQUEST['busnumber'];


$result = $db->prepare("SELECT * FROM bus WHERE busno='$busnumber' AND terminal_name='$terminalnname'");
$result->execute();
$row = $result->fetch();

echo $model = $row['model'];
echo '||';
echo $totalseats = $row['avseats'];
echo '||';
echo $terminal = $row['terminal_name'];
echo '||';
echo $terminal = $row['driver'];

?>
