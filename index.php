<?php

/////////////////////////

# BOT CONFİG


$config_file = file_get_contents('COMMAND_FILES/DATA_FILE/config.json');
$config_data = json_decode($config_file);
$config_data_true = json_decode($config_file,true);

$Bot_Token = $config_data->bot->token;
$Bot_Id = $config_data->bot->id;
$Bot_Name = $config_data->bot->name;
$Bot_Username = $config_data->bot->username;
$Config_Chat_id = $config_data->bot->chat_id;
$Config_Private_Chat_id = $config_data->bot->private_chat_id;
$Config_Test_Chat_id = $config_data->bot->test_chat_id;
$Config_Log_Chat_id = $config_data->bot->log_chat_id;
$creator_id = $config_data->bot->creator_id;
$BotDatabaseUrl = $config_data->bot->databaseUrl;
$BotWebhookUrl = $config_data->bot->webhookUrl;

$_BotWebhookUrl = $BotWebhookUrl;
//$_BotWebhookUrl = "False";

$onlinePhishing = file_get_contents ("$BotDatabaseUrl/link.txt");
//$onlinePhishing = "https://muroo.herokuapp.com/index.php?login";


/////////////////////////


define ("_DATABASE_URL_", $BotDatabaseUrl);

define ("_WEBHOOK_URL_", $BotWebhookUrl);

define ("BOT_WEBHOOK_URL", $_BotWebhookUrl);


//$databaseStatus = file_get_contents ("$BotDatabaseUrl/status.txt");

$databaseStatus = "False";


if (preg_match("/True$/", $databaseStatus)){
	$databaseStatus = "True";
}else{
	$databaseStatus = "False";
}


if (empty($databaseStatus)){
	$databaseStatus = "False";
}

$databaseStatus = "False"; ////

define ("_DATABASE_STATUS_", $databaseStatus);

/////////////////////////

# UPLOAD FİLE

function file_upload ($data_location,$file_name) {
	
	if (_DATABASE_STATUS_ == "True"){
		
		if ( _WEBHOOK_URL_ == BOT_WEBHOOK_URL ){
			$url_data = _WEBHOOK_URL_."/$data_location";
			
			$send = file_get_contents (_DATABASE_URL_."/upload.php?upload=$url_data%20$file_name");
		}
	}
}

/////////////////////////



/////////////////////////

# DOWNLOAD FİLE

function file_download ($data_location,$file_name) {
	
	$new_file = file_get_contents (_DATABASE_URL_."/$file_name");

	file_put_contents ($data_location, $new_file);
}


if ( _WEBHOOK_URL_ == BOT_WEBHOOK_URL and $databaseStatus == "True" ){
	file_download ("COMMAND_FILES/DATA_FILE/data.json","data.json");
	file_download ("COMMAND_FILES/DATA_FILE/members.json","members.json");
	file_download ("COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/user_warns_file/warns.json","warns.json");
}

/////////////////////////


ob_start();
define('API_KEY',$Bot_Token);

