<?php
//Get our database abstraction file
require('../../secure/connect.php');

if (isset($_GET['search']) && $_GET['search'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['search'];
	$suggest_query = db_query("SELECT * FROM customer WHERE phone like('" .$search . "%') ORDER BY phone");
	while($suggest = db_fetch_array($suggest_query)) {
		echo '<a href=index.php?id2=' . $suggest['cust_id'] . '>' . $suggest['fname'] .' '. $suggest['phone'] . "</a>\n";
	}
}
?>