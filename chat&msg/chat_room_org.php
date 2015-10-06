<?	
	$photo2=@mysql_fetch_array(mysql_query("select * from rb_s_photo where memberuid=$my[uid] order by mark desc"));
?><style>
#mail_chat_div {

	width:100%;
	
	border:0px #dedede solid;

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
	background-color: #C0C0C0;
	color:#fff;
	overflow: scroll;
	
	width:668px;

	border:0px #dedede solid;
}
#mail_chat_box2 {
	

	color:#fff;
		z-index:99999;
		width:100%;
		

}
#mail_chat_box3 {
	position: absolute;

	top:90px;
	background-color: #fff;
	height:100px;
	width:100%;
	color:#fff;
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
	width:90%;
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
#make_chat_room {
	width:80%;
	height:30px;
	color:#fff;
	text-align: center;
	text-decoration: none;

	
}
#room_make {
	width:80%;
	margin-left:10%;
	height:45px;
	text-align:center;
	border:1px #dedede solid;
	text-decoration: none;
		margin-top: 1%;
		background-color:#767676;
		line-height:45px;
		float:left;
}
#make_room_box {
	width:80%;

	border:3px #dedede solid;
	background-color: #fff;
	margin-left:10%;
	list-style: none;
	padding:0px;
}
#make_room_box_title {
	background: #69ef54;
	color:#000;
	font-size:1.2em;
	text-align: center;
}
#make_room_box_subject {
	background: #fff;
	color:#000;
	font-size:1.2em;
	text-align: center;
	
}
#make_room_box_btn {
	text-align:center;
	font-size:1.2em;
	
}
#chat_room_subject {
	width:90%;
	height:30px;
	margin:5px 0 5px 5%;
	font-size:1.2em;
}
#chat_room_btn {
	width:70%;
	margin-left:5%;
	border:1px #dedede solid;
	font-size:1.2em;
}
#room_subject {
	width:85%;
	margin:5%;
	border:1px #dedede solid;
	height:auto;
	background:#fff;
	padding:2%;
	position: relative;
}
#room_subject ul {
	width:70%;
	margin:0px;
	padding:0px;
	list-style: none;
	text-decoration: none;
	color:#000;
}
#room_subject ul li {
	text-decoration: none;
}
#room_subject_title {
	font-size:18px;
}
#room_subject_title2 {
	font-size:13px;

}
#room_pic {
	width:20%;
	overflow: hidden;
	float:right;
	height:80%;
	
	position: absolute;
	top:10%;
	right:2%;
}
#room_nic {
	width:100%;
	position: absolute;
	bottom:5%;
	text-align:center;
}
#list_subject {
	width:90%;
	margin-left:5%;
	border:1px #dedede solid;
	background-color: #c6ffe7;
	font-size:1.2em;
	height:1.8em;
}

	#btn_blue {

		text-decoration:none !important;display:inline-block;*display:inline;*zoom:1;padding:5px 12px;margin:0;font-family:inherit;font-size:18px;line-height:24px;height:24px;color:#333333;text-align:center;text-shadow:0 1px 1px rgba(255, 255, 255, 0.75);vertical-align:top;cursor:pointer;overflow:visible;background-color:#a6b4d3;*background-color:#a6b4d3;background-image:-moz-linear-gradient(top, #ffffff, #a6b4d3);background-image:-webkit-linear-gradient(top, #7ec0ef 0%, #a6b4d3 100%);background-image:-o-linear-gradient(top, #ffffff 0%, #a6b4d3 100%);background-image:linear-gradient(top, #ffffff, #a6b4d3);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#a6b4d3', GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false);border:1px solid #bbbbbb;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-color:rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);border-bottom-color:#a2a2a2;border-radius:2px;box-shadow:inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05)}
