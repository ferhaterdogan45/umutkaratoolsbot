<?php

/////////////////////////

# İP SCAN COMMANDS

if ( $User_Message[0] == "/ipScan" or $User_Message[0] == "/ipScan$Bot_Username" ){

	if ($User_Message[1]){
		
		$url = json_decode(file_get_contents("https://ipwhois.app/json/$User_Message[1]"));
		
		$status = $url->success;

		if ( $status != "1" ){
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*Iᴘ Iɴғᴏ 🔻*\n\n──────────────\n\n* ❗ Hatalı İp Adresi / Domain Girildi...*\n\n──────────────",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);

			exit();
		}

		$ip = $url->ip;
		
		$type = $url->type;
		
		$country = $url->country;
		
		$country_code = $url->country_code;
		
		$country_code_small = strtolower($country_code);;
		
		$country_flag = $url->country_flag;
		
		$country_phone = $url->country_phone;
		
		$region = $url->region;

		$city = $url->city;

		$latitude = $url->latitude;

		$longitude = $url->longitude;

		$asn = $url->asn;

		$org = $url->org;

		$isp = $url->isp;

		$timezone = $url->timezone;

		$currency = $url->currency;

		$ipScan_info = ("
*Iᴘ Iɴғᴏ 🔻*

──────────────


*İp  »  *`$ip`

*Type  »  *`$type` 

*Country  »  *`$country` 

*Country Code »  *`$country_code` 

*Country Phone »  *`$country_phone` 

*Region  »  *`$region` 

*City  »  *`$city` 

*Asn  »  *`$asn` 

*Org  »  *`$org` 

*İsp  »  *`$isp` 

*Timezone  »  *`$timezone` 

*Currency  »  *`$currency` 

*Location  »  *[ Link ](https://www.google.com/maps/place/$latitude,$longitude)


──────────────");

		bot('sendPhoto',[
			'chat_id'=>_CHAT_ID,
			'photo'=>"https://flagpedia.net/data/flags/w1160/$country_code_small.png",
			'caption'=> $ipScan_info,
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);

		exit();
	}

	bot('sendMessage',[
		'chat_id'=>_CHAT_ID,
		'text'=> "*Iᴘ Sᴄᴀɴ Cᴏᴍᴍᴀɴᴅꜱ 🔻*\n\n──────────────\n\n`/ipScan 149.154.167.99`\n\n`/ipScan telegram.org`\n\n──────────────",
		'parse_mode'=>"markdown",
		'reply_to_message_id'=>_MESSAGE_ID
	]);

	exit();

}

/////////////////////////



?>
