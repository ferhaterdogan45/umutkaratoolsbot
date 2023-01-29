<?php


/////////////////////////

# WARN REMOVE


if( $callback_data ){
	if ( $callback_result[0] == "warn" ){
		
		$warns_file = json_decode(file_get_contents('COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/user_warns_file/warns.json'),true);
		$warns_file_location = 'COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/user_warns_file/warns.json';
		
		User_Controls("member");

		
		if ( USER_STATUS != "member" ){

			foreach ($warns_file as $keys => $value){
				if ($warns_file["$keys"]["0"]["id"] == $callback_result[1]){
					$warns_count = count($warns_file["$keys"]);
					
					if ( $callback_result[3] == "all" ){
						$warns_count = "1";
						$all = "Tüm ";
						$_callback_entities_first_name = "$callback_result[2]";

					}
					
					if ($warns_count == "1" ){
						unset($warns_file["$keys"]);
						break;
					}else{
						unset($warns_file["$keys"]["$callback_result[2]"]);
					break;
					}
				
				}
			}
			
			$json = json_encode($warns_file, JSON_PRETTY_PRINT);
			file_put_contents($warns_file_location, $json);
			
			file_upload ("$warns_file_location","warns.json");
		
			bot('editMessageText',[
				'chat_id'=>$callback_chat_id,
				'message_id'=>$callback_message_id,
				'text'=>"*Yönetici* [$_callback_first_name](tg://user?id=$callback_user_id), [$_callback_entities_first_name](tg://user?id=$callback_result[1]) *Adlı Kullanıcının ".$all." Uyarısını Kaldırdı..*",
				'parse_mode'=>"markdown"
			]);
			exit();
		}else{
			bot('answerCallbackQuery',[
				'callback_query_id'=>$callback_id,
				'text'=>"❗ Uyarıyı Sadece Yöneticiler Kaldırabilir..",
				'show_alert'=>"true"
			]);
			exit();
		}
	}
}



/////////////////////////






?>
