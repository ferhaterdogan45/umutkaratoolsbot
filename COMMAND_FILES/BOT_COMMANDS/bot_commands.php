<?php

/////////////////////////

# BOT COMMANDS




/////////////////////////
	
# COMMANDS  CONTROL


if ($commands_file->data->bot_commands->{$User_Message[0]}){
	
	$bot_commands = $commands_file->data->bot_commands->{$User_Message[0]};
	$permission = $bot_commands->permission;

	$_Controls->admin();

	if (!preg_match("/"._admin_status."/", $permission)){
		if ($permission == "creator"){
			$permission_message = "Bot Sahibi Tarafından";
		}else{
		
			$permission_message = "Yöneticiler Tarafından";
		}
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=> "*❗ Bu Komut Sadece $permission_message Kullanılabilir..*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>$message_id
		]);
		exit();
	}
	
	
	/////////////////////////
	
	# USER PARAMETERS CONTROL


	$method_name = $bot_commands->method_name;
	
	$user_parameters = $bot_commands->parameters_control->user_parameters;

	
	if (!$User_Message["$user_parameters"]){ // USER PARAMETERS CONTROL
		
		for ($i = '1'; $i <= $user_parameters; $i++) {
			if (!$User_Message["$i"]){
				$parameters_control = $bot_commands->parameters_control->{$i};
				$parameters_info = $parameters_control;
				break;
			}

		}
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=> "*❗* `$parameters_info` *girilmedi...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>$message_id
		]);
		exit();


	}else{


	/////////////////////////



		/////////////////////////

		# URL CONTROL


		$url_control = $bot_commands->parameters_control->url_control;
		if ($url_control){
			if ($User_Message[$url_control]){
				if (!preg_match("/^https:\/\/[0-9a-zA-Z\.]*\/index.php\b/", $User_Message[$url_control])){
					bot('sendMessage',[
						'chat_id'=>$chat_id,
						'text'=> "*❗ Hatalı url girildi...*",
						'parse_mode'=>"markdown",
						'reply_to_message_id'=>$message_id
					]);
					exit();
				}
			}
		}
		
		
		/////////////////////////


		$_send_text = $bot_commands->send_text;


		/////////////////////////

		# USER PARAMETERS SEND CONTROLS


		if ($user_parameters == "0"){
			bot("$method_name");
		}


		if ($user_parameters == "1"){
			$user_parameters_1 = $bot_commands->parameters_control->{1};
			bot("$method_name",[
				"$user_parameters_1"=>$User_Message[1]
			]);
		}


		/////////////////////////



		/////////////////////////
		
		# BOT COMMAND RESULT


		$bot_commands_result = json_decode(file_get_contents('COMMAND_FILES/BOT_COMMANDS/bot_commands_result'));

		$ok = $bot_commands_result->ok;
		
		$result = $bot_commands_result->result;
		
		$result_json = json_encode($result, JSON_PRETTY_PRINT);
		
		$result_username = $result->username;
		
		$url = $result->url;


		/////////////////////////



		/////////////////////////

		# COMMAND STATUS CONTROL


		if ($ok == "0"){
			bot('sendMessage',[
				'chat_id'=>$chat_id,
				'text'=> "*❗ Bir Hata Oluştu...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>$message_id
			]);
			exit();
		}

		
		/////////////////////////
		
		
		
		/////////////////////////
		
		# VARİABLE REPLACE


		$send_text = str_replace(
			[
			'{User_Message_0}','{User_Message_1}',
			'{User_Message_2}','{User_Message_3}',
			'{first_name}','{last_name}',
			'{username}','{user_id}',
			'{url}','{result_username}'
			],
			[
			"$User_Message[0]","$User_Message[1]",
			"$User_Message[2]","$User_Message[3]",
			"$first_name","$last_name",
			"$username","$user_id",
			"$url",$result_username
			],$_send_text);


		/////////////////////////
		
		
		
		/////////////////////////
		
		# COMMAND REPLY SEND MESSAGE
		
		
		bot('sendMessage',[
			'chat_id'=>$chat_id,
			'text'=>$result_json,
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>$message_id
		]);
		exit();
		
		
		/////////////////////////
	}
}	


/////////////////////////

?>
