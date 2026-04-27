<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
	$url='index.php';

header("Refresh:3, $url"); // Redirecting To Home Page
echo "Wait Logging you out in 3 Seconds";
}
?>