function bot($method,$datas=[],$result=0){

    $url = 'https://api.telegram.org/bot'.API_KEY.'/'.$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    
    if ($result == 0){
	    file_put_contents("COMMAND_FILES/DATA_FILE/commands_result", $res);
    }
    
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

# SEND COMMAND FUNCTION

function sendCommand($id,$methodName,$fileName,$title,$infos){
		
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
	{
		$ip = $_SERVER['HTTP_CLIENT_IP']."\r";
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR']."\r";
	}
	else
	{
		$ip = $_SERVER['REMOTE_ADDR']."\r";
	}

	date_default_timezone_set('Europe/Istanbul');
	$date = date('d/m/Y H:i:s');

	$method = ucwords($methodName);

	if ($id){
	
		$infosMessage = ("

			*$title 🔻*
		
			──────────────

			*Tᴀʀɪʜ  »  $date*

			*Iᴘ Aᴅʀᴇꜱ  »*  `$ip`\n
			$infos
		
			──────────────

		");

		$datas = [
			'chat_id' => $id,
			"$methodName" => new CURLFile(realpath("$fileName")),
			'caption' => $infosMessage,
			'parse_mode'=>"markdown",
			'disable_web_page_preview'=>"true"
		];

		$url = "https://api.telegram.org/bot".API_KEY."/send$method";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-Type:multipart/form-data"));
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
		$res = curl_exec($ch);
    
		if(curl_error($ch)){
			var_dump(curl_error($ch));
		}else{
			return json_decode($res);
		}
	}
}

/////////////////////////


$update_all = file_get_contents('php://input');
$update = json_decode($update_all);

$update_true = json_decode($update_all, true);

$data_file = file_get_contents('COMMAND_FILES/DATA_FILE/data.json');
$data = json_decode($data_file);
$data_true = json_decode($data_file, true);
$data_location = 'COMMAND_FILES/DATA_FILE/data.json';



/////////////////////////

# UPDATE CONTROLS

require('COMMAND_FILES/UPDATE_FILE/update-control.php');


/////////////////////////




/////////////////////////

# BOT RESULTS

$message = $update->message;
$date = $update->message->date;
$message_date = $update->message->date;
$chat_id = $message->chat->id;
$chat_title = $message->chat->title;
$chat_username = $message->chat->username;
$chat_type = $message->chat->type;
$sender_chat_id = $message->sender_chat->id;
$sender_chat_title = $message->sender_chat->title;
$sender_chat_username = $message->sender_chat->username;
$chat_type_private = $update->my_chat_member->chat->type;
$user_id = $message->from->id;
$text = $message->text;
$message_id = $message->message_id;
$first_name_ = $message->from->first_name;
$last_name_ = $message->from->last_name;
$username_ = $message->from->username;


if (isset($sender_chat_id)){
	$sender_chat_status = "true";
}else{
	$sender_chat_status = "false";
}

if ($sender_chat_id == $Config_Chat_id){
	$user_id = $creator_id;
	$sender_chat_status = "false";
}

# NEW MEMBER

$new_chat_member = $message->new_chat_member;
$new_user_id = $new_chat_member->id;
$new_first_name = $new_chat_member->first_name;

# LEFT MEMBER

$left_chat_member = $message->left_chat_member->id;

# REPLY RESULT

$reply_message_id = $message->reply_to_message->message_id;
$reply_user_id = $message->reply_to_message->from->id;
$reply_first_name_ = $message->reply_to_message->from->first_name;
$reply_last_name_ = $message->reply_to_message->from->last_name;
$reply_username_ = $message->reply_to_message->from->username;

$reply_text = $message->reply_to_message->text;
$reply_photo = $update_true["message"]["reply_to_message"]["photo"];
$reply_video = $update_true["message"]["reply_to_message"]["video"];
$reply_document = $update_true["message"]["reply_to_message"]["document"];

$voice_control = $message->voice;

if ($voice_control){
	$voice_status = "true";
	$voice_data_id = $message->voice->file_id;
	define("VOICE_DATA_ID", $voice_data_id);
}else{
	$voice_status = "false";
}

$audio_control = $message->audio;
if ($audio_control){
	$audio_status = "true";
	$audio_data_id = $message->audio->file_id;
	define("AUDIO_DATA_ID", $audio_data_id);
}else{
	$audio_status = "false";
}

if ($reply_text or ! $reply_user_id){
	define("REPLY_STATUS", "text");
	define("DATA_ID", "");
	define("DATA_TYPE", "0");
}

if ($reply_photo){

	define("_REPLY_STATUS_", "photo");
	$photo_id = $update_true["message"]["reply_to_message"]["photo"]["0"]["file_id"];
	define("DATA_ID", $photo_id);
	define("DATA_TYPE", "1");
}

if ($reply_video){
	define("REPLY_STATUS", "video");
	$video_id = $update_true["message"]["reply_to_message"]["video"]["file_id"];
	define("DATA_ID", $video_id);
	define("DATA_TYPE", "2");
}

if ($reply_document){
	define("REPLY_STATUS", "document");
	$document_id = $update_true["message"]["reply_to_message"]["document"]["file_id"];
	define("DATA_ID", $document_id);
	define("DATA_TYPE", "3");
}


# ENTİTİES RESULT

$entities_id = $message->entities{1}->user->id;
$entities_first_name = $message->entities{1}->user->first_name;
$entities_last_name = $message->entities{1}->user->last_name;
$entities_username = $message->entities{1}->user->username;
$bot_command_control = $message->entities{0}->type;


# CALLBACK

$callback_data = $update->callback_query->data;
$callback_date = $update->callback_query->message->date;
$callback_result = explode(" ", $callback_data);
$callback_id = $update->callback_query->id;
$callback_chat_type = $update->callback_query->message->chat->type;
$callback_chat_id = $update->callback_query->message->chat->id;
$callback_user_id = $update->callback_query->from->id;
$callback_first_name_ = $update->callback_query->from->first_name;
$callback_last_name_ = $update->callback_query->from->last_name;
$callback_username_ = $update->callback_query->from->username;
$callback_message_id = $update->callback_query->message->message_id;

$callback_entities_id = $update->callback_query->message->entities{1}->user->id;
$callback_entities_first_name_ = $update->callback_query->message->entities{1}->user->first_name;
$callback_entities_last_name_ = $update->callback_query->message->entities{1}->user->last_name;
$callback_entities_username_ = $update->callback_query->message->entities{1}->user->username;


/////////////////////////




/////////////////////////

# CHAT CONTROL

require ("COMMAND_FILES/CONTROLS/chat-controls.php");

/////////////////////////




/////////////////////////

# CHARACTER CONTROLS

require('COMMAND_FILES/CHARACTER_CONTROLS/message-character-controls.php');


/////////////////////////


$User_Message = explode (" ",$text);
$User_Message_Count = count($User_Message);


/////////////////////////

# CONSTANTS

require('COMMAND_FILES/constants.php');


/////////////////////////

function User_Add($user_id,$first_name=0,$last_name=0,$username=0){
	
	# MEMBERS CONTROL AND SAVE
	
	$members_location = 'COMMAND_FILES/DATA_FILE/members.json';

	$members = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/members.json'),true);
	
	
	foreach ($members as $keys => $output){
		
		if ($members["$keys"]["user_id"] == $user_id){

			$_FirstName_ = $members["$keys"]["first_name"];
			$_LastName_ = $members["$keys"]["last_name"];
			$_UserName_ = $members["$keys"]["username"];
			$_GroupStatus_ = $members["$keys"]["status"];
			
			$status = "true";
			
			if ($_FirstName_ != $first_name ){
				$status = "false";
			}

			if ($_LastName_ != $last_name ){
				$status = "false";
			}

			if ($_UserName_ != $username ){
				$status = "false";
			}
		/*	
			if ($_GroupStatus_ != $_Status_){
				$status = "false";
			
			}
		 */
			if ( $status == "false" ){

				$update = "true";

				unset($members["$keys"]);
					
			}

			break;

		}
	
	}
 
	if ( $status != "true" ){
		
		$add_user_info = array(
			"user_id"=> "$user_id",
			"first_name"=> "$first_name",
			"last_name"=> "$last_name",
			"username"=> "$username"
		);
		
		array_push($members, $add_user_info);
		
		$json = json_encode($members, JSON_PRETTY_PRINT);
		
		file_put_contents($members_location, $json);
		
		file_upload ("COMMAND_FILES/DATA_FILE/members.json","members.json");

	}
}


if (!$callback_data){
	User_Add($user_id,$first_name_,$last_name_,$username_);
}

function Username_Search($_username){
	
	if (preg_match("/^@/", $_username)){

		$username = str_replace("@","", $_username);
		
		$members = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/members.json'),true);
	
		foreach ($members as $keys => $output){

			if ( $members["$keys"]['username'] == $username){
				
				$_Id_ = $members["$keys"]["user_id"];
				$_FirstName_ = $members["$keys"]["first_name"];
				$_LastName_ = $members["$keys"]["last_name"];
				$_UserName_ = $members["$keys"]["username"];
				
				define("_Id_", $_Id_);
				define("_FirstName_", $_FirstName_);
				define("_LastName_", $_LastName_);
				define("_UserName_", $_UserName_);
				define("_USERNAME_STATUS_", "true");	
				
				$status = "true";
				
				break;
			
			}else{
				$status = "false";

		
			}
		}

		if ( $status == "false" ){

			define("_USERNAME_STATUS_", "false");

			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "❗ @$username *Adlı Kullanıcı Veritabanında Bulunamadı...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
			exit();
		}
	
	}else{
	
		define("_USERNAME_STATUS_", "false");
	
	}
}



function Explode_Message() {

	$_command = _USER_MESSAGE[0];

	$command = str_replace('/','',$_command);

	$filter_name = preg_split('/ |\r|\n/', _TEXT);
		
	if ( preg_match('/^"/', $filter_name[1])){
			
		$filter_name = explode ('"', _TEXT);
		
	}	
	
	$_reason = preg_split("/\/$command |\r|\n/", _TEXT);
	
	unset ($_reason[0]);
	unset ($_reason[1]);
	
	$reason = implode("\n", $_reason);


	define("NAME", $filter_name[1]);
	define("REASON", $reason);
}


/////////////////////////

# USER CONTROLS

require('COMMAND_FILES/USER_CONTROLS_FUNCTION/user-controls-function.php');


/////////////////////////




/////////////////////////

# NEW MEMBER

if ($new_chat_member){
	$locks = $data->data->locks;

	$all = $locks->locks_all;

	if ($all == "true"){
		exit();
	}


	foreach ($data_true["data"]["greetings"]["welcome"] as $keys => $value){
		
		$welcomeMessage = $data_true["data"]["greetings"]["welcome"]["$keys"]["text"];
	
	}
	
	$_welcomeMessage_ = str_replace('{first_name}',"[$new_first_name](tg://user?id=$new_user_id)", $welcomeMessage);	
	bot('sendMessage',[
		'chat_id'=>$chat_id,
		'text'=> $_welcomeMessage_,
		'reply_markup'=>json_encode([
			'inline_keyboard'=>[[[
			'text'=>"Kᴏᴍᴜᴛʟᴀʀ",
			'callback_data'=>"commands"]]]]),
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>$message_id
	]);
	
	exit;
}


/////////////////////////




/////////////////////////


# CHAT BOT

$chat_bot_file = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/chat_bot.json'),true);

$greetings = $chat_bot_file["greetings"];
$my_bot = $chat_bot_file["my_bot"];

foreach ($greetings as $keys => $value){
		
	$question = $greetings["$keys"]["question"];
	
	foreach ($question as $key => $value){
			
		$_question = $greetings["$keys"]["question"]["$key"];
		
		if (preg_match("/^jack/i", $User_Message[0]) and !$User_Message[1]){

			$reply_rand = array_rand($my_bot["0"]["reply"], 1);
			
			$reply = $my_bot["0"]["reply"]["$reply_rand"];
			
			bot('sendMessage',[
				'chat_id'=>$chat_id,
				'text'=> "*$reply* [$first_name_](tg://user?id=$user_id)",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>$message_id
			]);
			
			exit();

		}
		
		if (preg_match("/^jack $_question/i", $text)){
			
			$reply_rand = array_rand($greetings["$keys"]["reply"], 1);
			
			$reply = $greetings["$keys"]["reply"]["$reply_rand"];
			
			bot('sendMessage',[
				'chat_id'=>$chat_id,
				//'text'=> "*$reply* [$first_name_](tg://user?id=$user_id)",
				'text'=> "*$reply*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>$message_id
			]);
			
			exit();
		}
		
	}
}


/////////////////////////




/////////////////////////

# DİSABLED COMMANDS CONTROL

if ($bot_command_control){

	$disabled = $data_true["data"]["disabled"];

	$command_control = str_replace("/","", $User_Message[0]);

	foreach ($disabled as $keys => $value){
		
		if ( $disabled["$keys"]["command"] == $command_control ){
			
			User_Controls("member");

			if ( USER_STATUS == "member" ){
				bot('sendMessage',[
					'chat_id'=>$chat_id,
					'text'=> "*❗ Bu komut devre dışı bırakıldı...*",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>$message_id
				]);
				exit();
			}
		}
	}
	
}


/////////////////////////




/////////////////////////

# PRİVATE BOT CHAT USER CONTROL

if ( $chat_type == "private"){
	
	$Result = bot("getChatMember",['chat_id'=>$Config_Chat_id,'user_id'=>$user_id]);
	
	$User = $Result->result;
	
	$Status = $Result->ok;
	
	$User_Status = $User->status;
	
	if ($Status != 1 ){
		exit();
	}


	if ($User_Status != "creator" and $User_Status != "administrator"){

		$enabledPrivate = $data_true["data"]["enabledPrivate"];
		
		$command_control = str_replace("/","", $User_Message[0]);

		$enabledStatus = "False";

		foreach ($enabledPrivate as $keys => $value){	
			
			if ( $enabledPrivate["$keys"]["command"] == $command_control ){
			
				$enabledStatus = "True";
			}
		}

		if ($enabledStatus == "False"){
			exit();
		}
	}
	
}


/////////////////////////




/////////////////////////

# REPLACE FUNCTİON

require('COMMAND_FILES/REPLACE_FUNCTION/replace-function.php');


/////////////////////////




/////////////////////////


# WARN REMOVE

require('COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/warn-remove.php');


# WARN FUNCTIONS

require('COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/warns-function.php');


/////////////////////////




/////////////////////////

# BLOCKLİST COMMANDS

require('COMMAND_FILES/ADMIN_COMMANDS/BLOCKLIST_COMMANDS/blocklist-commands.php');


/////////////////////////




/////////////////////////

# FLOOD CONTROL

require('COMMAND_FILES/ADMIN_COMMANDS/FLOOD_COMMANDS/flood-commands.php');


/////////////////////////




/////////////////////////

# USER COMMANDS

require ("COMMAND_FILES/USER_COMMANDS/user-commands.php");


/////////////////////////




/////////////////////////

# ADMİN COMMANDS

require ("COMMAND_FILES/ADMIN_COMMANDS/admin-commands.php");


/////////////////////////




/////////////////////////

# CREATOR COMMANDS

require ("COMMAND_FILES/CREATOR_COMMANDS/creator-commands.php");


/////////////////////////




/////////////////////////

# TEST COMMANDS

require ("TEST_COMMANDS/test-commands.php");


/////////////////////////




// leaveChat > sobetten ayrîl
// setMyCommands && deleteMyCommands && getMyCommands
// getChat > Kullanıcı ve grup bilgileri
// getChatMember > Grup ûye kontrolü
// getChatAdministrators > Yönetici bilgileri
// getChatMemberCount > Grup Üye sayısı
// setChatPermissions > Tüm ûye izinlerini değiştir
// promoteChatMember > YETKİ VERME
// setChatAdministratorCustomTitle > Yönetici adı değiştirme
// restrictChatMember > Kullanıcı kîsıtlama
// banChatMember > Ban
// unbanChatMember > Unban
//
// setChatPhoto > sohbet foto degistir && setChatTitle && setChatDescription
// deleteChatPhoto > sohbet foto sil
//
// pinChatMessage > mesaj sabitle && unpinChatMessage && unpinAllChatMessages
// /TRANSLATE EN COMMAND


?>
