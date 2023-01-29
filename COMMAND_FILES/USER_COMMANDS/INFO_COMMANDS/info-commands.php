<?php

/////////////////////////

# İNFO COMMANDS FUNCTİON


function Info_Commands($commands,$user_id,$first_name=null,$last_name=null,$username=null) {

	if (preg_match("/getChat/", $commands)){

		$userControl = bot('getChat',['chat_id'=>$user_id]);

		if ( $userControl->ok != "1" ){
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*❗* `$user_id` *İd Numaralı Kullanıcı Bulunamadı...*",
				'parse_mode'=>"markdown",
				'disable_web_page_preview'=>"true",
				'reply_to_message_id'=>_MESSAGE_ID
			]);

			exit();
		}

		$result = $userControl;

		$first_name = $result->result->first_name;

		$last_name = $result->result->last_name;

		$username = $result->result->username;

	}

$info = ("
*Uꜱᴇʀ Iɴғᴏ 🔻*

──────────────

*İd »* `$user_id`

*First Name »* `$first_name`

*Last Name »* `$last_name`

*Username »* `@$username`

*User Link »* [User Profile Link](tg://user?id=$user_id)

──────────────
");


$user_id_info = ("
*Uꜱᴇʀ Iᴅ 🔻*

──────────────

*İd »* `$user_id`

──────────────
");

$chat_id_info = ("
*Cʜᴀᴛ Iᴅ 🔻*

──────────────

*Chat İd »* `$user_id`

──────────────
");

	if ($commands == "chat_id"){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=>$chat_id_info,
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
	}
	if ($commands == "user_id" or $commands == "getChatId"){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=>$user_id_info,
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
	}

	if ($commands == "info" or $commands == "getChat"){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=>$info,
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
	}


}


/////////////////////////




/////////////////////////

# İNFO COMMANDS


if ( $User_Message[0] == "/info" or $User_Message[0] == "/info$Bot_Username" ){


	if($reply_user_id){
		Info_Commands("info",$reply_user_id,$reply_first_name_,$reply_last_name_,$reply_username_);
		exit();
	}

	if($entities_id){
		Info_Commands("info",$entities_id,$entities_first_name,$entities_last_name,$entities_username);
		exit();
	}

	if (preg_match("/^[-]?[0-9]\d+$/", $User_Message[1])){
		Info_Commands("getChat",$User_Message[1]);
		exit();
	}

	Username_Search($User_Message[1]);

	if ( _USERNAME_STATUS_ == "true"){

		Info_Commands("info",_Id_,_FirstName_,_LastName_,_UserName_);
		exit();

	}


	if(!$reply_user_id and !$entities_id){
		Info_Commands("info",$user_id,$first_name_,$last_name_,$username_);
		exit();
	}


}

/////////////////////////




/////////////////////////

# İD COMMANDS


if ( $User_Message[0] == "/id" or $User_Message[0] == "/id$Bot_Username" ){


	if($reply_user_id){
		Info_Commands("user_id",$reply_user_id);
	}

	if($entities_id){
		Info_Commands("user_id",$entities_id);
	}

	if (preg_match("/^[0-9]\d+\$/", $User_Message[1])){
		Info_Commands("getChatId",$User_Message[1]);
		exit();
	}

	Username_Search($User_Message[1]);

	if ( _USERNAME_STATUS_ == "true"){

		Info_Commands("user_id",_Id_);
		exit();

	}
	if(!$reply_user_id and !$entities_id){
		Info_Commands("chat_id",$chat_id);
	}


}

/////////////////////////



?>
