<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);
if(!$update)
{
  exit;
}
$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
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
if(strpos($text, "/start") === 0 || $text=="ciao")
{
	$response = "$message\n$messageId\n$chatId\n$firstname\n$lastname\n$username\n$date\n$text";
}
elseif($text=="domanda 1")
{
	$response = "risposta 1";
}
elseif($text=="domanda 2")
{
	$response = "risposta 2";
}
else
{
	$response = "Comando non valido!";
}
$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);