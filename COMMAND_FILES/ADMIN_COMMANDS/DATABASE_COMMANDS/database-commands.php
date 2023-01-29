<?php


/////////////////////////

# DATABASE STATUS COMMAND


if ( $User_Message[0] == "/database" or $User_Message[0] == "/database$Bot_Username" ){

	User_Controls("admin","0","True");

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "Dᴀᴛᴀʙᴀꜱᴇ Cᴏɴᴛʀᴏʟ 🔻\n\n──────────────\n\nSᴛᴀᴛᴜꜱ  »  `$databaseStatus`\n\n──────────────",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	exit();
}


/////////////////////////


?>
