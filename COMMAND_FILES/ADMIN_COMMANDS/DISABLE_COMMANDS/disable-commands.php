<?php

/////////////////////////

# DİSABLE & ENABLE & DİSABLED COMMANDS


# DİSABLE COMMAND

if ( $User_Message[0] == "/disable" or $User_Message[0] == "/disable$Bot_Username" ){
	
	User_Controls("admin","0","Change_Info");
	
	if ( $User_Message[1]){

		$disabled = $data_true["data"]["disabled"];

		foreach ($disabled as $keys => $output){
			
			if ( $disabled["$keys"]["command"] == $User_Message[1] ){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komut zaten devre dışı bırakılmış...*",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}
		}
		
		$add_disable = array(
			"command"=> "$User_Message[1]"
		);
		
		array_push($data_true["data"]["disabled"], $add_disable);
		
		$json = json_encode($data_true, JSON_PRETTY_PRINT);
		
		file_put_contents($data_location, $json);

		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "❗ `$User_Message[1]` *Adlı Komut devre dışı bırakıldı...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

		exit();

	}

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*❗ Lütfen devre dışı bırakılacak komut adını giriniz...*\n\n`/disable adminlist`",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	exit();
}


# ENABLE COMMAND

if ( $User_Message[0] == "/enable" or $User_Message[0] == "/enable$Bot_Username" ){
	
	User_Controls("admin","0","Change_Info");
	
	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);	
	$data_location = 'COMMAND_FILES/DATA_FILE/data.json';

	if ( $User_Message[1]){

		$disabled = $data_true["data"]["disabled"];

		foreach ($disabled as $keys => $output){
			
			if ( $disabled["$keys"]["command"] == $User_Message[1] ){
				
				unset($data_true["data"]["disabled"]["$keys"]);

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
				'text'=> "✅ `$User_Message[1]` *Etkinleştirildi...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);

			exit();

		}else{
	
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "❗ `$User_Message[1]` *Bulunamadı...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
	
			exit();

		}
	}

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*❗ Lütfen etkinleştirilecek komut adını giriniz...*\n\n`/enable adminlist`",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	exit();
}



# DİSABLED COMMAND

if ( $User_Message[0] == "/disabled" or $User_Message[0] == "/disabled$Bot_Username" ){
	
	User_Controls("admin","0","True");
	
	$disabled = $data_true["data"]["disabled"];
	
	foreach ($disabled as $keys => $output){
		
		$disabledCommands .= "`/".$disabled["$keys"]["command"]."`\n\n";
	}

	if(empty($disabledCommands)){
		$disabledCommands = "*❗ Bulunamadı...*\n\n";
	}

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*Dɪꜱᴀʙʟᴇᴅ Cᴏᴍᴍᴀɴᴅꜱ 🔻*\n\n──────────────\n\n\n$disabledCommands\n──────────────",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
	
	exit();
}


/////////////////////////



?>
