<?php



/////////////////////////

# PİN COMMANDS


if ( $User_Message[0] == "/pin" or $User_Message[0] == "/pin$Bot_Username" ){
	
	User_Controls("admin","0","Pin_Messages");
	
	//User_Controls("0","0","0","supergroup");
	
	if($reply_message_id){	

		bot('pinChatMessage',[
			'chat_id'=>_CHAT_ID,
			'message_id'=>$reply_message_id,
			'disable_notification'=>"false"
		]);

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*✅ Mesaj Sabitlendi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);


		exit();
	}

	if(isset($User_Message[1]) and $user_id == $creator_id ){

		if (preg_match("/^https:\/\/t.me\/umutkaratools\/\d+\$/",$User_Message[1])){

			$MessageId = explode("https://t.me/umutkaratools/", $User_Message[1]);
	
			bot('pinChatMessage',[
				'chat_id'=>CONFIG_CHAT_ID,
				'message_id'=>$MessageId[1]
			]);
			
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*✅ Mesaj Sabitlendi...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
			
			exit();
		}else{
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*Hᴀᴛᴀʟɪ ʟɪɴᴋ ❗*\n\n──────────────\n\n✅ `/pin https://t.me/umutkaratools/106`\n\n──────────────",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);

			exit();
		
		}
	}

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*❗ Lütfen sabitlenecek mesajı yanıtlayın...*",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
	exit();

}



/////////////////////////




/////////////////////////

# UNPİN COMMANDS


if ( $User_Message[0] == "/unpin" or $User_Message[0] == "/unpin$Bot_Username" ){
	
	User_Controls("admin","0","Pin_Messages");
	
	User_Controls("0","0","0","supergroup");
		
	if($User_Message[1] == "all"){
		bot('unpinAllChatMessages',[
			'chat_id'=>_CHAT_ID
		]);

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Sabitlenen Tüm Mesajlar Kaldırıldı...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

		exit();
	}

	if($reply_message_id){
		bot('unpinChatMessage',[
			'chat_id'=>_CHAT_ID,
			'message_id'=>$reply_message_id
		]);

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Sabitlenen Mesaj Kaldırıldı...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

		exit();
	}

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*❗ Lütfen sabitten kaldırılacak mesajı yanıtlayın...*",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
	exit();

}



/////////////////////////

?>
