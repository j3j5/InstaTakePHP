<?php

require('config.php');
require("functions.php");
if(!isset($_REQUEST['username'])){
	echo json_encode(array('result' => 401, 'error' => 'Username missing.'));
	exit;
}

if(!is_valid_username($_REQUEST['username'])) {
	echo json_encode(array('result' => 401, 'error' => 'That is not a valid username.'));
	exit;
}

if(isset($_REQUEST['max_pics']) && intval($_REQUEST['max_pics'])) {
	$max_number_images = intval($_REQUEST['max_pics']);
}


$result = instagram($_REQUEST['username']);

echo json_encode($result);
