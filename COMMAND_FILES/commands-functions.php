<?php


/////////////////////////

# FİLTERS FUNCTİONS


class Filters {
	
	
	/////////////////////////

	# FİLTERS NAMES


	function names($filter,$filters="filters") {
		
		$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
		$filters_name = " ";
		//unset($data["data"]["$filter"]["$filters"][0]);
		
		if ($data["data"]["$filter"]["$filters"]){
			$lines = count($data["data"]["$filter"]["$filters"]);
			for ($i = 0; $i <= $lines-1; $i++) {
				
				$filters_name .= "*-*`".$data["data"]["$filter"]["$filters"]["$i"]["name"]."`\n";
			}	
			
			bot('sendMessage',[
				'chat_id'=>_CHAT_ID,
				'text'=> $filters_name,
				'parse_mode'=>"markdown",
				'reply_to_message_id'=>_MESSAGE_ID
			]);
		}
	}
	
	/////////////////////////
	
	# FİLTERS DATAS


	function datas() {
		$data = json_decode(file_get_contents('COMMAND_FILES/DATA_FILE/data.json'), true);
		$filters = "filters";
		$filters_name = " ";
		
		
		if ($data["data"]["$filters"]["filters"]){
			$lines = count($data["data"]["$filters"]["filters"]);
			for ($i = 0; $i <= $lines-1; $i++) {
				$data_id = $data["data"]["$filters"]["filters"]["$i"]["data_id"];
				$_filters_name = $data["data"]["$filters"]["filters"]["$i"]["name"];
				$_filters_text = $data["data"]["$filters"]["filters"]["$i"]["text"];
				$type = $data["data"]["$filters"]["filters"]["$i"]["type"];


				$filters_name = str_replace(['_'],['\_'],$_filters_name);
				$filters_text = str_replace(['_'],['\_'],$_filters_text);
			
				if (preg_match("/$filters_name/i", _TEXT)){
					if ($type == 0){
						bot("sendMessage",[
							'chat_id'=>_CHAT_ID,
							'text'=>"$filters_text",
							'parse_mode'=>"markdown",
							'reply_to_message_id'=>_MESSAGE_ID
						]);
						$break;
					}
					if ($type == 1){
						bot("sendPhoto",[
							'chat_id'=>_CHAT_ID,
							'photo'=>"$data_id",
							'caption'=>"$filters_text",
							'parse_mode'=>"markdown",
							'reply_to_message_id'=>_MESSAGE_ID
						]);
						$break;
					}
					if ($type == 2){
						bot("sendVideo",[
							'chat_id'=>_CHAT_ID,
							'video'=>"$data_id",
							'caption'=>"$filters_text",
							'parse_mode'=>"markdown",
							'reply_to_message_id'=>_MESSAGE_ID
						]);
						$break;
					}
					if ($type == 3){
						bot("sendDocument",[
							'chat_id'=>_CHAT_ID,
							'document'=>"$data_id",
							'caption'=>"$filters_text",
							'parse_mode'=>"markdown",
							'reply_to_message_id'=>_MESSAGE_ID
						]);
						$break;
					}
					define("_STATUS","true");
				}
			}
		}else{ define("_STATUS","false"); }
	}

}


/////////////////////////




/////////////////////////

# REPLY MESSAGE


class Reply_Message {
	
	
	/////////////////////////
	
	# REPLY MESSAGE ERROR CODE


	function error_code() {
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Hatalı komut girildi..*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

	
	/////////////////////////
	
	# REPLY MESSAGE NO PERMİSSİON
	
	
	function no_permission() {
		bot('sendMessage',[
			'chat_id'=>_CHAT_ID,
			'text'=> "*❗ Bu komutu kullanmaya yetkiniz yok.*",
			'parse_mode'=>"markdown",
			'reply_to_message_id'=>_MESSAGE_ID
		]);
		exit();
	}

}


/////////////////////////




/////////////////////////

# REPLACE


class Replace {

	
	/////////////////////////
	
	# COMMANDS REPLACE


	function commands($old,$new) {
		$file = file_get_contents("COMMAND_FILES/DATA_FILE/data.json");
		$preg = preg_match("/$old/i", $file, $match);
		
		if ($preg){
			$output = str_replace(
				["$match[0]"],
				["$new"],
				$file);
			//file_put_contents("COMMAND_FILES/DATA_FILE/data.json", $output);
		}
	}

}


$_Controls=new Controls();
$_Filters=new Filters();
$_Reply_Message=new Reply_Message();
$_Replace=new Replace();

?>
