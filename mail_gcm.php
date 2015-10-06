<?
$headers = array(
 'Content-Type:application/json',
 'Authorization:key=AIzaSyBW-U34FHfLe7kL5m4sNIBRB3gg8JABlhs'
);
 
$arr   = array();
$arr['data'] = array();
$arr['data']['title'] = $subject; 

$arr['data']['message'] = $contents; 
$arr['data']['url'] = "http://naver.com"; 
$arr['registration_ids'][]= "APA91bHsTrvjHcCT1QPJOIUWh5UKfm1oxzhG2zpDb9J22I6bzz3neS9-rc-sE36ksqnjZAqkd4iObll9XHXWHIZ1WBbZwOxkDo41tgGfbP7MLB9-OjZUgvvVKg_vmrnaCb5o8mGdoDt06cnfchDeeEhZv49t43KJlQ";



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