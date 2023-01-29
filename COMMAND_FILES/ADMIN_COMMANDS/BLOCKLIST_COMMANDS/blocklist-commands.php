<?php



/////////////////////////

# BLOCKLİSTS CONTROLS


function Blocklist_Control() {

	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	
	$blocklist = $data['data']['blocklist'];

	$status = $blocklist['blocklist_status'];

	$action = $blocklist['blocklist_action'];
		
	$duration = $blocklist['blocklist_duration'];

	$duration_str = $blocklist['blocklist_duration_str'];


	if (_CHAT_TYPE == "supergroup" and $status == "on" ){


		foreach ($data["data"]["blocklist"]["filters"] as $keys => $value){
			
			$names = preg_quote($data["data"]["blocklist"]["filters"]["$keys"]["name"]);

			if(preg_match("/\b$names\b/i", _TEXT)){

				User_Controls("member");

				if ( USER_STATUS == "member" ){
					$reply = $data['data']['blocklist']['filters']["$keys"]['reason'];
					
					bot('sendMessage',[
						'chat_id'=>CONFIG_PRIVATE_CHAT_ID,
						'text'=> "*Bʟᴏᴄᴋʟɪꜱᴛ Cᴏɴᴛʀᴏʟꜱ 🔻*\n\n──────────────\n──────────────\n\n*Uꜱᴇʀ 🔻*\n\n["._USER_FIRST_NAME[0]."](tg://user?id="._USER_ID.")\n\n*Mᴇꜱꜱᴀɢᴇ 🔻*\n\n`"._TEXT."`\n\n[Bᴏᴛ Mᴇꜱꜱᴀɢᴇ Lɪɴᴋ](https://t.me/c/"._CHAT_ID_."/"._MESSAGE_ID_.")\n\n──────────────\n──────────────",
						'parse_mode'=>"markdown",
						'disable_web_page_preview'=>"true"
					]);

					bot('deleteMessage',[
						'chat_id'=>_CHAT_ID,
						'message_id'=>_MESSAGE_ID
					]);
					
					WARNS("$action","$reply","$duration","$duration_str");
					break;

				}else{ break; }
			}
		}
	}
}

if (!$callback_data){
	Blocklist_Control();
}


/////////////////////////



	
/////////////////////////

# BLOCKLİSTS NAMES FUNCTİON


function Blocklist_Names() {
	
	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	
	$names = "Bʟᴏᴄᴋʟɪꜱᴛ Nᴀᴍᴇꜱ 🔻\n\n";
	
	foreach ($data["data"]["blocklist"]["filters"] as $keys => $value){
		
		if ( $keys >= 1 ){
			
			$names .= "*»* `".$data["data"]["blocklist"]["filters"]["$keys"]["name"]."`\n";
		}
	
	}


	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> $names,
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
}
	

/////////////////////////




/////////////////////////

# BLOCKLİSTS ADD FUNCTİON


function Blocklist_Add($name=False,$reason=False) {
	
	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	
	$data_location = 'COMMAND_FILES/DATA_FILE/data.json';
	
	
	$name = preg_split('/ |\r|\n/', _TEXT);
		
	if ( preg_match('/^"/', $name[1])){
			
		$name = explode ('"', _TEXT);
		
	}

	foreach ($data["data"]["blocklist"]["filters"] as $keys => $value){

		$names = preg_quote($data["data"]["blocklist"]["filters"]["$keys"]["name"]);
		
		if ( $names == $name[1] ){
			
			unset($data["data"]["blocklist"]["filters"]["$keys"]);
			
			$status = "True";

			break;

		}
	}




	if ( $name != "False" ){
		
		$filter_name = preg_split('/ |\r|\n/', _TEXT);
		
		if ( preg_match('/^"/', $filter_name[1])){
			
			$filter_name = explode ('"', _TEXT);
			$control = "true";
		
		}

		$User_Message = _USER_MESSAGE;

		if ($control == "true"){
			
			$filter_reason = str_replace("$User_Message[0] \"$filter_name[1]\"","", _TEXT);
		
		}else{
		
			$filter_reason = str_replace("$User_Message[0] $filter_name[1]","", _TEXT);
		}
		
		if (!$filter_reason){

			$filter_reason = "*KONUŞMANA DİKKAT ET* ❗";
		}

	 $add = array(
		"name"=> "$filter_name[1]",
		"reason"=> "$filter_reason"
		);
		
		array_push($data["data"]["blocklist"]["filters"], $add);
		
		$json = json_encode($data, JSON_PRETTY_PRINT);
				
		file_put_contents($data_location, $json);

		file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");	

		$name = $filter_name[1];

		$reason = str_replace(
			['_'],
			['\_'],
			$filter_reason);


		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "✅ `$name` *Blocklist Kaydedildi..*\n\n*$reason*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);



	}
}
	

/////////////////////////




/////////////////////////

# BLOCKLİSTS SET FUNCTİON


