<?php
require_once("alien/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM product WHERE pname like '" . $_POST["keyword"] . "%' ORDER BY pname LIMIT 0,6";
$result = $db_handle->runQuery($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectCountry('<?php echo $country["pname"].' || '.$country["pcode"].' || '.$country["saleprice"].' || '.$country["pid"].' || '.$country["pleft"]; ?>');"><?php echo $country["pname"]; ?></li>
<?php 
} ?>
</ul>
<?php } } ?>