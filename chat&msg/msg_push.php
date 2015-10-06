<? 
$uid=$_POST['uid'];  
$uid2=$_POST['uid2'];  
$no=$_POST['no'];  
$to=$_POST['to'];
$room_no=$_POST['room_no'];  
	include "db_config.php";
	  $Sql="select * from  mail_contents WHERE no>$no and mail_room_no=$room_no";
	

      $rResult = mysql_query($Sql);
$R=mysql_fetch_array($rResult); 
$photo=@mysql_fetch_array(mysql_query("select * from rb_s_photo where memberuid=$R[my_uid] order by mark desc"));
if ($uid==$R[my_uid]) {
	$align="left";
} else {
	$align="right";
}
$member=@mysql_fetch_array(mysql_query("select * from rb_s_mbrdata where memberuid=$R[my_uid]"));
$R[contents]=$R[contents];
$R[contents]=str_replace('"', "", $R[contents]);
?>
<?=$R[my_uid]?>/,/<?=$R[contents]?>/,/<?=$R[no]?>/,/<?=$photo[photo]?>/,/<?=$align?>/,/<?=date("Y-m-d H:i:s",$R[reg_date])?>/,/<?=$member[nic]?>



