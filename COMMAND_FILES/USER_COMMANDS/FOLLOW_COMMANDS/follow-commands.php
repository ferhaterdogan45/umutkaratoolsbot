<?php

/////////////////////////

# FOLLOW COMMANDS


if ( $User_Message[0] == "/follow" or $User_Message[0] == "/follow$Bot_Username" ){

$follow_commands_info = ("
*Fᴏʟʟᴏᴡ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

*🇹​🇦​🇰​🇮​🇵​ 🇪​🇹​ *


[UmuT KaRa Github](https://github.com/umutkara-tools)

[Raven Github](https://github.com/Raven1965)

[Jokzilla Github](https://github.com/jokzilla)

──────────────


[İnstagram](https://instagram.com/umutkaratools)

[Youtube](https://youtube.com/channel/UCE3QvczZXklHSAaRFwDLP5g)


──────────────
");


	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> $follow_commands_info,
		'parse_mode'=>"markdown",
		'disable_web_page_preview'=>"true",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

}

/////////////////////////



?>
