<?php

/////////////////////////

# VERİFY COMMANDS


if ( $User_Message[0] == "/verify" or $User_Message[0] == "/verify$Bot_Username" ){

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
	
	$messageControl = bot('sendMessage',[
		'chat_id'=>$user_id,
		'text'=> "*Dᴏɢʀᴜʟᴀᴍᴀ 🔻*\n\n──────────────\n\n*İd  »  *`$user_id`\n\n──────────────",
		'parse_mode'=>"markdown"
	]);

	$messageControlResult = $messageControl->ok;

	if ( $messageControl->ok != "1" ){

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Bᴜ ᴋᴏᴍᴜᴛᴜ ᴋᴜʟʟᴀɴᴀʙɪʟᴍᴇᴋ ɪᴄɪɴ ᴏɴᴄᴇʟɪᴋʟᴇ ʙᴏᴛᴜ ʏᴇɴɪᴅᴇɴ ʙᴀꜱʟᴀᴛᴍᴀʟɪꜱɪɴ...*\n\n[Bᴏᴛᴜ Yᴇɴɪᴅᴇɴ Bᴀꜱʟᴀᴛ](tg://user?id=$Bot_Id)",
			'parse_mode'=>"markdown",
			'disable_web_page_preview'=>"true",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

		exit();

	}

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*✅ Dᴏɢʀᴜʟᴀᴍᴀ Mᴇꜱᴀᴊɪ ʙᴏᴛᴀ ɢᴏɴᴅᴇʀɪʟᴅɪ...*",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	exit();


}

/////////////////////////



?>