</style><div  id="content"><div id="mail_chat_box2">


 <ul id="make_room_box">
 <li id="make_room_box_title">채팅만들기</li>
  <li id="make_room_box_subject">방제목</li>
    <li><select name="list_subject" id="list_subject" class="select" onchange='change_subject(this.options[this.selectedIndex].value)'>
    <option value="">선택해주세요.</option>
    <option value="애인구해요">애인구해요</option>
    <option value="남차친구를 만나고 싶어요.">남자친구를 만나고 싶어요.</option>
    <option value="여자친구를 만나고 싶어요.">여자친구를 만나고 싶어요.</option>
    <option value="친구를 만나고 싶어요.">친구를 만나고 싶어요.</option>
        <option value="데이트하고 싶어요.">데이트하고 싶어요.</option>
            <option value="오늘만나요.">오늘만나요.</option> 
                        <option value="오늘밤에 만나요.">오늘밤에 만나요.</option> 
                                    <option value="지금만나고 싶어요.">지금만나고 싶어요.</option> 
                                                <option value="주말에 데이트 하실분.">주말에 데이트 하실분 .</option> 
    </select>
    </li>
  <li><input name="subject" type=text id="chat_room_subject"></li>
 <li id="make_room_box_btn"><a  id="btn_blue" onclick="make_room();">OK</a><input name="sub_code" id="sub_code" value="<?=$sub_code?>" type=hidden> </li>
 </ul>
	</div>
<div id="mail_chat_div">
<ul id="mail_chat_form">
	<li id="mail_chat_title">채팅룸 목록 </li>
	<li id="mail_chat_box"><? 
$uid=$my[uid];  

if ($sub_code) {
	  $Sql="select * from  rb_s_chat_room where room_kind=1 and sub_code='$sub_code' order by uid desc";
} else {
	  $Sql="select * from  rb_s_chat_room where room_kind=1 order by uid desc";
}
      $rResult = mysql_query($Sql);

while($R=mysql_fetch_array($rResult)) 
{
$member=@mysql_fetch_array(mysql_query("select * from rb_s_mbrdata where memberuid=$R[my_mbruid]"));
$photo=@mysql_fetch_array(mysql_query("select * from rb_s_photo where memberuid=$R[my_mbruid] order by mark desc"));
?><a href="/?mod=chat_room2&no=<?=$R[uid]?>">
<div id='room_subject'>
<div id="room_pic">

<img src=s_images/200_200_<?=$photo[photo]?>></div><ul><li id='room_subject_title'><?=$R[content]?></li><li  id='room_subject_title2'>Profile : <?=$member[nic]?> <?=$member[height]?>Cm <?=$member[kg]?>Kg <?=$member[age]?>Age</li><li  id='room_subject_title2'>Date: <?=date("Y-m-d H:i",$R[reg_date])?> Count:<?=$R[chat_count]?></li></ul>

</div></a>
<?
 } ?>
 
 </li>
 
</ul>



	
	
</div>	
</div>

<script>

function change_subject(subject) { 
	var subject=subject;
	$("#chat_room_subject").val(subject);
	
 }

	
	function mail_chat_box_show() {
		$("#mail_chat_box2").show();
	}
	
		
	function make_room() {
	 		$("#mail_chat_box2").hide();
	var subject=$("#chat_room_subject").val();
	var sub_code=$("#sub_code").val();
	 $.post("./make_room.php",
   {
    uid:<?=$my[uid]?>,
    subject:subject,
    room_kind:1,
		sub_code:sub_code
       },
   function(data){
   var data=data;
   var html=$("#mail_chat_box").html();
	  
	   		var msg_html2="<a href='/?mod=chat_room2&no="+data+"'><div id='room_subject'><div id='room_pic'><img src=s_images/200_200_<?=$photo2[photo]?>></div><ul><li id='room_subject_title'>"+subject+"</li><li  id='room_subject_title2'>Profile: <?=$my[nic]?> <?=$my[height]?>Cm <?=$my[kg]?>Kg <?=$my[age]?>Age</li><li  id='room_subject_title2'>date: <?=date('Y-m-d H:i')?> Count:0</li></ul></div></a>"+html;
		   	$("#mail_chat_box").html(msg_html2);
		   	

   });
	
		
	}
</script>


