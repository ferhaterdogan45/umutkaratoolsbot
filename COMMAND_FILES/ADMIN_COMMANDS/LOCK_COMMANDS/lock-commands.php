<?php

function Lock_Controls($command="0",$parameter="0",$authority="0",$closing="0",$opening="0") {

	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'));

	$data_location = 'COMMAND_FILES/DATA_FILE/data.json';

	$json = json_encode($data, JSON_PRETTY_PRINT);

	$locks = $data->data->locks;
	
	$autoAll = $locks->locks_autoAll;
	
	$autoAll_closing = $locks->locks_autoAll_closing;
	
	$autoAll_opening = $locks->locks_autoAll_opening;
	
	$autoAll_control = $locks->locks_autoAll_control;
	
	$all = $locks->locks_all;

	$anonChannel = $locks->locks_anonChannel;
	
	$telegram_url = $locks->locks_telegram_url;

	$voice = $locks->locks_voice;

	$audio = $locks->locks_audio;

	if ($command == "locks" and $parameter == "0" ){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Lᴏᴄᴋꜱ 🔻*\n\n──────────────\n\n\n*AutoAll »* `$autoAll`\n\n*Duration »* `$autoAll_closing $autoAll_opening`\n\n*All »* `$all`\n\n*Anon Channel »* `$anonChannel`\n\n*Telegram Url »* `$telegram_url`\n\n*Voice »* `$voice`\n\n*Audio »* `$audio`\n\n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}	
	
	if ($anonChannel == "true" and $authority == "0" and SENDER_CHAT_STATUS == "true"){
		
		bot('sendMessage',[
			'chat_id'=>CONFIG_PRIVATE_CHAT_ID,
			'text'=> "*Lᴏᴄᴋ Cᴏɴᴛʀᴏʟꜱ 🔻*\n\n──────────────\n\n*Lᴏᴄᴋ Nᴀᴍᴇ »* `Anon Channel`\n\n──────────────\n\n*Cʜᴀɴɴᴇʟ 🔻*\n\n[".SENDER_CHAT_TITLE."](t.me/".SENDER_CHAT_USERNAME.")\n\n*Mᴇꜱꜱᴀɢᴇ 🔻*\n\n`"._TEXT."`\n\n──────────────\n──────────────",
			'parse_mode'=>"markdown",
			'disable_web_page_preview'=>"true"
		]);

		bot('deleteMessage',[
			'chat_id'=>_CHAT_ID,
			'message_id'=>_MESSAGE_ID
		]);
			
		bot('banChatSenderChat',[
			'chat_id'=>_CHAT_ID,
			'sender_chat_id'=>SENDER_CHAT_ID
		]);

		exit();
	}	


	if ($telegram_url == "true" and $authority == "0"){
		if(preg_match("/t\.me\/[a-z]/i", _TEXT)){
			
			User_Controls("member");
			
			if ( USER_STATUS == "member" ){
				
				bot('sendMessage',[
					'chat_id'=>CONFIG_PRIVATE_CHAT_ID,
					'text'=> "*Lᴏᴄᴋ Cᴏɴᴛʀᴏʟꜱ 🔻*\n\n──────────────\n\n*Lᴏᴄᴋ Nᴀᴍᴇ »* `Telegram Url`\n\n──────────────\n\n*Uꜱᴇʀ 🔻*\n\n["._USER_FIRST_NAME[0]."](tg://user?id="._USER_ID.")\n\n*Mᴇꜱꜱᴀɢᴇ 🔻*\n\n`"._TEXT."`\n\n[Bᴏᴛ Mᴇꜱꜱᴀɢᴇ Lɪɴᴋ](https://t.me/c/"._CHAT_ID_."/"._MESSAGE_ID_.")\n\n──────────────\n──────────────",
					'parse_mode'=>"markdown",
					'disable_web_page_preview'=>"true"
				]);

				bot('deleteMessage',[
					'chat_id'=>_CHAT_ID,
					'message_id'=>_MESSAGE_ID
				]);

				$reply = "*Telegram link paylaşımı yasak ❗*";

				WARNS("warn","$reply","0","0");

			}
		}
	}

	if ($voice == "true" and $authority == "0" and VOICE_STATUS == "true"){
		User_Controls("member");
		
		if ( USER_STATUS == "member" ){

			bot('sendVoice',[
				'chat_id'=>CONFIG_PRIVATE_CHAT_ID,
				'voice'=>VOICE_DATA_ID,
				'caption'=> "*Lᴏᴄᴋ Cᴏɴᴛʀᴏʟꜱ 🔻*\n\n──────────────\n\nLᴏᴄᴋ Nᴀᴍᴇ » `Voice`\n\n──────────────\n\n*Uꜱᴇʀ 🔻*\n\n["._USER_FIRST_NAME[0]."](tg://user?id="._USER_ID.")\n\n[Bᴏᴛ Mᴇꜱꜱᴀɢᴇ Lɪɴᴋ](https://t.me/c/"._CHAT_ID_."/"._MESSAGE_ID_.")\n\n──────────────\n──────────────",
				'parse_mode'=>"markdown",
				'disable_web_page_preview'=>"true"
			]);

			bot('deleteMessage',[
				'chat_id'=>_CHAT_ID,
				'message_id'=>_MESSAGE_ID
			]);

			$reply = "*Sesli mesaj paylaşımı yasak ❗*";

			WARNS("warn","$reply","0","0");

		}
	}	

	if ($audio == "true" and $authority == "0" and AUDIO_STATUS == "true"){
		User_Controls("member");
		
		if ( USER_STATUS == "member" ){

			bot('sendAudio',[
				'chat_id'=>CONFIG_PRIVATE_CHAT_ID,
				'audio'=>AUDIO_DATA_ID,
				'caption'=> "*Lᴏᴄᴋ Cᴏɴᴛʀᴏʟꜱ 🔻*\n\n──────────────\n\nLᴏᴄᴋ Nᴀᴍᴇ » `Audio`\n\n──────────────\n\n*Uꜱᴇʀ 🔻*\n\n["._USER_FIRST_NAME[0]."](tg://user?id="._USER_ID.")\n\n[Bᴏᴛ Mᴇꜱꜱᴀɢᴇ Lɪɴᴋ](https://t.me/c/"._CHAT_ID_."/"._MESSAGE_ID_.")\n\n──────────────\n──────────────",
				'parse_mode'=>"markdown",
				'disable_web_page_preview'=>"true"
			]);

			bot('deleteMessage',[
				'chat_id'=>_CHAT_ID,
				'message_id'=>_MESSAGE_ID
			]);

			$reply = "*Müzik paylaşımı yasak ❗*";

			WARNS("warn","$reply","0","0");

		}
	}	

	if ($autoAll == "true" and $autoAll_control == "true" and $authority == "0" ){
		if( _DATE_ >= $autoAll_closing and _DATE_ <= $autoAll_opening ){
			bot('setChatPermissions',[
				'chat_id'=>_CHAT_ID,
				'permissions'=>json_encode([
					'can_send_messages'=>false,
					'can_send_media_messages'=>false,
					'can_send_polls'=>false,
					'can_send_other_messages'=>false,
					'can_add_web_page_previews'=>false,
					'can_change_info'=>false,
					'can_invite_users'=>true,
					'can_pin_messages'=>false
				])]);

			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*Cʜᴀᴛ Cᴏɴᴛʀᴏʟ 🔻*\n\n──────────────\n\n*Kapanış  »*  `$autoAll_closing`\n\n*Açılış  »*  `$autoAll_opening`\n\n*Yarın Açılış saatinde alttaki butona basarak grubu açabilirsiniz...*\n\n──────────────",
				'reply_markup'=>json_encode([
					'inline_keyboard'=>[[[
						'text'=>"Gʀᴜʙᴜ ᴀᴄ",
						'callback_data'=>"autoAll"]]]]),
				'parse_mode'=>"markdown"
			]);
			
			sendCommand (CONFIG_LOG_CHAT_ID,"document","COMMAND_FILES/DATA_FILE/data.json","Dᴀᴛᴀʙᴀꜱᴇ Fɪʟᴇ","*✅ Dᴏwɴʟᴏᴀᴅ » * `data.json`");
			sendCommand (CONFIG_LOG_CHAT_ID,"document","COMMAND_FILES/DATA_FILE/members.json","Dᴀᴛᴀʙᴀꜱᴇ Fɪʟᴇ","*✅ Dᴏwɴʟᴏᴀᴅ » * `members.json`");
			
			//$replace = str_replace('"locks_autoAll_control": "true"','"locks_autoAll_control": "false"',$json);
			
			$replace = str_replace([
				"\"locks_all\": \"$all\"",
				"\"locks_autoAll_control\": \"$autoAll_control\""
			],[
				"\"locks_all\": \"true\"",
				"\"locks_autoAll_control\": \"false\""
			],$json);

			file_put_contents($data_location, $replace);
			
			file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");
			exit();
		}
	}


	if ($command == "lock" and $parameter == "autoAll" ){

		$replace = str_replace([
			"\"locks_autoAll\": \"$autoAll\"",
			"\"locks_autoAll_closing\": \"$autoAll_closing\"",
			"\"locks_autoAll_opening\": \"$autoAll_opening\"",
			"\"locks_autoAll_control\": \"$autoAll_control\""
		],[
			"\"locks_autoAll\": \"true\"",
			"\"locks_autoAll_closing\": \"$closing\"",
			"\"locks_autoAll_opening\": \"$opening\"",
			"\"locks_autoAll_control\": \"true\""
		],$json);
		
		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Aᴜᴛᴏ Aʟʟ Lᴏᴄᴋ 🔻*\n\n──────────────\n\n*Closing  »*  `$closing`\n\n*Opening  »*  `$opening`\n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	if ($command == "lock" and $parameter == "all" ){
		
		$replace = str_replace('"locks_all": "false"','"locks_all": "true"',$json);
		
		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");
		
		bot('setChatPermissions',[
		'chat_id'=>_CHAT_ID,
		'permissions'=>json_encode([
			'can_send_messages'=>false,
			'can_send_media_messages'=>false,
			'can_send_polls'=>false,
			'can_send_other_messages'=>false,
			'can_add_web_page_previews'=>false,
			'can_change_info'=>false,
			'can_invite_users'=>true,
			'can_pin_messages'=>false
		
		])]);
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Chat Kilitlendi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	if ($command == "lock" and $parameter == "anonChannel" ){
	
		$replace = str_replace('"locks_anonChannel": "false"','"locks_anonChannel": "true"',$json);
		
		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ AnonChannel kilitlendi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	if ($command == "lock" and $parameter == "telegram_url" ){
	
		$replace = str_replace('"locks_telegram_url": "false"','"locks_telegram_url": "true"',$json);
		
		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Telegram url kilitlendi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	if ($command == "lock" and $parameter == "voice" ){
	
		$replace = str_replace('"locks_voice": "false"','"locks_voice": "true"',$json);
		
		file_put_contents($data_location, $replace);

		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Voice kilitlendi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	if ($command == "lock" and $parameter == "audio" ){
	
		$replace = str_replace('"locks_audio": "false"','"locks_audio": "true"',$json);
		
		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Audio kilitlendi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	if ($command == "unlock" and $parameter == "autoAll" ){
			
		$replace = str_replace([
			"\"locks_all\": \"$all\"",
			"\"locks_autoAll\": \"$autoAll\"",
			"\"locks_autoAll_control\": \"$autoAll_control\""
		],[
			"\"locks_all\": \"false\"",
			"\"locks_autoAll\": \"false\"",
			"\"locks_autoAll_control\": \"false\""
		],$json);

		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('setChatPermissions',[
		'chat_id'=>_CHAT_ID,
		'permissions'=>json_encode([
			'can_send_messages'=>true,
			'can_send_media_messages'=>true,
			'can_send_polls'=>true,
			'can_send_other_messages'=>true,
			'can_add_web_page_previews'=>true,
			'can_change_info'=>false,
			'can_invite_users'=>true,
			'can_pin_messages'=>false
		
		])]);
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*✅ Otomatik chat kapatma kilidi devre dışı bırakıldı...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}


	if ($command == "unlock" and $parameter == "all" ){
			
		$replace = str_replace('"locks_all": "true"','"locks_all": "false"',$json);
		
		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('setChatPermissions',[
		'chat_id'=>_CHAT_ID,
		'permissions'=>json_encode([
			'can_send_messages'=>true,
			'can_send_media_messages'=>true,
			'can_send_polls'=>true,
			'can_send_other_messages'=>true,
			'can_add_web_page_previews'=>true,
			'can_change_info'=>false,
			'can_invite_users'=>true,
			'can_pin_messages'=>false
		
		])]);
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*✅ Chat Açıldı...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	if ($command == "unlock" and $parameter == "anonChannel" ){
	
		$replace = str_replace('"locks_anonChannel": "true"','"locks_anonChannel": "false"',$json);
		
		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*✅ AnonChannel kilidi açıldı...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	if ($command == "unlock" and $parameter == "telegram_url" ){
	
		$replace = str_replace('"locks_telegram_url": "true"','"locks_telegram_url": "false"',$json);
		
		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*✅ Telegram url kilidi açıldı...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	if ($command == "unlock" and $parameter == "voice" ){
	
		$replace = str_replace('"locks_voice": "true"','"locks_voice": "false"',$json);
		
		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*✅ Voice kilidi açıldı...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	if ($command == "unlock" and $parameter == "audio" ){
	
		$replace = str_replace('"locks_audio": "true"','"locks_audio": "false"',$json);
		
		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*✅ Audio kilidi açıldı...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}


	if ($command == "lock" and $parameter != "0" ){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "❗ *Hatalı parametre girildi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	if ($command == "unlock" and $parameter != "0" ){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "❗ *Hatalı parametre girildi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}	

}

if (!$callback_data and $chat_type == "supergroup" and _CHAT_ID == CONFIG_CHAT_ID ){
	Lock_Controls();
}


if( $callback_data and $callback_result[0] == "autoAll"){

	$autoAll_opening = $data->data->locks->locks_autoAll_opening;

	if ( _DATE_ >= $autoAll_opening ){
	
		bot('setChatPermissions',[
		'chat_id'=>_CHAT_ID,
		'permissions'=>json_encode([
			'can_send_messages'=>true,
			'can_send_media_messages'=>true,
			'can_send_polls'=>true,
			'can_send_other_messages'=>true,
			'can_add_web_page_previews'=>true,
			'can_change_info'=>false,
			'can_invite_users'=>true,
			'can_pin_messages'=>false
		
		])]);
		
		$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'));

		$data_location = 'COMMAND_FILES/DATA_FILE/data.json';

		$json = json_encode($data, JSON_PRETTY_PRINT);

		$replace = str_replace([
			"\"locks_all\": \"true\"",
			"\"locks_autoAll_control\": \"false\""
		],[
			"\"locks_all\": \"false\"",
			"\"locks_autoAll_control\": \"true\""
		],$json);

		file_put_contents($data_location, $replace);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('editMessageText',[
			'chat_id'=>$callback_chat_id,
			'message_id'=>$callback_message_id,
			'text'=>"*Merhaba* [$callback_first_name_](tg://user?id=$callback_user_id) *grubu açma görevini üstlendiğin için teşekkürler. :)*",
			'parse_mode'=>"markdown"
		]);

		exit();

	}else{

		bot('answerCallbackQuery',[
			'callback_query_id'=>$callback_id,
			'text'=>"❗ Grup açılış saati $autoAll_opening ❗",
			'show_alert'=>"true"
		]);

		exit();

	}
}

/////////////////////////

# LOCKS COMMANDS


if ( $User_Message[0] == "/locks" or $User_Message[0] == "/locks$Bot_Username" ){

	User_Controls("admin","0","True");
	Lock_Controls("locks","0","admin");
}

/////////////////////////




/////////////////////////

# LOCK COMMANDS


if ( $User_Message[0] == "/lock" or $User_Message[0] == "/lock$Bot_Username" ){

	User_Controls("admin","0","Change_Info");

	if ( $User_Message[1] == "autoAll"){

		$duration = $User_Message[2]." ".$User_Message[3];

		if ( preg_match("/^[0-9][0-9]:[0-9][0-9]:[0-9][0-9] [0-9][0-9]:[0-9][0-9]:[0-9][0-9]\b/", $duration)){
			
			Lock_Controls("lock","$User_Message[1]","admin","$User_Message[2]","$User_Message[3]");
			exit();
		
		}else{

			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*Lᴏᴄᴋꜱ Cᴏᴍᴍᴀɴᴅꜱ 🔻*\n\n──────────────\n\n\n`/lock autoAll 01:00:00 08:00:00`\n\n`/lock all`\n\n`/lock anonChannel`\n\n`/lock telegram_url`\n\n`/lock voice`\n\n`/lock audio`\n\n\n──────────────",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
			exit();
		}
	}

	if ( $User_Message[1] ){
		Lock_Controls("lock","$User_Message[1]","admin");
	}else{
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Lᴏᴄᴋꜱ Cᴏᴍᴍᴀɴᴅꜱ 🔻*\n\n──────────────\n\n\n`/lock autoAll 01:00:00 08:00:00`\n\n`/lock all`\n\n`/lock anonChannel`\n\n`/lock telegram_url`\n\n`/lock voice`\n\n`/lock audio`\n\n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();

	}
}

/////////////////////////




/////////////////////////

# UNLOCK COMMANDS

if ( $User_Message[0] == "/unlock" or $User_Message[0] == "/unlock$Bot_Username" ){
	User_Controls("admin","0","Change_Info");
	
	if ( $User_Message[1] ){
		Lock_Controls("unlock","$User_Message[1]");
	}else{
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Uɴʟᴏᴄᴋ Cᴏᴍᴍᴀɴᴅꜱ 🔻*\n\n──────────────\n\n\n`/unlock autoAll`\n\n`/unlock all`\n\n`/unlock anonChannel`\n\n`/unlock telegram_url`\n\n`/unlock voice`\n\n`/unlock audio`\n\n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();

	}

}

/////////////////////////



?>
