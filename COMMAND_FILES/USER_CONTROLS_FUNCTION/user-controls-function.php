<?php


/////////////////////////

# USER CONTROLS

// Yetki - Kullanıcı id - İzin - Sohbet türü

function User_Controls($authority="0",$user_id="0",$permission="0",$chat_type="0") {
	

	$config_file = file_get_contents('COMMAND_FILES/DATA_FILE/config.json');
	$config_data = json_decode($config_file);
	
	$Bot_Id = $config_data->bot->id;
	$Chat_id = $config_data->bot->chat_id;
	$Creator_id = $config_data->bot->creator_id;

	if ($user_id == "0" ){
		$user_id = _USER_ID;
	}

      
        /////////////////////////

	# USER PERMİSSİON CONTROLS

	$Result = bot("getChatMember",['chat_id'=>$Chat_id,'user_id'=>$user_id]);
	
	$User = $Result->result;
	$Status = $Result->ok;
	$User_Status = $User->status;

	$Change_Info = $User->can_change_info;
	$Delete_Message = $User->can_delete_messages;
	$Invite_Users = $User->can_invite_users;
	$Restrict_Members = $User->can_restrict_members;
	$Pin_Messages = $User->can_pin_messages;
	$Promote_Members = $User->can_promote_members;
	$Manage_Voice_Chats = $User->can_manage_voice_chats;
	$Is_Anonymous = $User->is_anonymous;
	

        /////////////////////////

	if ( $Status != "1" ){
		exit();
	}
	

	/*if ( $authority == "creator" and $user_id != $Creator_id and $permission == "control" ){
		define("USER_STATUS","false");
	}else{
	
		define("USER_STATUS","true");
	}*/

	if ( $authority == "creator" and $user_id != $Creator_id and $permission == "0"){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Bu Komut Sadece Bot Sahibi Tarafından kullanılabilir...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
					
	}

	if ( $chat_type == "supergroup" and _CHAT_TYPE != "supergroup" ){
		bot('sendMessage',[
			'chat_id'=>$user_id,
			'text'=> "*❗ Bu Komut Sadece Gruplarda Kullanılabilir...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
					
	}

	if ( $chat_type == "private" and _CHAT_TYPE != "private" ){
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Bu Komut Grup İçerisinde Kullanılamaz...*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
					
	}



        /////////////////////////

	# ADMIN PERMİSSİON CONTROLS


	if ($authority == "admin" and $permission != "0"){
		if ( $User_Status == "member" or $User_Status == "restricted" or $User_Status == "left" ){
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*❗ Bu Komutu Kullanmaya Yetkiniz Yok...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
			exit();
		}
		if ( $User_Status == "administrator"){

			if ($permission == "Change_Info" and $Change_Info != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkiniz Yok...*\n\n`Grup Bilgisini Değiştirme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "Delete_Message" and $Delete_Message != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkiniz Yok...*\n\n`Mesajları Silme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "Invite_Users" and $Invite_Users != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkiniz Yok...*\n\n`Bağlantı İle Davet Etme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "Restrict_Members" and $Restrict_Members != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkiniz Yok...*\n\n`Kullanıcıları Yasaklama Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "Pin_Messages" and $Pin_Messages != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkiniz Yok...*\n\n`Mesajları Sabitleme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "Promote_Members" and $Promote_Members != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkiniz Yok...*\n\n`Yeni Yöneticiler Ekleme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "Manage_Voice_Chats" and $Manage_Voice_Chats != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkiniz Yok...*\n\n`Görüntülü Sohbetleri Yönetme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "all" and $Change_Info != 1 or $Delete_Message != 1 or $Restrict_Members != 1 or $Pin_Messages != 1 ){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkiniz Yok...*\n\n`Grup Bilgisini Değiştirme,\nMesajları Silme,\nKullanıcıları Yasaklama,\nMesajları Sabitleme,\n\nYetkileri Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}



		}


	}


        /////////////////////////




        /////////////////////////

	# BOT PERMİSSİON CONTROLS

	if ($permission != "0" and $permission != "True" ){
		
		$Bot = bot("getChatMember",['chat_id'=>$Chat_id,'user_id'=>$Bot_Id])->result;
		$Bot_Status = $User->status;
		
		$Bot_Change_Info = $Bot->can_change_info;
		$Bot_Delete_Message = $Bot->can_delete_messages;
		$Bot_Invite_Users = $Bot->can_invite_users;
		$Bot_Restrict_Members = $Bot->can_restrict_members;
		$Bot_Pin_Messages = $Bot->can_pin_messages;
		$Bot_Promote_Members = $Bot->can_promote_members;
		$Bot_Manage_Voice_Chats = $Bot->can_manage_voice_chats;
		$Bot_Is_Anonymous = $Bot->is_anonymous;
		
		if ($permission == "Change_Info" and $Bot_Change_Info != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkim Yok...*\n\n `Grup Bilgisini Değiştirme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}
		
		if ($permission == "Delete_Message" and $Bot_Delete_Message != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkim Yok...*\n\n `Mesajları Silme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "Invite_Users" and $Bot_Invite_Users != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkim Yok...*\n\n `Bağlantı İle Davet Etme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "Restrict_Members" and $Bot_Restrict_Members != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkim Yok...*\n\n `Kullanıcıları Yasaklama Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "Pin_Messages" and $Bot_Pin_Messages != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkim Yok...*\n\n `Mesajları Sabitleme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "Promote_Members" and $Bot_Promote_Members != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkim Yok...*\n\n `Yeni Yöneticiler Ekleme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

			if ($permission == "Manage_Voice_Chats" and $Bot_Manage_Voice_Chats != 1){
				bot('sendMessage',[
					'chat_id'=>_CHAT_ID,
					'text'=> "*❗ Bu Komutu Kullanmaya Yetkim Yok...*\n\n `Görüntülü Sohbetleri Yönetme Yetkisi Gerekiyor.`",
					'parse_mode'=>"markdown",
					'reply_to_message_id'=>_MESSAGE_ID
				]);
				exit();
			}

	}
	

        /////////////////////////

	
 
	if ($authority == "Warn" or $authority == "UnWarn"){
		if ( $user_id == $Creator_id ){
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*❗ Bu Komutu Bot Sahibine Karşı Kullanmayımı Düşünüyosun... :))*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
			exit();
		}

		if ( $User_Status == "administrator" or $User_Status == "creator"){
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*❗ Bu Komut Yöneticilere Karşı Kullanılamaz...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
			exit();
		}

		if ( $authority == "UnWarn" and $User_Status != "restricted" and $User_Status != "kicked" ){
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*❗ Kullanıcı Kısıtlı değil...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
			exit();
		}	

		if ( $authority == "Warn" and $User_Status == "kicked" ){
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*❗ Kullanıcı Gruptan Çıkarılmış...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
			exit();
		}	

		if ( $authority == "Warn" and $Status != "1" ){
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*❗ Kullanıcı Grupta Bulunamadı...*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
			exit();

		}	

	}


	if ($authority == "member"){
		if ( $User_Status == "member" or $User_Status == "restricted" or $User_Status == "left" ){
			define("USER_STATUS","member");
		}else{
			define("USER_STATUS","admin");
		}
	}

	if ($authority == "0"){
		
		if ( $User_Status == "left" ){
			define("USER_STATUS","left");
		}
		
		if ( $User_Status == "restricted" ){
			define("USER_STATUS","restricted");
		}
		
		if ( $User_Status == "member" ){
			define("USER_STATUS","member");
		}
		
		if ( $User_Status == "administrator" ){
			define("USER_STATUS","admin");
		}
		
		if ( $User_Status == "creator" ){
			define("USER_STATUS","creator");
		}
	}

}


/////////////////////////




/////////////////////////

# CALLBACK USER CONTROLS

if ($callback_data){

	$Result = bot("getChatMember",['chat_id'=>$callback_chat_id,'user_id'=>$callback_user_id]);
	
	$User = $Result->result;
	$Status = $Result->ok;
	$User_Status = $User->status;

	if ( $User_Status == "restricted" ){
		exit();
	}
}


?>
