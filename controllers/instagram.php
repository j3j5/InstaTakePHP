<?php

if(!is_valid_username($username)) {
	$view = 'instagram';
	return;
}



$image_counter = 0;
echo "Downloading...</br>";
instagram($username);
echo "Done!";
