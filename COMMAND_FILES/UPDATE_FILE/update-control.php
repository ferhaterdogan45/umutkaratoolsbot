<?php

date_default_timezone_set('Europe/Istanbul');
$update_encode = json_encode($update, JSON_PRETTY_PRINT);
$message_date = $update->message->date;
 
$update_time = "2 day";

/////////////////////////

# UPDATE & UPDATES FİLE SAVE 


file_put_contents("COMMAND_FILES/UPDATE_FILE/update.json",$update_all);


file_put_contents("COMMAND_FILES/UPDATE_FILE/updates.json",$update_all, FILE_APPEND);

/////////////////////////




/////////////////////////

# UPDATES FİLE CLEAR

$day =strtotime("+$update_time");
$date_all = date("YmdHis", $day);
$unix_date = new DateTime("$date_all");
$new_unix_date = $unix_date->getTimestamp();

/*
if (!file_exists("COMMAND_FILES/UPDATE_FILE/updates_file_control_time")){
	file_put_contents("COMMAND_FILES/UPDATE_FILE/updates_file_control_time", $new_unix_date);
}
 */


$date_file_control = file_get_contents('COMMAND_FILES/UPDATE_FILE/updates_file_control_time');

if ($message_date > $date_file_control){
	file_put_contents("COMMAND_FILES/UPDATE_FILE/updates_file_control_time", $new_unix_date);
	file_put_contents("COMMAND_FILES/UPDATE_FILE/updates.json",$update_all);
}


/////////////////////////


?>
