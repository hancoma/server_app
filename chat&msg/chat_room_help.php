<?	
	$photo2=@mysql_fetch_array(mysql_query("select * from rb_s_photo where memberuid=$memberuid order by mark desc"));
	
?>

<p id="sub_title">
<span style="margin-left:10px;">HOME / HOPE CHAT</span>
</p>
<table><tr><td>
<link href="chat.css" rel="stylesheet">
  <script type="text/javascript" src="js/chat_pc.js"></script>
<div class="ink-grid bg-color ">
     <div class="column-group">
            <label for="name"><? menu_data($table['pridebbs_menu_data'],$language_code,'Create a chat room');?></label>

<div class="ink-button all-100 bg-margin">
<select name="list_subject" class="select" onchange='list_subject_change(this.options[this.selectedIndex].value)' id="list_subject">
        <option value=""><? menu_data($table['pridebbs_menu_data'],$language_code,'Please select');?></option>
    <?
	    $Sql_chat="select * from  menu_job  order by uid asc";

      $rResult_chat = mysql_query($Sql_chat);

while($R_chat=mysql_fetch_array($rResult_chat)) 
{
?>
   <option value="<?=$R_chat[code]?>"><?=$R_chat[$language_code]?></option>
    <? } ?>
    </select>
    </div>
      </div>

    </div>
   </td></tr><tr><td>
			<?
 $num_per_page=10;
 $start_num=0;
 if ($page>=2) {
 	$start_num=($page-1)*$num_per_page;
 }
 ?>
				<? 
$uid=$memberuid;  

if ($sub_code) {
	  $Sql="select * from  rb_s_chat_room where room_kind=2 and sub_code='$sub_code' order by uid desc limit $start_num,$num_per_page";
} else {
	  $Sql="select * from  rb_s_chat_room where room_kind=2 order by uid desc limit $start_num,$num_per_page";
}
      $rResult = mysql_query($Sql);

while($R=mysql_fetch_array($rResult)) 
{
$member=@mysql_fetch_array(mysql_query("select * from rb_s_mbrdata where memberuid=$R[my_mbruid]"));
$photo=@mysql_fetch_array(mysql_query("select * from rb_s_photo where memberuid=$R[my_mbruid] order by mark desc"));
?><a href="/?mod=chat_room2&no=<?=$R[uid]?>">
<table id="chat_room_info_table"><tr><td>
<img src="<?=$basic_url?>/profile_icon/icon_<?=$photo[photo]?>"></td><td>
<ul id="chat_room_info">
    <li  id='room_room_title'><? menu_data("menu_job",$language_code,$R[content]);?></li>
    <li  id='room_room_title2'>Profile : <?=$member[nic]?> <?=$member[height]?>Cm <?=$member[kg]?>Kg <?=$member[age]?>Age</li>
    <li  id='room_room_title2'>Date: <?=date("Y-m-d H:i",$R[reg_date])?> Count:<?=$R[chat_count]?></li>
   
    </ul> <? if ($login_member[admin]=='1' or $R[my_mbruid]==$login_member[memberuid]) { ?>
    <span id='del_btn' onclick="delete_chat_room(<?=$R[uid]?>);">DELETE</span>
    <? } ?>
  </td></tr></table></a>
<?
 } ?>

			
</td></tr><tr><td>

<div id="paging" >
	<?php
	include "page.php";
	if ($sub_code) {
	$total_count=@mysql_fetch_array(mysql_query("select count(uid) as totalcount from rb_s_chat_room where room_kind=2 and sub_code =$sub_code "));
	
	} else {
	$total_count=@mysql_fetch_array(mysql_query("select count(uid) as totalcount from rb_s_chat_room where room_kind=2 "));
	}
        $total_data=$total_count[totalcount];

        $page_per_list=10;
        $query="mod=".$mod;
        if ($sub_code) {
        $query.="&sub_code=".$sub_code;
      	
        }

        $nav=page_nav($total_data,$num_per_page,$page_per_list,$page,$query);

        echo $nav;
        echo ("<form action=$PHP_SELF>
        			<input name=sub_code id=sub_code type=hidden value='".$sub_code."'>
        			<input name=mod type=hidden value='".$mod."'>
                        page : <input type=text name=page size=4>
                        <input type=submit value='GO'></form>
        ");
?>
</div>
</td></tr></table>
<script type="text/javascript">
		function chat_room_make() {
if($("#chat_room_make").css("display") == "none"){
    $("#chat_room_make").show();
} else {
    $("#chat_room_make").hide();
}



}

		function make_room() {
	 		$("#mail_chat_box2").hide();
	var subject=$("#list_subject").val();
	var sub_code=$("#sub_code").val();
	 $.post("./make_room.php",
   {
    uid:<?=$my[uid]?>,
    subject:subject,
    room_kind:2,
		sub_code:sub_code
       },
   function(data){

parent.location.reload(); 
		   	

   });
	
		
	}


	
</script>
<style>
  #chat_table {
    width:540px;
    position: relative;
    float:left;
  }
  #chat_room_info {
    width:100%;
    position: relative;
    float:left;
    list-style:none;
    padding:0px;
    margin:0px;
  }
  #chat_room_info li {
    width:100%;
    float:left;
  }
  #chat_room_info_table{
    border:1px #dedede solid;
    margin:5px 0px;
  }
</style>

