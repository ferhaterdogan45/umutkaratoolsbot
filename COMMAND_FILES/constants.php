<?php

/////////////////////////

# CONSTANTS

define('_CREATOR_ID', $creator_id);
define('_BOT_ID', $Bot_Id);
define('_BOT_NAME', $Bot_Name);
define('_DATE_', date('H:i:s'));
define('CONFIG_CHAT_ID', $Config_Chat_id);
define('CONFIG_PRIVATE_CHAT_ID', $Config_Private_Chat_id);
define('CONFIG_LOG_CHAT_ID', $Config_Log_Chat_id);
define('CONFIG_TEST_CHAT_ID', $Config_Test_Chat_id);


if (!$callback_data){
	define('_CHAT_ID', $chat_id);
	$_chat_id = explode("-100", $chat_id);
	define('_CHAT_ID_', $_chat_id[1]);
	define('_DATE', $date);
	define('VOICE_STATUS', $voice_status);
	define('AUDIO_STATUS', $audio_status);
	define('_MESSAGE_DATE', $message_date);
	define('_CHAT_TYPE', $chat_type);
	define('_USER_ID', $user_id);
	define('_TEXT', $text);
	define('_MESSAGE_ID', $message_id);
	define('_MESSAGE_ID_', $message_id+1);
	define('_FIRST_NAME', $first_name);
	$_first_name = str_replace("\\","",$first_name);
	define('_USER_FIRST_NAME', explode(" ",$_first_name));
	define('_LAST_NAME', $last_name);
	define('_USERNAME', $username);
	define('_REPLY_MESSAGE_ID', $reply_message_id);
	define('_REPLY_USER_ID', $reply_user_id);
	define('_REPLY_FIRST_NAME', $reply_first_name);
	define('_REPLY_LAST_NAME', $reply_last_name);
	define('_REPLY_USERNAME', $reply_username);
	define('_USER_MESSAGE', explode(" ", $text));
	define('_USER_MESSAGE_COUNT', $User_Message_Count);
	define('SENDER_CHAT_ID', $sender_chat_id);
	define('SENDER_CHAT_TITLE', $sender_chat_title);
	define('SENDER_CHAT_USERNAME', $sender_chat_username);
	define('SENDER_CHAT_STATUS', $sender_chat_status);
}else{
	# CALLBACK
	
	define('_CALLBACK_DATA', $callback_data);
	define('_CALLBACK_DATE', $callback_date);
	define('_CALLBACK_ID', $callback_id);
	define('_CHAT_TYPE', $callback_chat_type);
	define('_CHAT_ID', $callback_chat_id);
	define('_USER_ID', $callback_user_id);
	define('_CALLBACK_ENTITIES_ID', $callback_entities_id);
	define('_CALLBACK_ENTITIES_FIRST_NAME', $callback_entities_first_name);
	define('_CALLBACK_ENTITIES_LAST_NAME', $callback_entities_last_name);
	define('_CALLBACK_ENTITIES_USERNAME', $callback_entities_username);
	define('_MESSAGE_ID', $callback_message_id);
	
	$_callback_first_name = str_replace("\\","",$callback_first_name);
	define('_USER_FIRST_NAME', explode(" ",$_callback_first_name));
	
	$_callback_entities_first_name = str_replace("\\","",$callback_entities_first_name);
	define('_CALLBACK_USER_ENTITIES_FIRST_NAME', explode(" ",$_callback_entities_first_name));
}
/////////////////////////


?>
