<?php


/////////////////////////

# CREATOR COMMANDS İNFO


$creatorCommands_info = ("
*Cʀᴇᴀᴛᴏʀ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/getMe`

`/webhookCommands`

`/rules` *(hiden new set)*

`/welcomeMessage`

`/sendMessage`

`/enablePrivate` 

`/enabledPrivate` 

`/disablePrivate` 

──────────────
");



if ( $User_Message[0] == "/creatorCommands" or $User_Message[0] == "/creatorCommands$Bot_Username" ){

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$creatorCommands_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
	exit();
}

# COMMANDS ALL

$allCommands_info = ("
$userCommands_info
$adminCommands_info
$creatorCommands_info
");

if ( $text == "/commands all" ){

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$allCommands_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	exit();
}

/////////////////////////




/////////////////////////

# WEBHOOK COMMANDS

require ("WEBHOOK_COMMANDS/webhook-commands.php");

# GET ME COMMANDS

require ("GET_ME_COMMANDS/get-me-commands.php");

# RULES COMMANDS

require ("RULES_COMMANDS/rules-commands.php");

# WELCOME MESSAGE COMMANDS

require ("WELCOME_MESSAGE_COMMANDS/welcome-message-commands.php");

# SEND MESSAGE COMMANDS

require ("SEND_MESSAGE_COMMANDS/send-message-commands.php");

# ENABLE PRİVATE COMMANDS

require ("ENABLE_PRİVATE_COMMANDS/enable-private-commands.php");


/////////////////////////


?>
