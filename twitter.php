<?php

require('config.php');
require('twitterapi.php');

$api = new TwitterApi($twitter_settings);

$i = 1;
$count = 0;
$tweets = array();
$user = array();
$username = 'deportado4443';
foreach($api->cursorize_timeline('statuses/user_timeline.json', array('screen_name' => $username, 'count' => 200)) as $page) {
	echo "Retrieving page $i" . PHP_EOL;
	if(is_array($page) ) {
		$tweets = array_merge($tweets, $page);
	}
	$i++;
}
$date_groups = array();
$path = "$folder_path/twitter/$username";
echo "Sorting tweets" . PHP_EOL;
foreach($tweets AS $tweet) {
	$date_file = date("Y_m", strtotime($tweet['created_at']));
	echo "Adding tweet {$tweet['id']}" . PHP_EOL;
	if(empty($user) && $tweet['user']['screen_name'] == $username) {
		$user = $tweet['user'];
	}
	if(!isset($date_groups[$date_file])) {
		$date_groups[$date_file]['date'] = date("Y-m-d", strtotime($tweet['created_at']));
	}
	$date_groups[$date_file]['tweets'][] = $tweet;
}
echo 'DONE!'. PHP_EOL;

echo "Writing into files..." . PHP_EOL;

$index_filename = "$path/tweet_index.js";
$index_text = 'var tweet_index = ';
$index_array = array();

foreach($date_groups AS $date => $data) {
	$tweets_filename = "$path/tweets/$date.js";
	if(!is_dir("$path/tweets") && !mkdir("$path/tweets") && !is_writable("$path/tweets")) {
		echo "Error creating the folder at $path/tweets." . PHP_EOL;
		exit;
	}

	if(is_file($tweets_filename)) {
		unlink($tweets_filename);
	}

	$tweets_text = "Grailbird.data.tweets_$date = ". PHP_EOL;
	$tweets_text .= json_encode($data['tweets']);
	file_put_contents($tweets_filename, $tweets_text);
	echo "Done with $tweets_filename. Adding to the index." . PHP_EOL;

	// Add to index
	$index_array[] = array(
		"file_name" => "data/js/tweets/$date.js",
		"year" => date("Y", strtotime($data['date'])),
		"var_name" => "tweets_$date",
		"tweet_count" => count($data['tweets']),
		"month" =>  date("n", strtotime($data['date'])),
	);
}
// Write the index
$index_text .= json_encode($index_array, JSON_UNESCAPED_SLASHES);
file_put_contents($index_filename, $index_text);

// Write the user_details
$user_filename = "$path/user_details.js";
$user_text = "var user_details =  ";
$user_array = array(
	"screen_name" => $username,
	"full_name" => $user['name'],
	"bio" => $user['description'],
	"id" => $user['id'],
	"created_at" => $user['created_at'],
);
$user_text .= json_encode($user_array, JSON_UNESCAPED_SLASHES);
file_put_contents($user_filename, $user_text);

// Write the payload_details
$payload_filename = "$path/payload_details.js";
$payload_text = "var payload_details =  ";
$payload_array = array(
	"tweets" => 4891,
	"created_at" => "2015-03-04 00:04:27 +0000",
	"lang" => isset($user['lang']) ? $user['lang'] : '',
);

$payload_text .= json_encode($payload_array, JSON_UNESCAPED_SLASHES);
file_put_contents($payload_filename, $payload_text);

echo "Done!" . PHP_EOL;
