<?php

function Replace($name="0",$data_status="0",$status="0",$action="0",$duration="0",$duration_str="0",$limit="0") {

	if ($data_status == "true"){
		
		$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
	
	}else{
	
		$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'));
	
	}

	
	$data_location = 'COMMAND_FILES/DATA_FILE/data.json';
	
	$json = json_encode($data, JSON_PRETTY_PRINT);

	
	if ( $name != "0" and $data_status != "0" ){

		$_name = str_replace("_","",$name);

		$command_name = ucfirst($_name);


		if (preg_match("/^(on|off)*$\b/",_USER_MESSAGE[1]) and $status != "0" ){

			$command = "status";

			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*✅ $command_name Status » "._USER_MESSAGE[1]."*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);

			$old = $status;
			$new = _USER_MESSAGE[1];
		}
		
		if (preg_match("/^(warn|mute|tmute|ban|tban|kick)*$\b/",_USER_MESSAGE[1]) and $action != "0" ){
			
			$command = "action";
			
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*✅ $command_name Action » "._USER_MESSAGE[1]."*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
			
			$old = $action;
			$new = _USER_MESSAGE[1];
		}
	
		if (preg_match("/^[1-9][0-9]*(m|h|d|w)$/", _USER_MESSAGE[1]) and $duration != "0" and $duration_str != "0" ){
			
			$duration_int_control = preg_match("/[0-9]*/", _USER_MESSAGE[1], $_duration_integer);
			$duration_str_control = preg_match("/(m|h|d|w)/", _USER_MESSAGE[1], $_duration_string);
			$duration_integer = $_duration_integer[0];
			$duration_string = $_duration_string[0];



			if ( $duration_string == "m" ){
				$_duration = "60";
				$new_duration_str = "$duration_integer Dakika";
			}

			if ( $duration_string == "h" ){
				$_duration = "3600";
				$new_duration_str = "$duration_integer Saat";
			}
			
			if ( $duration_string == "d" ){
				$_duration = "86400";
				$new_duration_str = "$duration_integer Gun";
			}

			if ( $duration_string == "w" ){
				$_duration = "604800";
				$new_duration_str = "$duration_integer Hafta";
			}


			$new_duration = $duration_integer * $_duration;


			$commands_1 = "duration";
			
			$commands_2 = "duration_str";

			
			$replace = str_replace(
				[
					"\"$name$commands_1\": \"$duration\"",
					"\"$name$commands_2\": \"$duration_str\""
				],
				[
					"\"$name$commands_1\": \"$new_duration\"",
					"\"$name$commands_2\": \"$new_duration_str\""
				],$json);


			file_put_contents($data_location, $replace);

			file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");
			
			
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*✅ $command_name Duration » $new_duration_str*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);

		}

		if (preg_match("/^[1-9][0-9]*$/", _USER_MESSAGE[1]) and $limit != "0" ){

			$command = "limit";
			
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> "*✅ $command_name Limit » "._USER_MESSAGE[1]."*",
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);

			$old = $limit;
			$new = _USER_MESSAGE[1];
		}

		if ($command){
			
			
	
			$replace = str_replace("\"$name$command\": \"$old\"","\"$name$command\": \"$new\"", $json);			
	
			file_put_contents($data_location, $replace);
		
			file_upload ("COMMAND_FILES/DATA_FILE/data.json","data.json");
		}
	
	}
}




?>
