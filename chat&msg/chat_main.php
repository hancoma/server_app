<p style="height:30px; width:100%; background-color:#DEF2FE; color:#061E44; font-size:12px; line-height:30px; text-align:left;">
<span style="margin-left:10px;">HOME / MYPAGE / <? menu_data($table['pridebbs_menu_data'],$language_code,'Message List');?></span>
</p><link href="chat.css" rel="stylesheet">
<div id="chat_main_div">


	
	<? 
$uid=$my[uid];  

	  $Sql="select * from  mail_contents WHERE my_uid=$uid group by mail_room_no order by no desc ";
      $rResult = mysql_query($Sql);

while($R=mysql_fetch_array($rResult)) 
{
$member2=@mysql_fetch_array(mysql_query("select * from mail_member  where mail_room_no=$R[mail_room_no] and uid<>$uid "));
	$uid2=$member2[uid];

	$member=@mysql_fetch_array(mysql_query("select * from rb_s_mbrdata where memberuid=$uid2"));

$photo=@mysql_fetch_array(mysql_query("select * from rb_s_photo where memberuid=$uid2 order by mark desc"));

if ($uid2) {
 ?><a href="/?mod=mail_chat&uid=<?=$uid2?>">
 <div class="uk-grid uk-grid-divider">
 <div class="uk-width-1-10 uk-text-center">
 </div>
    <div class="uk-width-2-10 uk-text-center"><img src="<?=$basic_url?>/image.php?width=80&height=80&image=/_var/photo/<?=$photo[photo]?>" style="width:80px; height:80px; border:1px #dedede solid;"></div>
    <div class="uk-width-6-10 ">
<div class="uk-panel   uk-panel-hover">
    <div class="uk-panel-badge uk-badge">    <?=date("Y-m-d",$R[reg_date])?></div>
    <h3 class="uk-panel-title uk-text-success"><?=$member[nic]?></h3>
    <?=$R[contents]?>
</div>

 </div>

</div>
<hr class="uk-grid-divider">
</a>
 <?
 
 }
  } ?>


</div>