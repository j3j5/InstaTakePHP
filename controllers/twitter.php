<?php


// Remove the slash from the URI and check whether the provided username is valid
if(!is_valid_username($username)) {
	$view = 'twitter';
	return;
}



$image_counter = 0;
echo "Downloading...</br>";
twitter($username);
echo "Done!";
