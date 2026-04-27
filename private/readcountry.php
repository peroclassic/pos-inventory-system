<?php
require_once("alien/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM customer WHERE cphone like '" . $_POST["keyword"] . "%' ORDER BY cphone LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectCustomer('<?php echo $country["cphone"].' || '.$country["cname"].' || '.$country["caddress"].' || '.$country["cemail"]; ?>');"><?php echo $country["cphone"]; ?></li>
<?php 
} ?>
</ul>
<?php } } ?>