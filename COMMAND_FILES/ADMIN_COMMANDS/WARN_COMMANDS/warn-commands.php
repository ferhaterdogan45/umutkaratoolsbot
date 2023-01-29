<?php



/////////////////////////

# WARN SET FUNCTİON


function Warn_Set() {

	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	$data_location = 'COMMAND_FILES/DATA_FILE/data.json';

	$warn = $data['data']['warn'];

	$status = $warn['warn_status'];

	$action = $warn['warn_action'];

	$duration = $warn['warn_duration'];

	$duration_str = $warn['warn_duration_str'];
	
	$limit = $warn['warn_limit'];


	$warn_setCommands_info = ("

*Wᴀʀɴ Sᴇᴛ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/setWarn mute`

`/setWarn tmute`

`/setWarn ban`

`/setWarn tban`

`/setWarn kick`

`/setWarn 1m` `(1 Dakika)`

`/setWarn 1h` `(1 Saat)`

`/setWarn 1d` `(1 Gün)`

`/setWarn 1w` `(1 Hafta)`

`/setWarn 3` `(Limit)`

──────────────

");

	if (!_USER_MESSAGE[1]){

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "$warn_setCommands_info",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}else{

		Replace("warn_","true","0",$action,$duration,$duration_str,$limit);

	}

}


/////////////////////////




/////////////////////////

# WARN COMMANDS


if ( $User_Message[0] == "/warn" or $User_Message[0] == "/warn$Bot_Username" ){
	
	User_Controls("admin","0","Restrict_Members");

	//Explode_Message();
	
	if($reply_user_id){

		User_Controls("Warn","$reply_user_id","0","supergroup");

		$reason = str_replace("$User_Message[0]","", $text);
		
		if (!$reason){
			$reason = "Sebep Belirtilmedi...";
		}

		WARNS("warn","$reason","0"," ","$reply_user_id","$reply_first_name_","$reply_username_");

		exit();
	}

	if($entities_id){

		User_Controls("Warn","$entities_id","0","supergroup");

		$reason = str_replace("$User_Message[0] $User_Message[1]","", $text);

		if (!$reason){
			$reason = "Sebep Belirtilmedi...";
		}

		WARNS("warn","$reason","0"," ","$entities_id","$entities_first_name","$entities_username");

		exit();
	}


	Username_Search($User_Message[1]);

	if ( _USERNAME_STATUS_ == "true"){

		User_Controls("Warn",_Id_,"0","supergroup");

		$reason = str_replace("$User_Message[0] $User_Message[1]","", $text);

		if (!$reason){
			$reason = "Sebep Belirtilmedi...";
		}

		WARNS("warn","$reason","0"," ",_Id_,_FirstName_,_UserName_);

		exit();
	}


	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*❗ Lütfen bir kullanıcı belirt* \n\n`( Mesaj yanıtla | Etiketle | Username )`\n\n* ve sebebini belirt...*",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
	exit();

}

if ( $User_Message[0] == "/statusWarn" or $User_Message[0] == "/statusWarn$Bot_Username" ){

	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	
	$warn = $data['data']['warn'];

	$status = $warn['warn_status'];

	$action = $warn['warn_action'];
		
	$duration = $warn['warn_duration'];

	$duration_str = $warn['warn_duration_str'];
	
	$limit = $warn['warn_limit'];


	if (preg_match("/^(mute|ban|kick)*$\b/", $action)){
		$duration_str = "No Time";
	}


	$warn_status_info = ("

*Wᴀʀɴ Sᴛᴀᴛᴜꜱ 🔻*

──────────────
*
Status     » $status

Action     » $action

Duration » $duration_str

Limit       » $limit
*
──────────────
");
	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$warn_status_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
	exit();

}



if ( $User_Message[0] == "/setWarn" or $User_Message[0] == "/setWarn$Bot_Username" ){
	
	User_Controls("creator");
	
	if (preg_match("/^warn\b/i", $User_Message[1])){
		exit();
	}
	
	
	Warn_Set();
		
}

$warnCommands_info = ("
*Wᴀʀɴ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/warn`

`/statusWarn`

`/setWarn`

──────────────
");


if ( $User_Message[0] == "/warnCommands" or $User_Message[0] == "/warnCommands$Bot_Username" ){

	User_Controls("admin","0","True");
	
	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$warnCommands_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
}



/////////////////////////




/////////////////////////
?>
