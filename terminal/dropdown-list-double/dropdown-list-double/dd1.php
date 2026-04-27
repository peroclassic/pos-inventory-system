<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>plus2net demo scripts using JQuery</title>
</head>
<script src="../../../plugins/jquery/jquery.min.js"></script>
<body>
<script>
$(document).ready(function() {
////////////
$('#t1').hide();
$('#category').change(function(){
//var st=$('#category option:selected').text();
var cat_id=$('#category').val();
$('#sub-category').empty(); //remove all existing options
///////
$.get('dd1ck.php',{'cat_id':cat_id},function(return_data){
$('#msg').text(" Number of Records found :"+return_data.no_of_records);
if(return_data.no_of_records>=1){
$.each(return_data.data, function(key,value){
		$("#sub-category").append("<option value=" + value.subcat_id +">"+value.subcategory+"</option>");
	});
}else{
/// add text box and hide 2nd subcategory 
$('#sub-category').hide();
$('#t1').show();
}
}, "json");
///////
});
/////////////////////
});
</script>
<div id=msg> &nbsp;</div><br><br>
<form method=post action=dd-submit.php>
<select name=category id=category>
<option value='' selected>Select</option>
<?Php
require "config.php";// connection to database 
$sql="SELECT * FROM route"; // Query to collect data 

foreach ($dbo->query($sql) as $row) {
echo "<option value=$row[r_id]>$row[route]</option>";
}
?>
</select>
<select name=sub-category id=sub-category>
</select> <input type=text name=t1 id=t1>
<input type=submit value=Submit></form>
</body>
</html>
