<?php


/////////////////////////

# RULES COMMANDS


if ( $User_Message[0] == "/rules" or $User_Message[0] == "/rules$Bot_Username" ){

	
	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'),true);
	
	$data_location = 'COMMAND_FILES/DATA_FILE/data.json';
	

	Explode_Message();
	
	$new_rules = NAME.REASON;

	User_Controls();

	foreach ($data["data"]["rules"] as $keys => $value){
		
		if ($new_rules and USER_STATUS == "creator"){

			if ( NAME != "|code" ){
			
				unset($data["data"]["rules"]["$keys"]);
			}
			
			$status = "True";

			break;
		}
	}

	$original_rules = $data["data"]["rules"]["$keys"]["text"];

	if ( NAME == "|code" ){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "<code>$original_rules</code>",
			'parse_mode'=>"html",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();

	}
	
	if (! $new_rules or USER_STATUS != "creator"){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> $original_rules,
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}
	
	
	$rules = str_replace(["code#","#code"],["`","`"],$new_rules);

	if ( DATA_TYPE == "0" ){
		
		$add = array(
		"data_id"=> "\n",
		"name"=> "rules",
		"text"=> "$rules",
		"type"=> "0"
		);
		
		array_push($data["data"]["rules"], $add);
		
		$json = json_encode($data, JSON_PRETTY_PRINT);
				
		file_put_contents($data_location, $json);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "Nᴇᴡ Rᴜʟᴇꜱ 🔻\n\n──────────────\n\n\n$rules\n\n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();

	}else{


		$add = array(
		"data_id"=> "".DATA_ID."",
		"name"=> "rules",
		"text"=> "$rules",
		"type"=> DATA_TYPE
		);
		
		array_push($data["data"]["rules"], $add);
		
		$json = json_encode($data, JSON_PRETTY_PRINT);
				
		file_put_contents($data_location, $json);
		
		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "Nᴇᴡ Rᴜʟᴇꜱ 🔻\n\n──────────────\n\n\n$_welcomeMessage_\n\n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}
}



/////////////////////////


?>
