<?php


/////////////////////////

# INSTAGRAM PROFİLE COMMAND


if ( $User_Message[0] == "/instagramProfile" or $User_Message[0] == "/instagramProfile$Bot_Username" ){

	if (empty($User_Message[1])){
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Iɴꜱᴛᴀɢʀᴀᴍ Pʀᴏғɪʟ Bᴜʟ 🔻\n\n──────────────\n\n❗ Kᴜʟʟᴀɴɪᴄɪ Aᴅɪ Gɪʀɪɴɪᴢ...\n\n*`/instagramProfile umutkaratools`*\n\n──────────────*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();

	}
	
	//$url = json_decode(file_get_contents("https://instagram.ozgurozalp.com/search.php?query=$User_Message[1]"));

	$url = "https://instagram.ozgurozalp.com/search.php?query=$User_Message[1]";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json') );
	$data = json_decode(curl_exec($ch));
	curl_close($ch);

	$name = $data->fullName;
	
	$photo = $data->picture;
	

	if (empty($photo)){
		bot("sendMessage",[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Iɴꜱᴛᴀɢʀᴀᴍ Pʀᴏғɪʟᴇ 🔻\n\n──────────────\n\n❗* `$User_Message[1]` *Aᴅʟɪ Kᴜʟʟᴀɴɪᴄɪ Bᴜʟᴜɴᴀᴍᴀᴅɪ...\n\n──────────────*",
			'parse_mode'=>"markdown"
		]);
		
		exit();	

	}

	$userControl = bot('getChat',['chat_id'=>$user_id]);

	if ( $userControl->ok != "1" ){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Bᴜ ᴋᴏᴍᴜᴛᴜ ᴋᴜʟʟᴀɴᴀʙɪʟᴍᴇᴋ ɪᴄɪɴ ᴏɴᴄᴇʟɪᴋʟᴇ ʙᴏᴛᴜ ʙᴀꜱʟᴀᴛᴍᴀʟɪꜱɪɴ...*\n\n[Bᴏᴛᴜ Bᴀꜱʟᴀᴛ](tg://user?id=$Bot_Id)",
			'parse_mode'=>"markdown",
			'disable_web_page_preview'=>"true",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

		exit();
	}
	
	$messageControl = bot("sendPhoto",[
		'chat_id'=>$user_id,
		'photo'=>"$photo",
		'caption'=> "*Iɴꜱᴛᴀɢʀᴀᴍ Pʀᴏғɪʟᴇ 🔻\n\n──────────────\n\n✅* `$name` *\n\n──────────────*",
		'parse_mode'=>"markdown",
		'disable_web_page_preview'=>"true"
	]);

	$messageControlResult = $messageControl->ok;

	if ( $messageControl->ok != "1"  ){

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Bᴜ ᴋᴏᴍᴜᴛᴜ ᴋᴜʟʟᴀɴᴀʙɪʟᴍᴇᴋ ɪᴄɪɴ ᴏɴᴄᴇʟɪᴋʟᴇ ʙᴏᴛᴜ ʏᴇɴɪᴅᴇɴ ʙᴀꜱʟᴀᴛᴍᴀʟɪꜱɪɴ...*\n\n[Bᴏᴛᴜ Yᴇɴɪᴅᴇɴ Bᴀꜱʟᴀᴛ](tg://user?id=$Bot_Id)",
			'parse_mode'=>"markdown",
			'disable_web_page_preview'=>"true",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

		exit();

	}
	
	if ($chat_type != "private"){

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*✅ Iɴꜱᴛᴀɢʀᴀᴍ Pʀᴏғɪʟᴇ Kᴏᴍᴜᴛ Mᴇꜱᴀᴊɪ ʙᴏᴛᴀ ɢᴏɴᴅᴇʀɪʟᴅɪ...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

	}
	
	exit();

}

/////////////////////////


?>
