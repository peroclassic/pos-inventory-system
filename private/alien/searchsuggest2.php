<?php
//Get our database abstraction file
require('database.php');

if (isset($_GET['searchs']) && $_GET['searchs'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['searchs'];
	$suggest_query = db_query("SELECT * FROM customer WHERE phone like('" .$search . "%') ORDER BY phone LIMIT 5");
	while($suggest = db_fetch_array($suggest_query)) {
		echo '<a href=index.php?id=' . $suggest['cust_id'] . '>' . $suggest['phone'] . "</a>\n";
	}
}
?>