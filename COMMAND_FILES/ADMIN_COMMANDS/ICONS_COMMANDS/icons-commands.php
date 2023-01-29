<?php

/////////////////////////

# İCONS COMMAND


if ( $User_Message[0] == "/icons" or $User_Message[0] == "/icons$Bot_Username" ){

	User_Controls("admin","0","True");


	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "Iᴄᴏɴꜱ 🔻\n\n`──────────────`\n\n`🟢`\n\n`🔴`\n\n`🔺`\n\n`🔻`\n\n`»`\n\n`🔸`\n\n`☣️ `\n\n`⚠️ `\n\n`✅`\n\n`❗`\n\n`⚡`\n\n`──────────────`",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	exit();
}


/////////////////////////

?>
