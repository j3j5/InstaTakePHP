<?php


// Remove the slash from the URI and check whether the provided username is valid
if(!is_valid_username($username)) {
	$view = 'instagram';
	return;
}



$image_counter = 0;
echo "Downloading...</br>";
instagram($username);
echo "Done!";
