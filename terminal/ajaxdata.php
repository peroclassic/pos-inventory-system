<?php
session_start();
$adminname = $_SESSION['username'];
$terminalname = $_SESSION['terminal'];
include_once '../secure/connect.php';

//$route=$_POST["route_id"];
//$Vehicle=$_POST["vehicle_id"];
//$timeav_id=$_POST["time_id"];

if(!empty($_POST["route_id"])){
$route=$_POST["route_id"];
$db = getDB();
$result = $db->prepare("SELECT * FROM availability WHERE route_id='$route' AND status='Available' AND terminal_name = '$terminalname' ORDER BY departuretime ASC");
$result->execute();
//$row = $result->fetch();
$rowc = $result->rowcount();
if($rowc>0){
	
	echo '<option value="">Select Bus</option>';
	//for($i=0; $i<$rowc; $i++){
		
		for($i=1; $row = $result->fetch(); $i++){
	echo'<option value="'.$row['bus_no'].'">'.$row['bus_no'].' - '.$row['departuredate'].'('.$row['departuretime'].')'.'</option>';
	}

}else {
	echo '<option value="">Vehicle not available</option>';
}
}elseif (!empty($_POST["vehicle_id"])) {
$Vehicle=$_POST["vehicle_id"];
$db = getDB();
$result = $db->prepare("SELECT * FROM availability WHERE bus_no='$Vehicle' AND status='Available' ORDER BY departuretime ASC");
$result->execute();
$row = $result->fetch();

if($row>0){
	echo '<option value="">Select availability</option>';
	echo'<option selected="selected" value="'.$row['av_id'].'">'.$row['av_id'].'</option>';
	

}else {
	echo '<option value="">availability not available</option>';
}
}elseif(!empty($_POST["vehicle_id2"])){

//$timeav_id=$_POST["time_id"];
$bus_no=$_POST["vehicle_id2"];

$db = getDB();
$result3 = $db->prepare("SELECT * FROM availability WHERE bus_no='$bus_no' AND status='Available' ORDER BY departuretime ASC");
$result3->execute();
$row3 = $result3->fetch();

$av_id = $row3['av_id'];
$route_id = $row3['route_id'];

$result4 = $db->prepare("SELECT seat_no FROM booking WHERE availability_id='$av_id' AND booking_id='$bus_no' AND route_id='$route_id' ORDER BY seat_no ASC");
$result4->execute();

while($row4=$result4->fetch()){

/*$callback = array(
	'status' => 'success',
	'seat_no' => $row4['seat_no']); */

//echo $seatno =$row4['seat_no'];
echo $seat_no = $row4['seat_no'].",";
}

}











?>