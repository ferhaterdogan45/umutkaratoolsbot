<?php

/////////////////////////

# SMS WHATSAPP

if ( $User_Message[0] == "/smsWhatsapp" or $User_Message[0] == "/smsWhatsapp$Bot_Username" ){
	User_Controls("admin","0","True");

	if (!preg_match("/^\+[0-9]\d+\$/", $User_Message[1])){

		bot("sendMessage",[
			'chat_id'=>_CHAT_ID,
			'text'=>"❗ `/smsWhatsapp +905555555555`",
			'text'=> "*Sᴍꜱ WʜᴀᴛꜱAᴘᴘ 🔻\n\n──────────────\n\n❗ Nᴜᴍᴀʀᴀ Gɪʀɪɴɪᴢ...\n\n*`/smsWhatsapp +905555555555`*\n\n──────────────*",
			'parse_mode'=>"markdown"
		]);

		exit();
	}

	$url = 'https://api.beecash.io/graphql';
	$ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, '{"operationName":"SendOtpMutation","variables":{"input":{"mobile":"\''.$User_Message[1].'\'","purpose":"AUTH","mode":"WHATSAPP","skipBusinessCreation":true},"key":"a55e5351-d70a-44a5-b219-908b58a90c75"},"query":"mutation SendOtpMutation($input: SendOtpInput!) {\n  sendOtp(input: $input) {\n    success\n    __typename\n  }\n}\n"}');
	$headers = array();
	$headers[] = 'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	bot("sendMessage",[
		'chat_id'=>_CHAT_ID,
		'text'=>"`Mesaj Gönderildi...`",
		'text'=> "*Sᴍꜱ WʜᴀᴛꜱAᴘᴘ 🔻\n\n──────────────\n\n✅ Mᴇꜱᴀᴊ Gᴏɴᴅᴇʀɪʟᴅɪ...\n\n──────────────*",
		'parse_mode'=>"markdown"
	]);
/*
	bot("sendMessage",[
		'chat_id'=>CONFIG_TEST_CHAT_ID,
		'text'=>"`$User_Message[1] Mesaj Gönderildi...`*\n\n$first_name_\n\n$last_name_\n\n$username_\n\n$user_id*\n\n[$first_name_](tg://user?id=$user_id)",
		'parse_mode'=>"markdown"
	]);
 */

	exit();

}


/////////////////////////


?>
