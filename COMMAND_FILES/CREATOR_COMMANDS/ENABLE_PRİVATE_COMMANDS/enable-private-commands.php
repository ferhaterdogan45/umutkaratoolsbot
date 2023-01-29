<?php

/////////////////////////

# DİSABLE & ENABLE & ENABLED PRİVATE COMMANDS


# ENABLE PRİVATE COMMAND

if ( $User_Message[0] == "/enablePrivate" or $User_Message[0] == "/enablePrivate$Bot_Username" ){

	User_Controls("creator");

	if ( $User_Message[1]){

		$enabledPrivate = $data_true["data"]["enabledPrivate"];

		foreach ($enabledPrivate as $keys => $output){

			if ( $enabledPrivate["$keys"]["command"] == $User_Message[1] ){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "`$User_Message[1]` *❗ Bu Komut zaten etkinleştirilmiş...*",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}
		}

		$add_enable = array(
			"command"=> "$User_Message[1]"
		);

		array_push($data_true["data"]["enabledPrivate"], $add_enable);

		$json = json_encode($data_true, JSON_PRETTY_PRINT);

		file_put_contents($data_location, $json);

		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "✅ `$User_Message[1]` *Adlı Komut etkinleştirildi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

		exit();

	}

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*❗ Lütfen Etkinleştirilecek komut adını giriniz...*\n\n`/enablePrivate adminlist`",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	exit();
}


# DİSABLE PRİVATE  COMMAND

if ( $User_Message[0] == "/disablePrivate" or $User_Message[0] == "/disablePrivate$Bot_Username" ){

	User_Controls("creator");

	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	$data_location = 'COMMAND_FILES/DATA_FILE/data.json';

	if ( $User_Message[1]){

		$enabledPrivate = $data_true["data"]["enabledPrivate"];

		foreach ($enabledPrivate as $keys => $output){

			if ( $enabledPrivate["$keys"]["command"] == $User_Message[1] ){

				unset($data_true["data"]["enabledPrivate"]["$keys"]);

				$status = "True";

				break;

			}
		}

		if ($status == "True"){

			$json = json_encode($data_true, JSON_PRETTY_PRINT);

			file_put_contents($data_location, $json);

			file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "❗ `$User_Message[1]` *Adlı komut devre dışı bırakıldı...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);

			exit();

		}else{

			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "❗ `$User_Message[1]` *Adlı komut bulunamadı...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);

			exit();

		}
	}

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*❗ Lütfen devre dışı bırakılacak komut adını giriniz...*\n\n`/disablePrivate adminlist`",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	exit();
}



# ENABLED PRİVATE COMMAND

if ( $User_Message[0] == "/enabledPrivate" or $User_Message[0] == "/enabledPrivate$Bot_Username" ){

	//User_Controls("admin","0","True");

	$enabledPrivate = $data_true["data"]["enabledPrivate"];

	foreach ($enabledPrivate as $keys => $output){

		$enabledPrivateCommands .= "`/".$enabledPrivate["$keys"]["command"]."`\n\n";
	}
	
	if(empty($enabledPrivateCommands)){
		$enabledPrivateCommands = "*❗ Bulunamadı...*\n\n";
	}

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*Eɴᴀʙʟᴇᴅ Pʀɪᴠᴀᴛᴇ Cᴏᴍᴍᴀɴᴅꜱ 🔻*\n\n──────────────\n\n\n$enabledPrivateCommands\n──────────────",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	exit();
}


/////////////////////////


?>
