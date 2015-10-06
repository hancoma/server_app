<?

 $room_info=@mysql_fetch_array(mysql_query("select * from rb_s_chat_room where uid=$no"));
//만약 대화방에 없으면 참여 있다면 접속 시간 저장
 $room_connect_info=@mysql_fetch_array(mysql_query("select * from chat_room_member where chat_room_no=$no and uid=$my[uid] "));
if ($room_connect_info[no]) {
			$reg_date=time();
			 $query = "UPDATE chat_room_member SET reg_date='$reg_date'  WHERE no=$room_connect_info[no]"; 
			 $result = mysql_query($query);

} else {
	$reg_date=time();

$_QKEY = "chat_room_no,uid,reg_date,connect_time";
$_QVAL = "'$no','$my[uid]','$reg_date','$reg_date'";
 $query = "INSERT INTO chat_room_member ($_QKEY) values ($_QVAL)"; 
 $result = mysql_query($query);
  $query = "UPDATE rb_s_chat_room SET chat_count=chat_count+1  WHERE uid=$no"; 
$result = mysql_query($query);
}

?>

<style>
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
  width:80px;
  height:80px;
  float:left;
  border:1px #dedede solid;
}
#msg_pic_right {
  width:80px;
  height:80px;
  float:right;
  border:1px #dedede solid;
}
#msg_pic {
  width:80px;
  height:80px;
  float:left;
  border:1px #dedede solid;
}
#msg_left {
  border:1px #dedede solid;
  background-color:#f4ea57;
  padding:5px;
  width:70%;
  color:#000;
  border-radius:5px;
  margin-top:2%;
  float:left;
  margin:2px;
  font-size:15px;
}
#msg_right {
  border:1px #dedede solid;
  background-color:#a4cfff;
  padding:5px;
  width:70%;
  color:#000;
  border-radius:5px;
  margin-top:2%;
  float:right;
  margin:2px;
font-size:15px;
}
#msg2_left {
  color:#000;
  padding:5px;
  width:70%;
  border-radius:5px;
  margin-top:2%;
  float:left;
  margin:2px;
  font-size:12px;
  text-align: right;
    font-size: 1.0em;
  }
#msg2_right {

  padding:5px;
  width:70%;
  color:#000;
  border-radius:5px;
  margin-top:2%;
  float:right;
  margin:2px;
  color:#000;
  text-align:left;
    font-size: 1.0em;
}
#mail_chat_msgbox {
  list-style:none;
  background-color: #FF0080;
  float:left;
  width:660px;
  text-align: left;
}
#mail_chat_msgbox li {
	float:left;
}
#msg_input {
	width:90%;
	font-size: 18px;
}
#msg_box_li {
	width:70%;
}
#msg_box_title {
	width:100px;
	text-align:right;
	padding:0px 10px;
		
}
#chat_box {
  width:540px;
   background-color:#FF0080;

}
#chat_box td {
  padding:5px;
}
#trans_btn {
  padding:5px;
  background-color: #FF0080;
  color:#fff;
  margin:0px 5px;
}

</style><link href="chat.css" rel="stylesheet">
<p id="sub_title">
<span style="margin-left:10px;">HOME / CHAT ROOM</span>
</p>
    <div class="ink-grid bg-color">
     
        
        <div class="column-group">
        
        <label for="name">MESSAGE BOX</label>
        <div class="all-80">
                <span><input type="text" name="msg_input" id="msg_input" class="all-50"></span>
        </div>
        <div class="all-20 ">
                <button class="ink-button" onclick="chat_msg()">SEND</button>
        </div>
        </div>
    </div>


<div id="chat_main_div">
<?
	$member=@mysql_fetch_array(mysql_query("select * from rb_s_mbrdata where memberuid=$room_info[my_mbruid]"));
	?>

<ul id="chat_list">
	<li id="mail_chat_title">
  <span style="float:left; font-size:12px; margin-left:5%; width:100px;"><?=$member[nic]?></span>
  <span style="float:left;  margin-left:5%; width:440px; text-align:center;"><? menu_data($table['pridebbs_menu_data'],$language_code,$room_info[content]);?></span>
	<span style="float:right;">
	<form name="chat_form" action="<?=$php_self?>">
	<input name=no type=hidden value="<?=$no?>">
	<input name=mod type=hidden value="<?=$mod?>">
	</form>	</span>
	</li>
	<li id="chat_room_list">
	<?
		 $Sql="select * from  chat_contents  WHERE chat_room_no=$no  order by no desc";

      $rResult = mysql_query($Sql);
