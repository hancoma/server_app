<? 
$uid=$_POST['uid'];  
$chat_room_no=$_POST['chat_room_no'];  
$msg=$_POST['msg'];
	include "db_config.php";
	$reg_date=time();
$d_read=date("Ymdhis");
$_QKEY = "uid,contents,chat_room_no,reg_date";
$_QVAL = "'$uid','$msg','$chat_room_no','$reg_date'";
 $query = "INSERT INTO chat_contents ($_QKEY) values ($_QVAL)"; 
$result = mysql_query($query);
?>

