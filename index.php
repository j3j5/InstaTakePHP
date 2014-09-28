<?php
require('config.php');
// Read the username
if($_SERVER['REQUEST_URI'] === '/') {
	include('landing.php');
	exit;
}
require('functions.php');

// Remove the slash from the URI and check whether the provided username is valid
$username = str_replace('/', '', $_SERVER['REQUEST_URI']);
if(!is_valid_username($username)) {
	echo "You must specify a valid username.";
	exit;
}

$image_counter = 0;
echo "Downloading...</br>";
instagram($username);
echo "Done!";
