<?php


/////////////////////////

# NEW FONT COMMANDS

if ( $User_Message[0] == "/newFont" or $User_Message[0] == "/newFont$Bot_Username" ){

	User_Controls("admin","0","True");

	if ( $User_Message[1] ){

		Explode_Message();

		$text =  NAME.REASON;

		$newFont = str_replace(
	[
		'a','b','c','ç','d','e','f','g','ğ','h','i','ı','j','k','l','m','n','o','ö','p','r','s','ş','t','u','ü','v','y','z','A','B','C','Ç','D','E','F','G','Ğ','H','İ','I','J','K','L','M','N','O','Ö','P','R','S','Ş','T','U','Ü','V','Y','Z'
	],[
		'ᴀ','ʙ','ᴄ','ᴄ','ᴅ','ᴇ','ғ','ɢ','ɢ','ʜ','ɪ','ɪ','ᴊ','ᴋ','ʟ','ᴍ','ɴ','ᴏ','ᴏ','ᴘ','ʀ','ꜱ','ꜱ','ᴛ','ᴜ','ᴜ','ᴠ','ʏ','ᴢ','A','B','C','C','D','E','F','G','G','H','I','I','J','K','L','M','N','O','O','P','R','S','S','T','U','U','V','Y','Z'
	], $text);

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "<b>Nᴇᴡ Fᴏɴᴛ 🔻</b>\n\n──────────────\n\n<code>$newFont</code>\n\n──────────────",
			'parse_mode'=>"html",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}else{
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "<b>Nᴇᴡ Fᴏɴᴛ 🔻</b>\n\n──────────────\n\n<code>/newFont \nTest </code>\n\n──────────────",
			'parse_mode'=>"html",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

	}

}

/////////////////////////


?>
