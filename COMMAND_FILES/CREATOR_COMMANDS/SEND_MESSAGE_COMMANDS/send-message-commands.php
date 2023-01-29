<?php

/////////////////////////

# SEND MESSAGE COMMAND

if ( $User_Message[0] == "/sendMessage" or $User_Message[0] == "/sendMessage$Bot_Username" ){

	User_Controls("creator");
	
	$_name = preg_split('/ |\r|\n/', _TEXT);
	
	if ( preg_match('/^"/', $_name[1])){
			
		$_name = explode ('"', _TEXT);
		$control = "true";
		
	}
	
	$name = $_name[1];

	$User_Message = _USER_MESSAGE;

	if ($control == "true"){
			
		$reason = str_replace("$User_Message[0] \"$name\"","", _TEXT);
		
	}else{
		
		$reason = str_replace("$User_Message[0] $name","", _TEXT);
	
	}

	if (empty($reason) or empty($name)){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Sᴇɴᴅ Mᴇꜱꜱᴀɢᴇ 🔻*\n\n──────────────\n\n`/sendMessage \"Name 🔻\"\n\nMessages`\n\n──────────────\n\n`/sendMessage false\n\nMessages`\n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();

	}
if ($name != "false"){
	$messages = ("

*$name*

──────────────
`$reason`

──────────────
");
}else{
	$messages = $reason;
}

	if ( DATA_TYPE == "0" ){
		
		bot('sendMessage',[
			'chat_id'=>CONFIG_CHAT_ID,
			'text'=> "$messages",
			'parse_mode'=>"markdown"
		]);
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Sᴇɴᴅ Mᴇꜱꜱᴀɢᴇ 🔻*\n\n──────────────\n\n`✅ Mᴇꜱᴀᴊ Gᴏɴᴅᴇʀɪʟᴅɪ...`\n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

		exit();

	}else{
		
		if ( DATA_TYPE == "1" ){
			$method = "photo";
			$methodName = "sendPhoto";
		}

		if ( DATA_TYPE == "2" ){
			$method = "video";
			$methodName = "sendVideo";
		}

		if ( DATA_TYPE == "3" ){
			$method = "document";
			$methodName = "sendDocument";
		}
		
		bot("$methodName",[
			'chat_id'=>CONFIG_CHAT_ID,
			"$method"=>DATA_ID,
			'caption'=>$messages,
			'parse_mode'=>"markdown",
			'disable_web_page_preview'=>"true"
		]);

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Sᴇɴᴅ Mᴇꜱꜱᴀɢᴇ 🔻*\n\n──────────────\n\n`✅ Mᴇꜱᴀᴊ Gᴏɴᴅᴇʀɪʟᴅɪ...`\n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

		exit();
	}
}

/////////////////////////



?>
