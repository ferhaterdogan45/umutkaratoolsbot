<?php


/////////////////////////

# SET WEBHOOK COMMAND


if ( $User_Message[0] == "/setWebhook" or $User_Message[0] == "/setWebhook$Bot_Username" ){
	
	User_Controls("creator","0","0","private");

	if (!$User_Message[1]){
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Url Girilmedi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();

	}

	if (!preg_match("/^https:\/\/[^,]*\/index.php\b/", $User_Message[1])){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Hatalı Url Girildi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}


	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "──────────────\n\n*Webhook adresi değiştirildi. 🔻*\n\n`$User_Message[1]`\n\n──────────────",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	bot("setWebhook",[
		'url'=>$User_Message[1]
	]);
	exit();
}

/////////////////////////




/////////////////////////

# GET WEBHOOK COMMAND


if ( $User_Message[0] == "/getWebhook" or $User_Message[0] == "/getWebhook$Bot_Username" ){
	
	User_Controls("creator","0","0","private");

	$result = bot("getWebhookInfo");

	$url = $result->result->url;



	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*Gᴇᴛ Wᴇʙʜᴏᴏᴋ Iɴғᴏ 🔻*\n\n──────────────\n\n*Uʀʟ 🔻*`\n\n$url`\n\n──────────────",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

}

/////////////////////////




/////////////////////////

# WEBHOOK COMMANDS İNFO


$webhookCommands_info = ("
*Wᴇʙʜᴏᴏᴋ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/setWebhook`

`/getWebhook`

──────────────
");



if ( $User_Message[0] == "/webhookCommands" or $User_Message[0] == "/webhookCommands$Bot_Username" ){

	User_Controls("creator");

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$webhookCommands_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
}




/////////////////////////


?>