function Blocklist_Set() {
		
	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	$data_object = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'));
	$data_location = 'COMMAND_FILES/DATA_FILE/data.json';
	
	$blocklist = $data['data']['blocklist'];

	$status = $blocklist['blocklist_status'];

	$action = $blocklist['blocklist_action'];
		
	$duration = $blocklist['blocklist_duration'];

	$duration_str = $blocklist['blocklist_duration_str'];

	
	$blocklist_setCommands_info = ("

*Bʟᴏᴄᴋʟɪꜱᴛ Sᴇᴛ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/setBlocklist on`

`/setBlocklist off`

`/setBlocklist warn`

`/setBlocklist mute`

`/setBlocklist tmute`

`/setBlocklist ban`

`/setBlocklist tban`

`/setBlocklist kick`

`/setBlocklist 1m` `(1 Dakika)`

`/setBlocklist 1h` `(1 Saat)`

`/setBlocklist 1d` `(1 Gün)`

`/setBlocklist 1w` `(1 Hafta)`

──────────────

");

	if (!_USER_MESSAGE[1]){
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "$blocklist_setCommands_info",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}else{

		Replace("blocklist_","true",$status,$action,$duration,$duration_str);
	
	}

}
	

/////////////////////////




/////////////////////////

# BLOCKLİSTS REMOVE FUNCTİON


function Blocklist_Remove($remove=False) {
		
	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	$data_location = 'COMMAND_FILES/DATA_FILE/data.json';
	
	$remove = preg_split('/ |\r|\n/', _TEXT);
		
	if ( preg_match('/^"/', $remove[1])){
			
		$remove = explode ('"', _TEXT);
		
	}

	foreach ($data["data"]["blocklist"]["filters"] as $keys => $value){

		$name = preg_quote($data["data"]["blocklist"]["filters"]["$keys"]["name"]);
				
		if ( $remove[1] != "False" ){
			if ( $name == $remove[1] ){
				
				unset($data["data"]["blocklist"]["filters"]["$keys"]);
				
				$json = json_encode($data, JSON_PRETTY_PRINT);
				
				file_put_contents($data_location, $json);
				
				file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");
				$remove_status = "True";

				break;
			}else{
				$remove_status = "False";
			}
		}
	}
	
	
	if ( $remove_status == "True" ){

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "❗ `$name` * Blocklist'den Kaldırıldı..*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
	}else{
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Blocklist'de* `$remove[1]` *Bulunamadı..*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
	}
}
	

/////////////////////////




/////////////////////////

# BLOCKLİSTS COMMANDS


if ( $User_Message[0] == "/blocklist" or $User_Message[0] == "/blocklist$Bot_Username" ){
	
	User_Controls("admin","0","0","private");
	Blocklist_Names();
	
}

if ( $User_Message[0] == "/statusBlocklist" or $User_Message[0] == "/statusBlocklist$Bot_Username" ){

	User_Controls("admin","0","True");
	
	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	
	$blocklist = $data['data']['blocklist'];

	$status = $blocklist['blocklist_status'];

	$action = $blocklist['blocklist_action'];
		
	$duration = $blocklist['blocklist_duration'];

	$duration_str = $blocklist['blocklist_duration_str'];


	if (preg_match("/^(warn|mute|ban|kick)*$\b/", $action)){
		if ($action == "warn"){
			$duration_str = "Warn Duration";
		}else{

			$duration_str = "No Time";
		}

	}


	$blocklist_status_info = ("

*Bʟᴏᴄᴋʟıꜱᴛ Sᴛᴀᴛᴜꜱ 🔻*

──────────────
*
Status   » $status

Action   » $action

Duration » $duration_str
*
──────────────
");
	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$blocklist_status_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
	exit();

}

if ( $User_Message[0] == "/addBlocklist" or $User_Message[0] == "/addBlocklist$Bot_Username" ){
	
	User_Controls("admin","0","True");
	
	if (!$User_Message[1]){
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Lütfen bir blocklist adı giriniz..*\n\n`/addBlocklist fuck \n\n❗ Yasaklı Kelime ❗`",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
	
	}else{
		
		Blocklist_Add($User_Message[1]);
	
	}
}

if ( $User_Message[0] == "/setBlocklist" or $User_Message[0] == "/setBlocklist$Bot_Username" ){
	
	User_Controls("creator");
	
	Blocklist_Set();
		
}

if ( $User_Message[0] == "/delBlocklist" or $User_Message[0] == "/delBlocklist$Bot_Username" ){

	User_Controls("admin","0","True");
	
	if (!$User_Message[1]){
		
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Lütfen bir blocklist adı giriniz..*\n\n`/delBlocklist fuck`",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
	
	}else{
		
		Blocklist_Remove("$User_Message[1]");
		
	}

	
}


$blocklistCommands_info = ("
*Bʟᴏᴄᴋʟɪꜱᴛ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/blocklist`

`/statusBlocklist`

`/addBlocklist`

`/setBlocklist`

`/delBlocklist`

──────────────
");


if ( $User_Message[0] == "/blocklistCommands" or $User_Message[0] == "/blocklistCommands$Bot_Username" ){

	User_Controls("admin","0","True");
	
	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$blocklistCommands_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
}



/////////////////////////


?>
