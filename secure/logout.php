<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
	$url='../login.php';

header("Refresh:3, $url"); // Redirecting To Home Page
echo "Wait Redirecting in 3 Seconds";
}
?>
