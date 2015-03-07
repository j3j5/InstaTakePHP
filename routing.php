<?php

// CLI execution
if(PHP_SAPI == 'cli') {

// 	isset($argv[1])
	var_dump($argv); exit;
	$username = $argv[1];
// WEBSERVER
} else {
	// The url is as follows http://yourserver.com/controller/username
	$url_structure = array(
		'controller',
		'username'
	);

	$uri_segments = FALSE;
	if(mb_strlen($_SERVER['REQUEST_URI']) > 1) { // Homepage has '/' as REQUEST_URI
		$uri_segments = explode('/', $_SERVER['REQUEST_URI']);
	}
	if(is_array($uri_segments)) {
		foreach($url_structure AS $key => $component) {
			if(isset($uri_segments[$key+1])) {
				${$component} = $uri_segments[$key+1];
			}
		}
		if(!is_file(__DIR__ . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR . "$controller.php")) {
			$controller = '404';
		}
	} else {
		// Default controllers
		$controller = 'landing';
		$username = '';
	}
}
