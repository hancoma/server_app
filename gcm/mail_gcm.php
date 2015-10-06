<?
$headers = array(
 'Content-Type:application/json',
 'Authorization:key=서비스 아이디'
);
 
$arr   = array();
$arr['data'] = array();
$arr['data']['title'] = $subject; 

$arr['data']['message'] = $contents; 
$arr['data']['url'] = "http://naver.com"; 

$arr['registration_ids'][]= "회원reg_id";
$arr['registration_ids'][]= "회원reg_id";
$arr['registration_ids'][]= "회원reg_id";
$arr['registration_ids'][]= "회원reg_id";
$arr['registration_ids'][]= "회원reg_id";




$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,    'https://android.googleapis.com/gcm/send');
curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers);
curl_setopt($ch, CURLOPT_POST,    true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arr));
$response = curl_exec($ch);
echo $response;
curl_close($ch);

?>

<script>
history.back();
</script>