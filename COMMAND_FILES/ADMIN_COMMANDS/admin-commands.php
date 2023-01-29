<?php

/////////////////////////

# ADMİN COMMANDS İNFO


$adminCommands_info = ("
*Aᴅᴍɪɴ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/blocklistCommands`

`/floodCommands`

`/warnCommands`

`/warnsCommands`

`/muteCommands`

`/banCommands`

`/toolsCommands`

`/mixCommands`

`/blogCommands`

`/lock`

`/unlock`

`/locks`

`/pin`

`/unpin`

`/newFont`

`/disable`

`/enable`

`/disabled`

`/delMessage`

`/icons`

`/database`

`/smsWhatsapp`

──────────────
");



if ( $User_Message[0] == "/adminCommands" or $User_Message[0] == "/adminCommands$Bot_Username" ){

	User_Controls("admin","0","True");
	
	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$adminCommands_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);
}



/////////////////////////




/////////////////////////

# LOCK COMMANDS

require('LOCK_COMMANDS/lock-commands.php');

# WARN COMMANDS

require('WARN_COMMANDS/warn-commands.php');

# WARNS COMMANDS

require('WARN_COMMANDS/warns-commands.php');

# MUTE TMUTE UNMUTE COMMANDS

require('WARN_COMMANDS/mute-commands.php');

# BAN TBAN UNBAN COMMANDS

require('WARN_COMMANDS/ban-commands.php');

# FİLTERS COMMANDS

require ("FILTERS_COMMANDS/filters-commands.php");

# PİN MESSAGE COMMANDS

require ("PIN_MESSAGE_COMMANDS/pin-message-commands.php");

# NEW FONT COMMANDS

require ("NEW_FONT_COMMANDS/new-font-commands.php");

# DEL MESSAGE COMMANDS

require ("DEL_MESSAGE_COMMANDS/del-message-commands.php");

# DİSABLE COMMANDS

require ("DISABLE_COMMANDS/disable-commands.php");

# DATABASE COMMANDS

require ("DATABASE_COMMANDS/database-commands.php");

# İCONS COMMANDS

require ("ICONS_COMMANDS/icons-commands.php");

# SMS SEND

require ("SMS_SEND/sms-send-commands.php");


/////////////////////////

?>
