<? 
$uid=$_POST['uid'];  
$uid2=$_POST['uid2'];  
$msg=$_POST['msg'];
$room_no=$_POST['room_no'];
	include "db_config.php";

$reg_date=time();
$_QKEY = "mail_room_no,my_uid,by_uid,contents,reg_date";
$_QVAL = "'$room_no','$uid','$uid2','$msg','$reg_date'";
 $query = "INSERT INTO mail_contents ($_QKEY) values ($_QVAL)"; 
$result = mysql_query($query);
 $query = "UPDATE mail_member SET last_msg='$msg',last_date='$reg_date'  WHERE mail_room_no=$room_no"; 
$result = mysql_query($query);
?><?= $query?>