while($R=mysql_fetch_array($rResult)) 
{
$photo=@mysql_fetch_array(mysql_query("select * from rb_s_photo where memberuid=$R[uid] order by mark desc"));
if ($my[uid]==$R[uid]) {
	$align="left";
} else {
	$align="right";
}
$member=@mysql_fetch_array(mysql_query("select * from rb_s_mbrdata where memberuid=$R[uid]"));

?>
		<ul id='msg_ul_<?=$align?>'><li id='msg_pic_<?=$align?>'  >
	
  <img src="<?=$basic_url?>/image.php?width=80&height=80&image=/_var/photo/<?=$photo[photo]?>"  onclick='profile_show(<?=$R[uid]?>);' >
    </li>
		<li id='msg_<?=$align?>'><span id="span_<?=$R[no]?>"><?=$R[contents]?></span></li>
		<li id='msg2_<?=$align?>'><span  onclick="chat_trans('<?=$R[contents]?>','span_<?=$R[no]?>','<?=$to?>');" id="trans_btn">trans</span><?=$member[nic]?> <?=date("Y-m-d H:i",$R[reg_date])?></li></ul>
	
		<script>
		//chat_trans('<?=$R[contents]?>','span_<?=$R[no]?>',"<?=$to?>")
		</script>
		<? 
				if ($mx_count<$R[no]) {
				$mx_count=$R[no];
				}
		} 
		if (!$mx_count) {
			$mx_count=0;
			
		}
		?>
			
	</li>
</ul>	<div id="profile_box"><input name=uid type=hidden value='' id="uid">
		<img src="" id="profile_pic">
		</div>
<input name=chat_no value='<?=$mx_count?>' type=hidden id="chat_no">


	
	
</div>

<script>
	
setInterval("chat_box_call(<?=$my[uid]?>)",1000);

	function chat_trans(msg,div_name,to) {
	var msg=msg;
	var div_name=div_name;
	var to=to;

$.post("./chat_trans.php",
   {
    msg:msg,
    div_name:div_name,
    to:to
   }, function(data){
   	
   	 var m_data = data.split('/,/');
    var msg=m_data[0];
    var div_name=m_data[1];

    $("#"+div_name).html(msg);
   });
   
	}

function chat_msg() {
	var msg=$("#msg_input").val();
	var uid="<?=$my[uid]?>";
	 $("#msg_input").val("");


$.post("./chat_save.php",
   {
    uid:uid,
    chat_room_no:<?=$no?>,
    msg:msg
   });
   
	}
	
		function chat_box_call(uid) {
		var chat_no2=$("#chat_no").val();
		var to="<?=$to?>";
		  	 $.post("./chat_push.php",
   {
    uid:uid,
    chat_room_no:<?=$no?>,
    no:chat_no2,
    to:to

   },
   function(data){
   if (data){
      var m_data = data.split('/,/');
    var uid=m_data[0];
    var p=m_data[1];
    var no=m_data[2];
	var photo=m_data[3];
	var align=m_data[4];
	var reg_date=m_data[5];
	var nic=m_data[6];
    var chat_no2=$("#chat_no").val();
    chat_no2=Number(chat_no2);
    if(no>=1) {
			    if (chat_no2!=no ) {
					   var msg_html="<ul id='msg_ul_"+align+"'><li id='msg_pic_"+align+"'  ><img src='<?=$basic_url?>/image.php?width=80&height=80&image=/_var/photo/"+photo+"' alt='"+photo+"' onclick='profile_show("+uid+");' width=80 height=80></li><li id='msg_"+align+"'><span id='span_"+no+"'>"+p+"</span></li><li id='msg2_"+align+"'><span  onclick=chat_trans('"+p+"','span_"+no+"','<?=$to?>') id='trans_btn'>trans</span> "+nic+" " + reg_date+"</li></ul>";

					

					   var msg_html2=msg_html;
					   	$("#chat_room_list").prepend(msg_html2);
						
						$("#chat_no").val(no);
						

				}
		}
	}
	});
	
	}
	function profile_show(uid) {
		var uid=uid;


		  $('#profile_box').css({'display':'block'});
		   $.post("./chat_profile.php",
   {
    uid:uid
   },
   function(data){
    var m_data = data.split('/,/');
    var photo=m_data[0];
        var nic=m_data[1];
    var profile_info=m_data[2];
        var mytype=m_data[3];
                var position=m_data[4];
                var uid=m_data[5];
                var position="<img src="+position+" width=20 height=20>";
    	profile_pic.src="s_images/200_200_"+photo;
    	$("#profile_info").html(nic+" "+position+"<br>"+profile_info+"<br>"+mytype);
    	$("#uid").val(uid);
    	
   });
   
	}
	
	function zzim_member(uid) {
	var my_mbruid=<?=$my[uid]?>;
	var by_mbruid=$("#uid").val();
	   	 $.post("./add_zzim.php",
   {
    uid:my_mbruid,
    uid2:by_mbruid
   },
   function(data){

   alert( "<? menu_data($table['pridebbs_menu_data'],$language_code,'Chosen friend list');?>");
    	
    	
    
   });
  
	
}
function msg_pop() {
	var msg= prompt('not msg.', '');
	var uid=<?=$my[uid]?>;
	var uid2=$("#uid").val();
	 	 $.post("./msg_save.php",
   {
    uid:uid,
    uid2:uid2,
    msg:msg
      });
	
}
function profile_pop_n() {
	 $('#profile_box').css({'display':'none'});
}
$("#msg_input").keypress(function( event ) {
  if ( event.which == 13 ) {
     event.preventDefault();
     chat_msg();
  }
});


</script>




