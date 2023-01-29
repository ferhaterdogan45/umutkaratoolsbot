<?php


/////////////////////////

# WARNS


function WARNS($action,$explanation,$duration="35",$duration_str,$warn_user_id="0",$warn_first_name="0",$warn_username="0") {


	if ($warn_user_id != "0" ){
		define("USER_ID", $warn_user_id);
		define("USER_FIRST_NAME", $warn_first_name);
		define("USERNAME", $warn_username);
	}else{
	
		define("USER_ID", _USER_ID);
		define("USER_FIRST_NAME", _USER_FIRST_NAME[0]);
		define("USERNAME", _USERNAME);
	}


	if ( USER_STATUS == "member" ){
		define("__USER_ID__", _BOT_ID);
		define("__USER_FIRST_NAME__", _BOT_NAME);

	}else{
		define("__USER_ID__", _USER_ID);
		define("__USER_FIRST_NAME__", _USER_FIRST_NAME[0]);
	}

	if (USER_ID != _CREATOR_ID){
		if (_CHAT_TYPE == 'supergroup'){

			if ( $action == "warn" ){

				$warns_file = json_decode(file_get_contents('COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/user_warns_file/warns.json'),true);

				$warns_file_location = 'COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/user_warns_file/warns.json';

				$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'));

				$warns = $data->data->warn;

				$warns_action = $warns->warn_action;

				$warns_duration = $warns->warn_duration;

				$warns_duration_str = $warns->warn_duration_str;

				$warns_limit = $warns->warn_limit;

				$warns_file_count = count($warns_file);

				$_warns_reason = " ";


				foreach ($warns_file as $keys => $value){
			
					if ( $warns_file["$keys"]["0"]["id"] == USER_ID ){
						$user_control = "true";
						$warns_number = $keys;
						$warns_count = count($warns_file["$keys"]);
						$add = $warns_count+1;

						break;
					}
					$_warns_number = $keys;
				}

				if ( $warns_file_count <= "0" ){
					
					$_warns_number = "0";

				}


				if ($user_control == "true" ){


					$add_warns = array(

						"reason"=> "$add : $explanation"
					);


					array_push($warns_file["$warns_number"], $add_warns);

					$json = json_encode($warns_file, JSON_PRETTY_PRINT);

					file_put_contents($warns_file_location, $json);
					
					file_upload ("$warns_file_location","warns.json");

					for ($i = "0"; $i <= $warns_count; $i++) {

						$_warns_reason .= "\n ".$warns_file["$warns_number"]["$i"]["reason"];

					}


					$warns_info = "Uyarı $add/$warns_limit  | ";
					$warns_info = "*  $add/$warns_limit Kere Uyarıldı..*";
					$warns_reason = "\n\nSebep : \n$_warns_reason";
					$explanation = "";

					if ($add != $warns_limit){
						bot('sendMessage',[
							'chat_id'=>_CHAT_ID,
							'text'=> "*❗* [".USER_FIRST_NAME."](tg://user?id=".USER_ID.")$warns_info$warns_reason",
							'reply_markup'=>json_encode([
							'inline_keyboard'=>[
							[['text'=>"Uyarıyı kaldır",
							'callback_data'=>"warn ".USER_ID." $warns_count"]]]]),
							'parse_mode'=>"markdown"
						]);
						exit();
					}

					unset($warns_file["$warns_number"]);

					$json = json_encode($warns_file, JSON_PRETTY_PRINT);

					file_put_contents($warns_file_location, $json);

					file_upload ("$warns_file_location","warns.json");
					
					$warns_reason = "\n\nSebep : \n$_warns_reason\n\n";

					$explanation = "❗";


				}else{


					$new_warns = array([

						"id"=> "".USER_ID."",
						"first_name"=> "".USER_FIRST_NAME."",
						"username"=> "".USERNAME."",
						"reason"=> "1 : $explanation"
					]);

					array_push($warns_file, $new_warns);

					$json = json_encode($warns_file, JSON_PRETTY_PRINT);

					file_put_contents($warns_file_location, $json);
					
					file_upload ("$warns_file_location","warns.json");



					$_warns_reason .= "*1 : $explanation*";
					$warns_info = "*  1/$warns_limit Kere Uyarıldı..*";
					$warns_reason = "\n\nSebep : \n\n*$_warns_reason*";
			

					bot('sendMessage',[
						'chat_id'=>_CHAT_ID,
						'text'=> "*❗* [".USER_FIRST_NAME."](tg://user?id=".USER_ID.")$warns_info$warns_reason\n\n$user_control",
						'reply_markup'=>json_encode([
						'inline_keyboard'=>[
						[['text'=>"Uyarıyı kaldır",
						'callback_data'=>"warn ".USER_ID." 0"]]]]),
						'parse_mode'=>"markdown"
					]);
					exit();
				}

				define("ACTION", $warns_action);

				$duration = $warns_duration;
				$duration_str = $warns_duration_str;


			}else{

				define("ACTION", $action);
				$warns_info = "";
				$warns_reason = "";

			}


			$date_file = json_decode(file_get_contents("COMMAND_FILES/UPDATE_FILE/update.json"));

			$message_date = $date_file->message->date;

			$unix_duration = ($message_date+$duration);
			
			bot('sendMessage',[
				'chat_id'=>CONFIG_PRIVATE_CHAT_ID,
				'text'=> "*Cᴏᴍᴍᴀɴᴅꜱ Cᴏɴᴛʀᴏʟꜱ 🔻*\n\n──────────────\n──────────────\n\n*Cᴏᴍᴍᴀɴᴅꜱ »* `".ACTION."`\n\n*Uꜱᴇʀ 🔻*\n\n[".USER_FIRST_NAME."](tg://user?id=".USER_ID.")\n\n*Aᴅᴍɪɴ 🔻*\n\n[".__USER_FIRST_NAME__."](tg://user?id=".__USER_ID__.")\n\n[Bᴏᴛ Mᴇꜱꜱᴀɢᴇ Lɪɴᴋ](https://t.me/c/"._CHAT_ID_."/"._MESSAGE_ID_.")\n\n──────────────\n──────────────",
				'parse_mode'=>"markdown",
				'disable_web_page_preview'=>"true"
			]);


			if ( ACTION == "mute" ){

				bot('restrictChatMember',[
					'chat_id'=>_CHAT_ID,
					'user_id'=>USER_ID,
					'until_date'=>'0'
				]);

				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗* [".USER_FIRST_NAME."](tg://user?id=".USER_ID.")$warns_info$warns_reason* $explanation Süresiz Susturuldun..*",
					'parse_mode'=>"markdown"
				]);

			}

			if ( ACTION == "unmute" ){

				bot('restrictChatMember',[
					'chat_id'=>_CHAT_ID,
					'user_id'=>USER_ID,
					'can_change_info'=>'true',
					'can_invite_users'=>'true',
					'can_pin_messages'=>'true',
					'can_send_messages'=>'true',
					'can_send_media_messages'=>'true',
					'can_send_polls'=>'true',
					'can_send_other_messages'=>'true',
					'can_add_web_page_previews'=>'true',
					'until_date'=>'0'
				]);

				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗* [".USER_FIRST_NAME."](tg://user?id=".USER_ID.") *Tekrardan Konuşmana İzin Verildi...*",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);

			}

			if ( ACTION == "tmute" ){

				bot('restrictChatMember',[
					'chat_id'=>_CHAT_ID,
					'user_id'=>USER_ID,
					'until_date'=>$unix_duration
				]);

				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗* [".USER_FIRST_NAME."](tg://user?id=".USER_ID.")$warns_info$warns_reason *$explanation $duration_str Süreyle Susturuldun..*",
					'parse_mode'=>"markdown"
				]);

			}

			if ( ACTION == "ban" ){

				bot('banChatMember',[
					'chat_id'=>_CHAT_ID,
					'user_id'=>USER_ID,
					'until_date'=>0
				]);

				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗* [".USER_FIRST_NAME."](tg://user?id=".USER_ID.")$warns_info$warns_reason *$explanation Banlandın..*",
					'parse_mode'=>"markdown"
				]);

			}

			if ( ACTION == "unban" ){

				bot('restrictChatMember',[
					'chat_id'=>_CHAT_ID,
					'user_id'=>USER_ID,
					'can_change_info'=>'true',
					'can_invite_users'=>'true',
					'can_pin_messages'=>'true',
					'can_send_messages'=>'true',
					'can_send_media_messages'=>'true',
					'can_send_polls'=>'true',
					'can_send_other_messages'=>'true',
					'can_add_web_page_previews'=>'true',
					'until_date'=>'0'
				]);

				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗* [".USER_FIRST_NAME."](tg://user?id=".USER_ID.") *Ban Kaldırıldı, Tekrardan Gruba Katılmana İzin Verildi..*",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);

			}

			if ( ACTION == "tban" ){

				bot('banChatMember',[
					'chat_id'=>_CHAT_ID,
					'user_id'=>USER_ID,
					'until_date'=>$unix_duration
				]);

				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗* [".USER_FIRST_NAME."](tg://user?id=".USER_ID.")$warns_info$warns_reason *$explanation $duration_str Süreyle Banlandın..*",
					'parse_mode'=>"markdown"
				]);

			}

			if ( ACTION == "kick" ){

				bot('banChatMember',[
					'chat_id'=>_CHAT_ID,
					'user_id'=>USER_ID,
					'until_date'=>$unix_duration
				]);

				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗* [".USER_FIRST_NAME."](tg://user?id=".USER_ID.")$warns_info$warns_reason *$explanation Gruptan Çıkarıldın..*",
					'parse_mode'=>"markdown"
				]);

			}
		}
	}
}



/////////////////////////



?>
