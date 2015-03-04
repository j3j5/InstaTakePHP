<?php
require __DIR__ . '/vendor/autoload.php';

/**
 * Config variables.
 *
 * $folder_path indicates where the images will be downloaded. Within that folder
 * the images will be stored under the username's folder. IT MUST BE WRITABLE BY THE WEBSERVER
 *
 * $max_number_images sets a maximum to the number of images to download.
 */
$folder_path = '';
$max_number_images = 500;

$twitter_settings = array(
	'consumer_key'               => 'YOUR_CONSUMER_KEY',
	'consumer_secret'            => 'YOUR_CONSUMER_SECRET',
	'token'                      => 'A_USER_TOKEN',
	'secret'                     => 'A_USER_TOKEN_SECRET',
);
