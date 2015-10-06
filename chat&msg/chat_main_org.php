<style>
#mail_chat_div {
	position: absolute;
	width:660px;
	
	border:0px #dedede solid;
	height:100%;
	margin-left:0%;
	border-radius: 0px;
	z-index:10000;
	background-color:rgba(0,0,0,0.84);

	}
	#mail_chat_form {
		height:80%;
		list-style:none;
		padding:0px;
		margin:0px;
	}
#mail_chat_title {
	border:0px #dedede solid;
	background-color:#334C61;
	height:2em;
	text-align:center;
	font-size:16px;
	line-height:2em;
	color:#fff;
}
#mail_chat_box {
	background-color: #000;;
	height:100%;
	color:#fff;
	overflow-y: scroll;
}
#mail_chat_msgbox {
	position:absolute;
		height:6em;
	background-color: #666D74;
	width:100%;
	list-style:none;
	padding:0px;
	margin:0px;
	overflow: hidden;
}

#msg_box_li {
	width:80%;
	float:left;

}
#msg_input {
	width:90%;
	border:1px ##1D94BF solid;
	border-radius: 5px;
	background-color:#000;
	color:#fff;
	margin:1em;
	height:4em;
	
	
}
#msg_box_btn {
	width:18%;
	float: left;
	
	
}
#msg_ul_left {
	list-style:none;
	padding:0px;
	float:left;
	width:100%;
	margin:2px;
}
#msg_ul_right {
	list-style:none;
	padding:0px;
	float:right;
	width:100%;
	margin:2px;
}
#msg_pic_left {
	width:50px;
	height:50px;
	float:left;
	border:1px #dedede solid;
}
#msg_pic_right {
	width:50px;
	height:50px;
	float:right;
	border:1px #dedede solid;
}
#msg_ul {
	list-style:none;
	padding:0px;
	float:left;
	width:100%;
	margin:2px;
}
#msg_pic {
	width:50px;
	height:50px;
	float:left;
	border:1px #dedede solid;
}
#msg_left {
	border:1px #dedede solid;
	background-color:#FFFF00;
	padding:5px;
	width:70%;
	color:#000;
	border-radius:5px;
	margin-top:2%;
	float:left;
	margin:2px;
}
#msg_list {
	width:100%;
	list-style:none;
	width:100%;
	height:70px;
	padding:0px;
	margin:0px;
	border-bottom:1px #dedede dotted;
}
#msg_pic {
	width:60px;
	height:60px;
	float:left;
	margin:4px;
}
</style>
<div id="mail_chat_div">
<ul id="mail_chat_form">
<li id="mail_chat_title">방만들기 </li>
	<li id="mail_chat_title">메시지 목록 </li>
	<li id="mail_chat_box">

	<? 
$uid=$my[uid];  

	  $Sql="select * from  mail_member WHERE uid=$uid  order by no desc ";
      $rResult = mysql_query($Sql);

while($R=mysql_fetch_array($rResult)) 
{
$member2=@mysql_fetch_array(mysql_query("select * from mail_member  where mail_room_no=$R[mail_room_no] and uid<>$uid "));
	$uid2=$member2[uid];

	$member=@mysql_fetch_array(mysql_query("select * from rb_s_mbrdata where memberuid=$uid2"));

$photo=@mysql_fetch_array(mysql_query("select * from rb_s_photo where memberuid=$uid2 order by mark desc"));
if ($uid2) {
 ?><a href="/?mod=mail_chat&uid=<?=$uid2?>">
<ul id='chat_room' class="box_shadow">
<li id="msg_pic"><img src="s_images/200_200_<?=$photo[photo]?>"></li><li>
 <table width="70%;"><tr><td colspan=2 style="color:#fff;"><big><?=$member[nic]?></big><?=substr($R[d_regis],0,8)?></td></tr><tr><td style="color:#fff;">
 <?=$R[last_msg]?>
 </td><td style="color:#fff; font-size:12px; text-align:right;"><?=date("Y-m-d",$R[last_date])?></td></tr></table>
 </li></ul></a>
 <?
 
 }
  } ?>
	</li>
</ul>
<input name=chat_no value='0' type=hidden id="chat_no">


	
	
</div>

<script>

setInterval("chat_box_call(<?=$my[uid]?>)",1000);
function chat_check_msg() {
	var msg=$("#msg_input").val();
   var msg_html="<ul id='msg_ul'><li id='msg_pic'>사진11</li><li id='msg_left'>"+msg+"</li></ul>";
   var msg_html2=msg_html;
	$("#mail_chat_box").append(msg_html2);
	 $("#msg_input").val("");
mail_chat_box.scrollTop = mail_chat_box.scrollHeight;
	}
	
function chat_msg() {
	var msg=$("#msg_input").val();
	var uid="1";
	var uid2="13";
	 $("#msg_input").val("");
mail_chat_box.scrollTop = mail_chat_box.scrollHeight;

$.post("./msg_save.php",
   {
    uid:uid,
    uid2:uid2,
    msg:msg
   });
   
	}
	
		function chat_box_call (uid) {
		var chat_no2=$("#chat_no").val();
		  	 $.post("./msg_push.php",
   {
    uid:uid,
    uid2:"123",
    no:chat_no2
   },
   function(data){
   if (data){
      var m_data = data.split('/,/');
    var uid=m_data[0];
    var p=m_data[1];
    var no=m_data[2];
    var chat_no2=$("#chat_no").val();
    chat_no2=Number(chat_no2);
    if(no>=1) {
			    if (chat_no2!=no ) {
			    	   var msg_html="<ul id='msg_ul'><li id='msg_pic'>"+uid+"</li><li id='msg_left'>"+p+"</li></ul>";
			   var msg_html2=msg_html;
				$("#mail_chat_box").append(msg_html2);
				$("#chat_no").val(no);
				}
		}
	}
	});
		
	}
	
</script>


