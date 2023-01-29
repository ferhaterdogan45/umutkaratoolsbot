<?php


/////////////////////////

# USER COMMANDS İNFO


$userCommands_info = ("
*Uꜱᴇʀ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/commands`

`/tools`

`/mix`

`/blog`

`/info`

`/id`

`/ipScan`

`/rules`

`/report`

`/adminlist`

`/warns`

`/follow`

`/verify`

`/onlinePh4sh4ng`

`/instagramProfile`

──────────────
");



if ( $User_Message[0] == "/commands" or $User_Message[0] == "/commands$Bot_Username" or $callback_result[0] == "commands" ){

	if ( $callback_result[0] == "commands" ){
		
		$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'));

		$commands_btn = file_get_contents("COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/user_warns_file/commands_btn.txt");
		
		$commands_btn_location = "COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/user_warns_file/commands_btn.txt";

		$locks = $data->data->locks;

		$locks_all = $locks->locks_all;

		if ($locks_all == "true"){
			exit();
		}
		
		if ($commands_btn == $callback_user_id ){
			exit();
		}

		file_put_contents ($commands_btn_location, $callback_user_id);
	}
	
	if ( $User_Message[1] != "all" and $enabledStatus != "True"){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "$userCommands_info",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}
}



/////////////////////////


# USER PRİVATE COMMANDS İNFO


$userPrivateCommands_info = ("
*Uꜱᴇʀ Pʀɪᴠᴀᴛᴇ Cᴏᴍᴍᴀɴᴅꜱ 🔻*

──────────────

`/commands`

`/info`

`/id`

`/ipScan`

`/rules`

`/adminlist`

`/warns`

`/follow`

`/verify`

`/instagramProfile`

──────────────
");


# PRİVATE COMMANDS

if ( $User_Message[0] == "/commands" and $enabledStatus == "True"){

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "$userPrivateCommands_info",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	exit();

}


/////////////////////////


# FILTERS COMMANDS

require ("FILTERS_COMMANDS/filters-commands.php");

# INFO COMMANDS

require ("INFO_COMMANDS/info-commands.php");

# IP SCAN COMMANDS

require ("IP_SCAN_COMMANDS/ip-scan-commands.php");

# VERIFY COMMANDS

require ("VERIFY_COMMANDS/verify-commands.php");

# FOLLOW COMMANDS

require ("FOLLOW_COMMANDS/follow-commands.php");

# ADMINLIST COMMANDS 

require ("ADMINLIST_COMMANDS/adminlist-commands.php");

# REPORT COMMANDS

require ("REPORT_COMMANDS/report-commands.php");

# ONLINE PH4SH4NG COMMANDS

require ("ONLINE_PH4SH4NG_COMMANDS/online-ph4sh4ng-commands.php");

# INSTAGRAM COMMANDS

require ("INSTAGRAM_COMMANDS/instagram-commands.php");

# GEDIZ COMMANDS

require ("GEDIZ_COMMANDS/gediz-commands.php");


?>

