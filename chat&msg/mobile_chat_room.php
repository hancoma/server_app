<?	
 include "db_config.php";
	$photo2=@mysql_fetch_array(mysql_query("select * from rb_s_photo where memberuid=$memberuid order by mark desc"));
?>
<link href="style.css" rel="stylesheet">
<link href="chat.css" rel="stylesheet">
<div id="chat_main_div">
		<ul id="chat_list">
		<li id="chat_list_title" class="box_shadow title_red" onclick="chat_room_make();">채팅방만들기</li>
		<li id="chat_room_make">
				<ul id="chat_room_make_ul" class="box_shadow">
					<li><select name="list_subject" class="select" onchange='list_subject_change(this.options[this.selectedIndex].value)' id="list_subject">
    <option value="">방제목을 선택해주세요.</option>
    <option value="애인구해요">애인구해요</option>
    <option value="남차친구를 만나고 싶어요.">남자친구를 만나고 싶어요.</option>
    <option value="여자친구를 만나고 싶어요.">여자친구를 만나고 싶어요.</option>
    <option value="친구를 만나고 싶어요.">친구를 만나고 싶어요.</option>
        <option value="데이트하고 싶어요.">데이트하고 싶어요.</option>
            <option value="오늘만나요.">오늘만나요.</option> 
                        <option value="오늘밤에 만나요.">오늘밤에 만나요.</option> 
                                    <option value="지금만나고 싶어요.">지금만나고 싶어요.</option> 
                                                <option value="주말에 데이트 하실분.">주말에 데이트 하실분 .</option> 
    </select></li>
					<li><input name="subject" type=text id="chat_room_subject" class="input"></li>
					<li><a href=# class="medium orange" id="make_room_btn" onclick="make_room();">개설하기</a></li>
				</ul>
		</li>
			<li id="chat_list_title" class="box_shadow title">채팅 목록</li>
			<li id="chat_room_list" >
					<?
 $num_per_page=10;
 $start_num=0;
 if ($page>=2) {
 	$start_num=($page-1)*$num_per_page;
 }
 ?> <? 
$uid=$memberuid;  

if ($sub_code) {
	  $Sql="select * from  rb_s_chat_room where room_kind=1 and sub_code='$sub_code' order by uid desc limit $start_num,$num_per_page";
} else {
	  $Sql="select * from  rb_s_chat_room where room_kind=1 order by uid desc limit $start_num,$num_per_page";
}
      $rResult = mysql_query($Sql);

while($R=mysql_fetch_array($rResult)) 
{
$member=@mysql_fetch_array(mysql_query("select * from rb_s_mbrdata where memberuid=$R[my_mbruid]"));
$photo=@mysql_fetch_array(mysql_query("select * from rb_s_photo where memberuid=$R[my_mbruid] order by mark desc"));
?><a href="http://rococophoto.net/?mod=chat_room2&no=<?=$R[uid]?>">
<ul id='chat_room' class="box_shadow">
<li id="chat_room_pic">
<img src="http://rococophoto.net/s_images/200_200_<?=$photo[photo]?>></li>
<li id="chat_room_contents">
		<ul id="chat_room_box">
		<li id='room_room_title'><?=$R[content]?></li>
		<li  id='room_room_title2'>Profile : <?=$member[nic]?> <?=$member[height]?>Cm <?=$member[kg]?>Kg <?=$member[age]?>Age</li>
		<li  id='room_room_title2'>Date: <?=date("Y-m-d H:i",$R[reg_date])?> Count:<?=$R[chat_count]?></li>
		</ul>
</li>

</ul></a>
<?
 } ?>

			</li>
			<li></li>
		</ul>
</div>

  <div id="paging" >
	<?php
	include "page.php";
	$total_count=@mysql_fetch_array(mysql_query("select count(uid) as totalcount from rb_s_chat_room where room_kind=1 "));
        $total_data=$total_count[totalcount];

        $page_per_list=10;
        $query="mod=".$mod;

        $nav=page_nav($total_data,$num_per_page,$page_per_list,$page,$query);

        echo $nav;
        echo ("<form action=$PHP_SELF>
        			<input name=mod type=hidden value='".$mod."'>
                        페이지 : <input type=text name=page size=4>
                        <input type=submit value='이동'></form>
        ");
?>
</div>
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
   var html=$("#chat_room_list").html();
	  
	   		var msg_html2="<a href='<?=$basic_url?>/?mod=chat_room2&no="+data+"'><div id='room_subject'><div id='room_pic'><img src=http://rococophoto.nets_images/<?=$photo2[photo]?>></div><ul><li id='room_subject_title'>"+subject+"</li><li  id='room_subject_title2'>Profile: <?=$my[nic]?> <?=$my[height]?>Cm <?=$my[kg]?>Kg <?=$my[age]?>Age</li><li  id='room_subject_title2'>date: <?=date('Y-m-d H:i')?> Count:0</li></ul></div></a>"+html;
		   	$("#chat_room_list").html(msg_html2);
		   	

   });
	
		
	}

	
</script>
