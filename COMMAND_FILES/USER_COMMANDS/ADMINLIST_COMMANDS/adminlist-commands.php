<?php

/////////////////////////

# ADMİNLİST COMMANDS


if ( $User_Message[0] == "/adminlist" or $User_Message[0] == "/adminlist$Bot_Username" ){


	bot("getChatAdministrators",['chat_id'=>$Config_Chat_id]);

	$result_file = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/commands_result'), true);

	$result = $result_file["result"];

	$adminlist = "*Aᴅᴍɪɴ Lɪꜱᴛ 🔻*\n\n──────────────\n\n";

	foreach ($result as $keys => $value){
		$status = $result["$keys"]["status"];
		$title = $result["$keys"]["custom_title"];

		if (!$title){
			$title = "Yönetici";
		}

		$id = $result["$keys"]["user"]["id"];
		$first_name = $result["$keys"]["user"]["first_name"];
		$username = $result["$keys"]["user"]["username"];

		if ($creator_id != $id ){

			$adminlist .= "[$first_name](tg://user?id=$id) *» $title*\n\n";

		}
	}


	//$resultJson = file_get_contents('COMMAND_FILES/DATA_FILE/commands_result');
	bot('sendMessage',[
		'chat_id'=>$chat_id,
		'text'=> "$adminlist\n──────────────\n\n`$result`",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

}

/////////////////////////


?>
