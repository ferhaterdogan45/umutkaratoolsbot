<?

exit();

define ("_DATABASE_URL_", "https://umutkaratoolsbott.000webhostapp.com");

define ("_WEBHOOK_URL_", "https://umutkaratoolsbot.herokuapp.com");

//define ("_WEBHOOK_URL_", "https://e0fc-88-242-131-174.ngrok.io");

/////////////////////////

# UPLOAD FİLE

function file_upload ($data_location,$file_name) {
	$url_data = _WEBHOOK_URL_."/$data_location";

	$send = file_get_contents (_DATABASE_URL_."/upload.php?upload=$url_data%20$file_name");

}

/////////////////////////



/////////////////////////

# DOWNLOAD FİLE

function file_download ($data_location,$file_name) {

	$new_file = file_get_contents (_DATABASE_URL_."/$file_name");

	file_put_contents ($data_location, $new_file);
}

file_download ("COMMAND_FILES/DATA_FILE/data.json","data.json");
file_download ("COMMAND_FILES/DATA_FILE/members.json","members.json");
file_download ("COMMAND_FILES/ADMIN_COMMANDS/WARN_COMMANDS/user_warns_file/warns.json","warns.json");

/////////////////////////



/////////////////////////

# COPY > upload.php

if (isset($_GET['upload'])){
	
	$upload = explode(" ", $_GET['upload']);

	$location = $upload[0];
	
	$file_name = $upload[1];

	$data_url = file_get_contents($location);
	
	if (file_exists($file_name)){
		
		$file = file_get_contents($file_name);
		
		file_put_contents(".$file_name", $file);
	}
	
	file_put_contents($file_name, $data_url);

}

/////////////////////////

# UNZİP FİLE > unzip.php

$unzip = new ZipArchive;
$out = $unzip->open('new.zip');
if ($out === TRUE) {
  $unzip->extractTo(getcwd());
  $unzip->close();
  echo 'File unzipped';
} else {
  echo 'Error';
}




/*

DATABASE FİLES
──────────────

data.json

members.json

warns.json

status.txt >  ✅ True

upload.php

onlinePhishingLink.txt

*/

?>
