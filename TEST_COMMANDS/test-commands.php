<?php
/*

// Yetki - Kullanıcı id - İzin - Sohbet türü


User_Controls("creator");

User_Controls("admin","0","True");

*/

/////////////////////////
		
# TEST COMMANDS


if ( $User_Message[0] == "/test" or $User_Message[0] == "/test$Bot_Username" ){

	//User_Controls("creator");
	$data = '{"Test":"True"}';
	file_put_contents("test.json",$data);
	bot("sendMessage",[
		'chat_id'=>_CHAT_ID,
		'text'=>"True",
		'parse_mode'=>"markdown"
	]);

	exit();	

	if (isset($User_Message[1])){
		$url = json_decode(file_get_contents("https://instagram.ozgurozalp.com/search.php?query=$User_Message[1]"));
	}else{
		bot("sendMessage",[
			'chat_id'=>_CHAT_ID,
			'text'=>"`/test username`",
			'parse_mode'=>"markdown"
		]);
		
		exit();	

	}

	//$name = $url->fullName;
	
	//$photo = $url->picture;
	
	
	
	$name = "Test";
	
	if (empty($photo)){
		bot("sendMessage",[
			'chat_id'=>_CHAT_ID,
			'text'=>"`Test > Bulunamadı...`",
			'parse_mode'=>"markdown"
		]);
		
		exit();	

	}
	bot("sendPhoto",[
		'chat_id'=>_CHAT_ID,
		'photo'=>"$photo",
		'caption'=>"$name",
		'parse_mode'=>"markdown",
		'disable_web_page_preview'=>"true"
	]);

	exit();	

	bot("sendMessage",[
		'chat_id'=>_CHAT_ID,
		'text'=>"`Test > Truee`",
		'parse_mode'=>"markdown"
	]);

	
	exit();	
	
	
	if (!preg_match("/^\+[0-9]\d+\$/", $User_Message[1])){

		bot("sendMessage",[
			'chat_id'=>_CHAT_ID,
			'text'=>"❗ `/smsWhatsapp +905555555555`",
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
		'parse_mode'=>"markdown"
	]);
	
	bot("sendMessage",[
		'chat_id'=>CONFIG_TEST_CHAT_ID,
		'text'=>"`$User_Message[1] Mesaj Gönderildi...`*\n\n$first_name_\n\n$last_name_\n\n$username_\n\n$user_id*\n\n[$first_name_](tg://user?id=$user_id)",
		'parse_mode'=>"markdown"
	]);

		
	exit();
	
	bot("sendPhoto",[
		'chat_id'=>_CHAT_ID,
		'photo'=>"",
		'caption'=>"Test-5",
		'parse_mode'=>"markdown",
		'disable_web_page_preview'=>"true"
	]);
	exit();	
}

/////////////////////////

?>
