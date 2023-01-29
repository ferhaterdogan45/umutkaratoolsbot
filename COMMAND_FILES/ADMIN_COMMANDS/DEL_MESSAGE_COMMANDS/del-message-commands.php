<?php


/////////////////////////

# DELETE MESSAGE COMMANDS

if ( $User_Message[0] == "/delMessage" or $User_Message[0] == "/delMessage$Bot_Username" ){

	User_Controls("admin","0","True");

	User_Controls("0","0","0","supergroup");
	
	if ( $reply_message_id ){
		
		if ($reply_message_id <= $message_id-100 ){
			
			bot('sendMessage',[
				'chat_id'=>$chat_id,
				'text'=> "*❗ Tek Seferde Sadece 100 Mesaj Silinebiliyor..*",
				'parse_mode'=>"markdown"
			]);

			exit();
		}

		for ($i = $reply_message_id; $i <= $message_id; $i++) {
			
			bot('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$i
			]);
		}
		
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=> "*✅ Mesajlar Silindi...*",
			'parse_mode'=>"markdown"
		]);

		exit();

	}

	if (preg_match("/[0-9]/", $User_Message[1])){
		
		for ($i = $message_id-$User_Message[1]; $i <= $message_id; $i++) {
			
			bot('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$i
			]);
		}
		
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=> "*✅ Mesajlar Silindi..*",
			'parse_mode'=>"markdown"
		]);

		exit();


	}
	
	bot('sendMessage',[
		'chat_id'=>$chat_id,
		'text'=> "*❗ Başlangıç mesajını yanıtla veya* `/delMessage 5` *Sayı belirt...*",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>$message_id
	]);

	exit();
}


/////////////////////////



?>
