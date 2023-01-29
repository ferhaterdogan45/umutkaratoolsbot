<?php

/////////////////////////

# FLOOD CONTROLS



function Flood_Control() {

	if (_CHAT_TYPE == "supergroup"){
			
		$flood_file = file_get_contents('COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/user_warns_file/flood.txt');
			
		$flood_file_location = 'COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/user_warns_file/flood.txt';
			
		$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'));
			
		$flood = $data->data->flood;
			
		$flood_id = explode("\n",$flood_file);
			
		$flood_status = $flood->flood_status;
			
		$flood_action = $flood->flood_action;
			
		$flood_duration = $flood->flood_duration;
			
		$flood_duration_str = $flood->flood_duration_str;
			
		$flood_limit = $flood->flood_limit;

			
		if ($flood_status == "on"){
				
			User_Controls("member");
	
			if (USER_STATUS == "member"){

				if (_USER_ID == $flood_id[0]){

					if (_USER_ID == $flood_id[$flood_limit-1]){


						file_put_contents($flood_file_location, _USER_ID);

						WARNS("$flood_action","Flood Yaptığın İçin","$flood_duration","$flood_duration_str");

						
					}else{ file_put_contents($flood_file_location, "\n"._USER_ID."",FILE_APPEND); }
					
					
				}else{ file_put_contents($flood_file_location, _USER_ID); }

			}else{ file_put_contents($flood_file_location, _USER_ID); }
		}
	}
}

Flood_Control();


/////////////////////////



	
/////////////////////////

# FLOOD SET FUNCTİON


function Flood_Set() {
	
	
	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	
	$data_location = 'COMMAND_FILES/DATA_FILE/data.json';
	
	$flood = $data['data']['flood'];

	$status = $flood['flood_status'];

	$action = $flood['flood_action'];
		
	$duration = $flood['flood_duration'];

	$duration_str = $flood['flood_duration_str'];
	
	$limit = $flood['flood_limit'];

	
	$flood_setCommands_info = ("

*Fʟᴏᴏᴅ Sᴇᴛ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/setFlood on`

`/setFlood off`

`/setFlood warn`

`/setFlood mute`

`/setFlood tmute`

`/setFlood ban`

`/setFlood tban`

`/setFlood kick`

`/setFlood 1m` `(1 Dakika)`

`/setFlood 1h` `(1 Saat)`

`/setFlood 1d` `(1 Gün)`

`/setFlood 1w` `(1 Hafta)`

`/setFlood 5` `(Limit)`

──────────────

");

	if (!_USER_MESSAGE[1]){
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "$flood_setCommands_info",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}else{

		Replace("flood_","true",$status,$action,$duration,$duration_str,$limit);
	
	}

}
	

/////////////////////////




/////////////////////////

# FLOOD COMMANDS


if ( $User_Message[0] == "/statusFlood" or $User_Message[0] == "/statusFlood$Bot_Username" ){
	
	User_Controls("admin","0","True");
	
	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	
	$flood = $data['data']['flood'];

	$status = $flood['flood_status'];

	$action = $flood['flood_action'];
		
	$duration = $flood['flood_duration'];

	$duration_str = $flood['flood_duration_str'];
	
	$limit = $flood['flood_limit'];


	if (preg_match("/^(warn|mute|ban|kick)*$\b/", $action)){
		if ($action == "warn"){
			$duration_str = "Warn Duration";
		}else{

			$duration_str = "No Time";
		}

	}


	$flood_status_info = ("

*Fʟᴏᴏᴅ Sᴛᴀᴛᴜꜱ 🔻*

──────────────
*
Status   » $status

Action   » $action

Duration » $duration_str

Limit       » $limit
*
──────────────
");
	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$flood_status_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
	exit();

}

if ( $User_Message[0] == "/setFlood" or $User_Message[0] == "/setFlood$Bot_Username" ){
	
	User_Controls("creator");
	
	Flood_Set();
		
}

$floodCommands_info = ("
*Fʟᴏᴏᴅ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/statusFlood`

`/setFlood`

──────────────
");


if ( $User_Message[0] == "/floodCommands" or $User_Message[0] == "/floodCommands$Bot_Username" ){

	User_Controls("admin","0","True");

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$floodCommands_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
}



/////////////////////////


?>
