<?php

include_once '../../secure/connect.php';
$db = getDB();

$bus_no=$_POST["vehicle_id"];

if(!empty($_POST["vehicle_id"])){

//$timeav_id=$_POST["time_id"];
$bus_no=$_POST["vehicle_id"];

$db = getDB();
$result3 = $db->prepare("SELECT * FROM availability WHERE bus_no='$bus_no' AND status='Available' ORDER BY departuretime ASC");
$result3->execute();
$row3 = $result3->fetch();

$av_id = $row3['av_id'];
$route_id = $row3['route_id'];

$result4 = $db->prepare("SELECT seat_no FROM booking WHERE availability_id='$av_id' AND booking_id='$bus_no' AND route_id='$route_id' ORDER BY seat_no ASC");
$result4->execute();


while($row4=$result4->fetch()){
 $seat_no[] = $row4['seat_no'];
 //."||";
 

}
echo $seat = implode(", ", $seat_no);
}



















/*$bus_no=$_REQUEST['busno'];


$result3 = $db->prepare("SELECT * FROM availability WHERE bus_no='$bus_no' AND status='Available' ");
$result3->execute();
$row3 = $result3->fetch();

$av_id = $row3['av_id'];
$route_id = $row3['route_id'];

$result4 = $db->prepare("SELECT * FROM booking WHERE availability_id='$av_id' AND booking_id='$bus_no' AND route_id='$route_id' ORDER BY seat_no ASC");
$result4->execute();

//while(
	$row4=$result4->fetch();
//){
*/
/*$callback = array(
	'status' => 'success',
	'seat_no' => $row4['seat_no']); */

//echo $seatno =$row4['seat_no'];
/*echo $seat_no = $row4['seat_no'];
echo ' || ';
echo $tt = $row4['route_id'];*/
//}

//}

?>