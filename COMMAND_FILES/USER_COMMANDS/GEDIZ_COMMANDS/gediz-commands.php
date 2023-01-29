<?php

/////////////////////////

# GEDİZ COMMANDS


if ( $User_Message[0] == "/gediz" or $User_Message[0] == "/gediz$Bot_Username" ){

	if ( isset($User_Message[4]) ){

		$faturaFiyat   = $User_Message[1];
		$toplamGuc     = $User_Message[2];
		$kwFiyat       = $faturaFiyat / $toplamGuc;
		$eskiEndeks    = $User_Message[3];
		$yeniEndeks    = $User_Message[4];
		$kullanilanGuc = $yeniEndeks - $eskiEndeks;
		$kullanilanGucFiyat = $kullanilanGuc * $kwFiyat;
		
		if ( isset($User_Message[5]) ){
			$gunlukKullanimFiyat = $kullanilanGucFiyat / $User_Message[5];
			
			$aylikKullanimFiyat = "🔸 Oʀᴛᴀʟᴀᴍᴀ Aʏʟɪᴋ Kᴜʟʟᴀɴɪʟᴀɴ Gᴜᴄ Fɪʏᴀᴛ » `".$gunlukKullanimFiyat * 30 ." `TL\n\n";

		}else{
			$aylikKullanimFiyat = null;
		}

		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Gᴇᴅɪᴢ Cᴏᴍᴍᴀɴᴅꜱ 🔻*\n\n──────────────\n\n🟢 Sᴏɴ Eɴᴅᴇᴋꜱ » `$yeniEndeks \n\n\n`🔸 Kw Fɪʏᴀᴛ » `$kwFiyat`\n\n🔸 Kᴜʟʟᴀɴɪʟᴀɴ Gᴜᴄ » `$kullanilanGuc`\n\n🔸 Kᴜʟʟᴀɴɪʟᴀɴ Gᴜᴄ Fɪʏᴀᴛ » `$kullanilanGucFiyat` TL\n\n $aylikKullanimFiyat ──────────────",
			'parse_mode'=>"markdown",
			'disable_web_page_preview'=>"true",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

	}else{
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*Gᴇᴅɪᴢ Cᴏᴍᴍᴀɴᴅꜱ 🔻*\n\n──────────────\n\n`/gediz faturaFiyat toplamGüç eskiEndeks yeniEndeks` \n\n`/gediz faturaFiyat toplamGüç eskiEndeks yeniEndeks aylıkHesaplama(Gün gir)` \n\n──────────────",
			'parse_mode'=>"markdown",
			'disable_web_page_preview'=>"true",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
	
	}

	exit();


}

/////////////////////////



?>
