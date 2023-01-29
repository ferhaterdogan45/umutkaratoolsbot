<?php

/////////////////////////

# REPORT COMMANDS


if ( $User_Message[0] == "/report" or $User_Message[0] == "/report$Bot_Username" ){

	User_Controls("0","0","0","supergroup");

	if ($reply_user_id){

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "**Rᴇᴘᴏʀᴛ* 🔻*\n\n──────────────\n\n[$reply_first_name_](tg://user?id=$reply_user_id) \n\n*Adlı Kullanıcının grup kurallarını ihlal ettiğini düşündüğün mesajını yöneticilere incelenmek üzere bildirdim.*\n\n*Eyvallah * [$first_name_](tg://user?id=$user_id) * :)*\n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

		$_chat_id = explode("-100", $chat_id);

		bot('sendMessage',[
			'chat_id'=>$Config_Private_Chat_id,
			'text'=> "*Rᴇᴘᴏʀᴛ Mᴇꜱꜱᴀɢᴇ 🔻*\n\n──────────────\n──────────────\n\n*Sɪᴋᴀʏᴇᴛ Eᴅɪʟᴇɴ*\n\n\n[$reply_first_name_](tg://user?id=$reply_user_id)\n\n`$reply_text`\n\n[Message Link](https://t.me/c/$_chat_id[1]/$reply_message_id)\n\n──────────────\n\n*Sɪᴋᴀʏᴇᴛ Eᴅᴇɴ*\n\n\n[$first_name_](tg://user?id=$user_id)\n\n[Message Link](https://t.me/c/$_chat_id[1]/$message_id)\n\n──────────────\n──────────────",
			'parse_mode'=>"markdown",
			'disable_web_page_preview'=>"true"
		]);


	}else{
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "**Rᴇᴘᴏʀᴛ* 🔻*\n\n──────────────\n\n*Bir kullanıcının grup kuralllarını ihlal ettiği bir mesajı yöneticilere bildirmek istiyorsan o mesajı yanıtla ve* `/report` *yaz...*\n\n\n*Not : Eğer ki mesaj da grup kurallarını ihlal eden birşey yok ise cezalandırılacaksın. ❗* \n\n──────────────",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

	}

}

/////////////////////////


?>
