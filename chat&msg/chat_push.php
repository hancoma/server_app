<? 
$uid=$_POST['uid'];  
$chat_room_no=$_POST['chat_room_no'];  
$no=$_POST['no'];  
$to=$_POST['to'];  
	include "db_config.php";
	// 접속 시간 업데이트 
	$connect_time=time();

	// 접속 시간 채크 
	$check_time=@mysql_fetch_array(mysql_query("select * from chat_room_member  where uid=$uid and chat_room_no=$chat_room_no"));
	// 접속 시간 업데이트 
		 $query = "UPDATE chat_room_member SET connect_time='$connect_time'  WHERE no=$check_time[no]"; 
$result = mysql_query($query);
	  $Sql="select * from  chat_contents  WHERE no>$no and chat_room_no=$chat_room_no and reg_date >= $check_time[reg_date] order by no asc ";
      $rResult = mysql_query($Sql);
$R=mysql_fetch_array($rResult); 
$photo=@mysql_fetch_array(mysql_query("select * from rb_s_photo where memberuid=$R[uid] order by mark desc"));
if ($uid==$R[uid]) {
	$align="left";
} else {
	$align="right";
}
$member=@mysql_fetch_array(mysql_query("select * from rb_s_mbrdata where memberuid=$R[uid]"));
$contents=$R[contents];
?>
<?=$R[uid]?>/,/<?=$contents?>/,/<?=$R[no]?>/,/<?=$photo[photo]?>/,/<?=$align?>/,/<?=date("Y-m-d H:i:s",$R[reg_date])?>/,/<?=$member[nic]?>

