<?php
function receivedText(){
	$response = "Ho ricevuto un messaggio di testo";
}
function receivedAudio(){
	$response = "Ho ricevuto un messaggio audio";
}
function receivedDocument(){
	$response = "Ho ricevuto un messaggio document";
}
function receivedPhoto(){
	$response = "Ho ricevuto un messaggio photo";
}
function receivedSticker(){
	$response = "Ho ricevuto un messaggio sticker";
}
function receivedVideo(){
	$response = "Ho ricevuto un messaggio video";
}
function receivedVoice(){
	$response = "Ho ricevuto un messaggio voice";
}
function receivedContact(){
	$response = "Ho ricevuto un messaggio contact";
}
	$response = "Ho ricevuto un messaggio location";
}
	$response = "Ho ricevuto un messaggio venue";
}
function receivedOther(){
	$response = "Ho ricevuto un messaggio other";
}
$content = file_get_contents("php://input");
$update = json_decode($content, true);
if(!$update)
{
  exit;
}
$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";//numero messaggio(parte da 0)
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";//id chat
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";//nome
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";//cognome
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";//nick
$date = isset($message['date']) ? $message['date'] : "";//data
$text = isset($message['text']) ? $message['text'] : "";//testo
$text = trim($text);
$text = strtolower($text);
header("Content-Type: application/json");
$response = '';
if(isset($message['text'])){
	receivedText();
	
}
elseif(isset($message['audio'])){
	receivedAudio();
}
elseif(isset($message['document'])){
	receivedDocument();
}
elseif(isset($message['photo'])){
	receivedPhoto();
}
elseif(isset($message['sticker'])){
	receivedSticker();
}
elseif(isset($message['video'])){
	receivedVideo();
}
elseif(isset($message['voice'])){
	receivedVoice();
}
elseif(isset($message['contact'])){
	receivedContact();
}
elseif(isset($message['location'])){
	receivedLocation();
}
elseif(isset($message['venue'])){
	receivedVenue();
}
else{
	receivedOther();
}
$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);