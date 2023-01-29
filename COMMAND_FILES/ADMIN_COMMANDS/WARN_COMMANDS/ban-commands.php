<?php


/////////////////////////

# BAN COMMANDS


if ( $User_Message[0] == "/ban" or $User_Message[0] == "/ban$Bot_Username" ){
	
	User_Controls("admin","0","Restrict_Members");

	if($reply_user_id){

		User_Controls("Warn","$reply_user_id","0","supergroup");

		$reason = str_replace("$User_Message[0]","", $text);

		WARNS("ban","$reason","0"," ","$reply_user_id","$reply_first_name_");

		exit();
	}

	if($entities_id){

		User_Controls("Warn","$entities_id","0","supergroup");

		$reason = str_replace("$User_Message[0] $User_Message[1]","", $text);

		WARNS("ban","$reason","0"," ","$entities_id","$entities_first_name");

		exit();
	}

	Username_Search($User_Message[1]);

	if ( _USERNAME_STATUS_ == "true"){

		User_Controls("Warn",_Id_,"0","supergroup");

		$reason = str_replace("$User_Message[0] $User_Message[1]","", $text);

		WARNS("ban","$reason","0"," ",_Id_,_FirstName_);

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



/////////////////////////




/////////////////////////

# TBAN COMMANDS


if ( $User_Message[0] == "/tban" or $User_Message[0] == "/tban$Bot_Username" ){
		
	User_Controls("admin","0","Restrict_Members");
	
	if ($User_Message[1]){
		
		if (preg_match("/^[1-9][0-9]*(m|h|d|w)$/", $User_Message[1])){
			
			$duration_int_control = preg_match("/[0-9]*/", $User_Message[1], $_duration_integer);
			$duration_str_control = preg_match("/(m|h|d|w)/", $User_Message[1], $_duration_string);
			$duration_integer = $_duration_integer[0];
			$duration_string = $_duration_string[0];

			if ( $duration_string == "m" ){
				$_duration = "60";
				$new_duration_str = "$duration_integer Dakika";
			}

			if ( $duration_string == "h" ){
				$_duration = "3600";
				$new_duration_str = "$duration_integer Saat";
			}
			
			if ( $duration_string == "d" ){
				$_duration = "86400";
				$new_duration_str = "$duration_integer Gun";
			}

			if ( $duration_string == "w" ){
				$_duration = "604800";
				$new_duration_str = "$duration_integer Hafta";
			}

			$new_duration = $duration_integer * $_duration;

		}else{

			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*❗ Hatalı Süre Belirtildi...*\n\n`/tban 1m`  `(1 Dakika)`\n\n`/tban 1h`  `(1 Saat)`\n\n`/tban 1d`  `(1 Gün)`\n\n`/tban 1w`  `(1 Hafta)`",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
			exit();
		}

	}
	
	if($reply_user_id){
		
		User_Controls("Warn","$reply_user_id","0","supergroup");

		$reason = str_replace("$User_Message[0] $User_Message[1]","", $text);
		
		WARNS("tban","$reason","$new_duration","$new_duration_str","$reply_user_id","$reply_first_name_");

		exit();
	}

	if($entities_id){

		User_Controls("Warn","$entities_id","0","supergroup");

		$reason = str_replace("$User_Message[0] $User_Message[1] $User_Message[2]","", $text);
		
		WARNS("tban","$reason","$new_duration","$new_duration_str","$entities_id","$entities_first_name");

		exit();
	}
	
	Username_Search($User_Message[2]);

	if ( _USERNAME_STATUS_ == "true"){

		User_Controls("Warn",_Id_,"0","supergroup");

		$reason = str_replace("$User_Message[0] $User_Message[1] $User_Message[2]","", $text);
		
		WARNS("tban","$reason","$new_duration","$new_duration_str",_Id_,_FirstName_);

		exit();
	}


	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*❗ Lütfen bir kullanıcı belirt* \n\n`( Mesaj yanıtla | Etiketle | Username )`\n\n* süre ve sebebini belirt...*\n\n`/tban 1m`  `(1 Dakika)`\n\n`/tban 1h`  `(1 Saat)`\n\n`/tban 1d`  `(1 Gün)`\n\n`/tban 1w`  `(1 Hafta)`",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
	exit();


}



/////////////////////////




/////////////////////////

# UNBAN COMMANDS


if ( $User_Message[0] == "/unban" or $User_Message[0] == "/unban$Bot_Username" ){

	User_Controls("admin","0","Restrict_Members");
	
	if($reply_user_id){

		User_Controls("UnWarn","$reply_user_id","0","supergroup");

		$reason = str_replace("$User_Message[0]","", $text);

		WARNS("unban","$reason","0"," ","$reply_user_id","$reply_first_name_");

		exit();
	}

	if($entities_id){

		User_Controls("UnWarn","$entities_id","0","supergroup");

		$reason = str_replace("$User_Message[0] $User_Message[1]","", $text);

		WARNS("unban","$reason","0"," ","$entities_id","$entities_first_name");

		exit();
	}

	Username_Search($User_Message[1]);

	if ( _USERNAME_STATUS_ == "true"){

		User_Controls("UnWarn",_Id_,"0","supergroup");

		$reason = str_replace("$User_Message[0] $User_Message[1]","", $text);

		WARNS("unban","$reason","0"," ",_Id_,_FirstName_);

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



/////////////////////////




/////////////////////////

# KİCK COMMANDS


if ( $User_Message[0] == "/kick" or $User_Message[0] == "/kick$Bot_Username" ){
	
	User_Controls("admin","0","Restrict_Members");
	
	if($reply_user_id){

		User_Controls("Warn","$reply_user_id","0","supergroup");

		$reason = str_replace("$User_Message[0]","", $text);

		WARNS("kick","$reason","35"," ","$reply_user_id","$reply_first_name_");

		exit();
	}

	if($entities_id){

		User_Controls("Warn","$entities_id","0","supergroup");

		$reason = str_replace("$User_Message[0] $User_Message[1]","", $text);

		WARNS("kick","$reason","35"," ","$entities_id","$entities_first_name");

		exit();
	}

	Username_Search($User_Message[1]);

	if ( _USERNAME_STATUS_ == "true"){

		User_Controls("Warn",_Id_,"0","supergroup");

		$reason = str_replace("$User_Message[0] $User_Message[1]","", $text);

		WARNS("kick","$reason","35"," ",_Id_,_FirstName_);

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



/////////////////////////




/////////////////////////

# BAN COMMANDS İNFO

$banCommands_info = ("
*Bᴀɴ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/ban`

`/tban`

`/unban`

`/kick`

──────────────
");



if ( $User_Message[0] == "/banCommands" or $User_Message[0] == "/banCommands$Bot_Username" ){
	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> $banCommands_info,
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);


}

/////////////////////////

?>
