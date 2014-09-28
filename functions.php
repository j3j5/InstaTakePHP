<?php

/**
 * Check the folder where it'll download the images and download the URLs from
 * Instagram's endpoint.
 */
function instagram($username) {
	global $folder_path;
	global $image_counter, $max_number_images;
	// Check whether the folder is writable
	if(is_writable($folder_path)) {
		$pic_folder = $folder_path . $username;
		if(!is_dir($pic_folder)) {
			$result = mkdir($pic_folder);
			if(!$result) {
				echo 'The folder ' . $pic_folder . ' could not be created.';
				exit;
			}
			// The folder is set with 777 because, unless it was already created
			chmod($pic_folder, 0777);
		}
	} else {
		echo 'The folder ' . $folder_path . ' is not writable.';
		exit;
	}
	$pic_folder .= '/';

	$last_id = '';
	$stop = FALSE;
	while($stop === FALSE) {
		$url = "http://instagram.com/$username/media?max_id=$last_id";
		// Fetch the JSON from Instagram, TODO: add error handling in case the endpoint doesn't return proper data
		$json = file_get_contents($url);
		$data = json_decode($json, TRUE);
		$last_id = retrieve_images($data, $pic_folder);

		if(!isset($data['more_available']) OR !$data['more_available'] OR empty($last_id) OR $image_counter >= $max_number_images) {
			$stop = TRUE;
		}
	}
}

/**
 * Retrieve the actual pics from the URLs provided by Instagram's endpoint.
 */
function retrieve_images($data, $pic_folder) {
	global $image_counter, $max_number_images;

	$last_id = '';
	if(!empty($data) && isset($data['items']) && is_array($data['items'])) {
		foreach($data['items'] AS $item) {
			if(isset($item['images']['standard_resolution']['url'])) {
				$last_id = $item['id'];
				$image_url = $item['images']['standard_resolution']['url'];
				$pic_path = $pic_folder.$last_id.mb_substr($image_url, -4);

				// Download the image
				$pic = file_get_contents($image_url);
				$result = file_put_contents($pic_path, $pic);
				if($result === FALSE) {
					echo "There was a problem while downloading and image. Please, check the permissions.";
					exit;
				}
				// Set permissions
				chmod($pic_path, 0666);
			}
			if($image_counter >= $max_number_images) {
				break;
			}
		}
	}
	return $last_id;
}

/**
 * Check whether the provided username is a valid Instagram one
 */
function is_valid_username($username) {
	$valid_username_pattern = "/^[a-zA-Z0-9._]{1,30}$/";
	return (bool) preg_match($valid_username_pattern, $username);
}
