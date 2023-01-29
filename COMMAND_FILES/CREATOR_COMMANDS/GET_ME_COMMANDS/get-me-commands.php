<?php

/////////////////////////

# GET ME COMMANDS


if ( $User_Message[0] == "/getMe" or $User_Message[0] == "/getMe$Bot_Username" ){

	User_Controls("creator","0","0","private");
	
	$command = bot("getMe");
	
	$result = $command->result;

	$id = $result->id;

	$first_name = $result->first_name;

	$username = "@".$result->username;

	$getMeCommands_info = ("

*Bᴏᴛ Iɴғᴏꜱ 🔻*

──────────────


*Iᴅ  »*  `$id`

*Fɪʀꜱᴛ Nᴀᴍᴇ  »*  `$first_name`

*Uꜱᴇʀɴᴀᴍᴇ  »*  `$username`

*Tᴏᴋᴇɴ  »*  `$Bot_Token`


──────────────
");


	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$getMeCommands_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
}



/////////////////////////


?>
