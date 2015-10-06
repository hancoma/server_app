<?
$reg_id=$_POST['reg_id'];
$deviceid=$_POST['deviceid'];
?>
<? 
include "db_config.php";
 $query = "UPDATE rb_s_mbrdata SET  reg_id='$reg_id' WHERE deviceid='$deviceid'"; 
$result = mysql_query($query);
?>
