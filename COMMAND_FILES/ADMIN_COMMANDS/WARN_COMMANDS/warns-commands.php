<?php


/////////////////////////

# WARNS İNFO


function Warns_Info($user_id="0",$first_name="0",$username="0") {

	$warns_file = json_decode(file_get_contents('COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/user_warns_file/warns.json'),true);
	$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'));

	$warns_limit = $data->data->warn->warn_limit;
	
	if ($username != "0" ){
		foreach ($warns_file as $keys => $value){
		
			if ($warns_file["$keys"]["0"]["username"] == $username){
				$user_id = $warns_file["$keys"]["0"]["id"];
				break;
			}
		}
	}
	foreach ($warns_file as $keys => $value){
		if ($user_id != "0" ){
			if ($warns_file["$keys"]["0"]["id"] == $user_id){
				if ($first_name == "0" ){
					$first_name = _USER_FIRST_NAME[0];
				}
				$warns_id = $warns_file["$keys"]["0"]["id"];
				$warns_count = count($warns_file["$keys"]);
				$warns .= "İd > $warns_id | Count > $warns_count";
				$add = $warns_count;


				for ($i = "0"; $i <= $warns_count; $i++) {
					
					$_warns_reason .= "\n ".$warns_file["$keys"]["$i"]["reason"];
				
				}


				$warns_info = "*  $add/$warns_limit Kere Uyarıldı...*";
				$warns_reason = "\n\nSebep : \n$_warns_reason";

				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*Wᴀʀɴꜱ Iɴғᴏ 🔻*\n\n──────────────\n\n*❗* [$first_name](tg://user?id=$user_id)$warns_info$warns_reason\n\n──────────────",
					'reply_markup'=>json_encode([
					'inline_keyboard'=>[
					[['text'=>"Tüm Uyarıları Kaldır",
					'callback_data'=>"warn $user_id $first_name all"]]]]),
					'parse_mode'=>"markdown"
				]);


				exit();

			}else{
				$status = "False";
			}
		}
		if ($user_id == "0" ){
			if ($warns_file["$keys"]){
				$warns_id = $warns_file["$keys"]["0"]["id"];
				$warns_first_name = $warns_file["$keys"]["0"]["first_name"];
				$warns_count = count($warns_file["$keys"]);
				$warns .= "[$warns_first_name](tg://user?id=$warns_id) *$warns_count/$warns_limit Kere Uyarıldı...*\n\n──────────────\n\n";
				$status = "True";
			}else{
				$status = "False";
			}
		
		}
	}
	
	if( $status == "False" ){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Wᴀʀɴꜱ Iɴғᴏ 🔻*\n\n──────────────\n\n*❗ Uyarı Bulunamadı...*\n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}else{
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Wᴀʀɴꜱ Iɴғᴏ 🔻*\n\n──────────────\n\n$warns",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();

	
	}


}



/////////////////////////

# WARNS COMMANDS

if ( $User_Message[0] == "/warns" or $User_Message[0] == "/warns$Bot_Username" ){
	
	User_Controls("member");

	if ( USER_STATUS == "member" ){
		Warns_Info($user_id);
		exit();
	}
	
	if($reply_user_id){

		Warns_Info("$reply_user_id","$reply_first_name_");

		exit();
	}

	if($entities_id){

		Warns_Info("$entities_id","$entities_first_name");
		
		exit();
	}

	
	Username_Search($User_Message[1]);

	if ( _USERNAME_STATUS_ == "true"){

		Warns_Info(_Id_,_FirstName_,_UserName_);

		exit();
	}

	Warns_Info();
}


if ( $User_Message[0] == "/warnsCommands" or $User_Message[0] == "/warnsCommands$Bot_Username" ){
	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*Wᴀʀɴꜱ Cᴏᴍᴍᴀɴᴅꜱ 🔻*\n\n──────────────\n\n`/warns` *( Tüm Uyarılar İçin Sadece Komutu Yaz. | Kullanıcı Uyarısı İcin Mesajını Yanıtla.. )*\n\n──────────────",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

}
/////////////////////////



?>
