<?php

/////////////////////////

# WELCOME MESSAGE COMMANDS


if ( $User_Message[0] == "/welcomeMessage" or $User_Message[0] == "/welcomeMessage$Bot_Username" ){

	User_Controls("creator");
	
	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'),true);
	
	$data_location = 'COMMAND_FILES/DATA_FILE/data.json';
	

	Explode_Message();
	
	$new_welcomeMessage = NAME.REASON;


	foreach ($data["data"]["greetings"]["welcome"] as $keys => $value){
		
		if ($new_welcomeMessage){
			
			if ( NAME != "|code" ){
				unset($data["data"]["greetings"]["welcome"]["$keys"]);
			}
			
			$status = "True";

			break;
		}
	}

	$original_welcomeMessage = $data["data"]["greetings"]["welcome"]["$keys"]["text"];

	$_welcomeMessage_ = str_replace('{first_name}',"[$first_name](tg://user?id=$user_id)", $original_welcomeMessage);

	if ( NAME == "|code" ){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "<code>$original_welcomeMessage</code>",
			'parse_mode'=>"html",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();

	}

	
	if (! $new_welcomeMessage){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "Oʀɪɢɪɴᴀʟ Wᴇʟᴄᴏᴍᴇ Mᴇꜱꜱᴀɢᴇ🔻\n\n──────────────\n\n\n$_welcomeMessage_\n\n\n──────────────",
			'reply_markup'=>json_encode([
				'inline_keyboard'=>[
				[['text'=>"Kᴏᴍᴜᴛʟᴀʀ",
				'callback_data'=>"commands"]]]]),
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}
	
	
	$welcomeMessage = str_replace(["code#","#code"],["`","`"],$new_welcomeMessage);

	$_welcomeMessage_ = str_replace('{first_name}',"[$first_name](tg://user?id=$user_id)", $welcomeMessage);

	if ( DATA_TYPE == "0" ){
		
		$add = array(
		"data_id"=> "\n",
		"name"=> "welcome",
		"text"=> "$welcomeMessage",
		"type"=> "0"
		);
		
		array_push($data["data"]["greetings"]["welcome"], $add);
		
		$json = json_encode($data, JSON_PRETTY_PRINT);
				
		file_put_contents($data_location, $json);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "Nᴇᴡ Wᴇʟᴄᴏᴍᴇ Mᴇꜱꜱᴀɢᴇ 🔻\n\n──────────────\n\n\n$_welcomeMessage_\n\n\n──────────────",
			'reply_markup'=>json_encode([
				'inline_keyboard'=>[
				[['text'=>"Kᴏᴍᴜᴛʟᴀʀ",
				'callback_data'=>"commands"]]]]),
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();

	}else{


		$add = array(
		"data_id"=> "".DATA_ID."",
		"name"=> "welcome",
		"text"=> "$welcomeMessage",
		"type"=> DATA_TYPE
		);
		
		array_push($data["data"]["greetings"]["welcome"], $add);
		
		$json = json_encode($data, JSON_PRETTY_PRINT);
				
		file_put_contents($data_location, $json);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "Nᴇᴡ Wᴇʟᴄᴏᴍᴇ Mᴇꜱꜱᴀɢᴇ 🔻\n\n──────────────\n\n\n$_welcomeMessage_\n\n\n──────────────",
			'reply_markup'=>json_encode([
				'inline_keyboard'=>[
				[['text'=>"Kᴏᴍᴜᴛʟᴀʀ",
				'callback_data'=>"commands"]]]]),
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}
}



/////////////////////////



?>
