<?php

if(!isset($_REQUEST['username'])){
	echo json_encode(array('result' => 401, 'error' => 'Username missing.'));
	exit;
}

if(!function_exists($_REQUEST['network'])) {
	echo json_encode(array('result' => 401, 'error' => 'That is not a valid network.'));
	exit;
} else {
	$network = filter_input(INPUT_POST, 'network', FILTER_SANITIZE_STRING);
}
$req = trim($_REQUEST['username']);
if(!is_valid_username($req)) {
	echo json_encode(array('result' => 401, 'error' => 'That is not a valid username.'));
	exit;
} else {
	$username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
}
if(isset($_REQUEST['max_pics']) && intval($_REQUEST['max_pics'])) {
	$max_number_images = intval($_REQUEST['max_pics']);
}


$result = $network($username);

echo json_encode($result);
// There's no view, so stop the execution here
exit;
