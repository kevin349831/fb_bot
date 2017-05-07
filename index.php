<?php
//My access token
$access_token = "your access token";
//my verify token
$verify_token = "your verify token";
$hub_verify_token = null;

if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}


if ($hub_verify_token === $verify_token) {
    echo $challenge;
}


$input = json_decode(file_get_contents('php://input'), true);
//發送者的ＩＤ
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
//發送者的訊息
$message = $input['entry'][0]['messaging'][0]['message']['text'];
$message_to_reply = '';
/**
 * ㄑ我要回復什麼
 */
if($message=="指令"){
    $message_to_reply = "你可以跟我打招呼或是問我是誰";
}else if(($message=="hi")||($message=="妳好")||($message=="你好")){
    $hi = array("HI~", "你好。", "哈囉！"); 
    $num = rand(0,2);
    $message_to_reply = $hi[$num]."最近好嗎？".$num;
}else if($message=="你是誰"){
    $message_to_reply = "我是Yu-Bot，我還在學習中。";
}else{
    //重複使用者說的話
    $message_to_reply = $message;
}
 

//API Url
$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
//Initiate cURL.
$ch = curl_init($url);
//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "text":"'.$message_to_reply.'"
    }
}';
//Encode the array into JSON.
$jsonDataEncoded = $jsonData;
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
//Execute the request
if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
}
?>
