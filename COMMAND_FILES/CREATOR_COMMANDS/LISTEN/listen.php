<?php

/////////////////////////

# LİSTEN COMMANDS


if ( $User_Message[0] == "/listen" or $User_Message[0] == "/listen$Bot_Username" ){

	User_Controls("creator","0","0","private");

	$command = bot("getMe");

	$result = $command->result;

	$id = $result->id;

	$first_name = $result->first_name;

	$username = "@".$result->username;

	$getMe_commands_info = ("

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
		'text'=> "$getMe_commands_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
}



/////////////////////////


?>
