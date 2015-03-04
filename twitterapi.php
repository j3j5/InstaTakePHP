<?php

class TwitterApi extends tmhOAuth {

	private $api_version = '1.1';

	// Set log-levels for the possible http response codes
	protected $http_response_code_levels = array(
		200 => LOG_INFO,
		304 => LOG_INFO,
		400 => LOG_WARNING,
		401 => LOG_NOTICE,
		403 => LOG_NOTICE,
		404 => LOG_NOTICE,
		406 => LOG_WARNING,
		420 => LOG_NOTICE,
		429 => LOG_NOTICE,
		500 => LOG_WARNING,
		502 => LOG_WARNING,
		503 => LOG_NOTICE,
		504 => LOG_NOTICE,
	);

	private $successful = array(
		200,
		304,
	);

	private $not_existant_user = array(
		404, // Removed
		403, // Suspended
	);

	/**
	 * Just in this case we know the credentials were the problem on the request
	 */
	private $unauthorized = array(
		400, // Bad Request, but from the docs "In API v1.1, requests without authentication are considered invalid and will yield this response"
	);

	private $rate_limit = array(
		429,
	);


	/**
	 * Create an instance of the TwitterApi class
	 *
	 * @param Array $settings The application settings to start the OAuth library
	 * @return void
	 */
	function __construct($settings) {
		parent::__construct($settings);
	}

	/**
	 * Do a request to the Twitter API
	 *
	 * @param string $url The slug to retrieve from Twitter's API
	 * @param string $parameters Optional parameters to set for the request
	 *
	 * @return Bool|Array A response array, or FALSE
	 */
	public function get($url, $parameters = array()) {
		$code = $this->request('GET', $this->url($this->api_version . '/' . $url), $parameters);
		switch($code) {
			// Successful
			case 200:
			case 304:
				if(!isset($this->response['response']) OR !is_string($this->response['response'])) {
					echo "Something really weird happened!" . PHP_EOL;
					var_dump($this->response);
					exit;
				}
				return json_decode($this->response['response'], TRUE);
			// Rate limit
			case 429:
				return array(
					'code' => $code,
					'errors' => $this->response['response'],
					'tts' => isset($this->response['headers']['x-rate-limit-reset']) ? // Time To Sleep
							$this->response['headers']['x-rate-limit-reset'] :
							FALSE
				);
			// Credentials are NOT VALID
			case 400: // Bad Request, but from the docs "In API v1.1, requests without authentication are considered invalid and will yield this response"
			// Non existent user
			case 404: // Removed
			case 403: // Suspended:
			default:
				var_dump(__FILE__ . ":" . __LINE__);
				var_dump('wrooong!');
				var_dump($code);
				var_dump($this->response);
				exit;
				break;
		}
	}

	/**
	 * Make a POST request to the Twitter API
	 *
	 * @param string $url The url to request from the Twitter API
	 * @param string $parameters Optional parameters to set for the request
	 * @return mixed A response array, or null
	 */
	public function post($url, $parameters = array()) {
		return $this->request('POST', $this->url($this->api_version . '/' . $url), $parameters);

	}

	/**
	 * Make a DELETE request to the Twitter API
	 *
	 * @param string $url The url to request from the Twitter API
	 * @param string $parameters Optional parameters to set for the request
	 * @return mixed A response array, or null
	 */
	public function delete($url, $parameters = array()) {
		return $this->request('DELETE', $this->url($this->api_version . '/' . $url), $parameters);
	}

	/**
	 * Iterate through an endpoint that takes a cursor
	 */
// 	public function cursorize($endpoint, $arguments = array())
// 	{
// 		return new FastTwitterAPI_Iterator_Cursor($this, $endpoint, $arguments);
// 	}

	public function cursorize_timeline($endpoint, $arguments = array()) {
		return new FastTwitterAPI_Iterator_TimelineCursor($this, $endpoint, $arguments);
	}

}

/**
 * Iterator class to quickly iterate through an API
 */
abstract class FastTwitterAPI implements Iterator
{
	protected $api;
	protected $endpoint;
	protected $arguments;

	public function __construct($api, $endpoint, $arguments) {
		$this->api = $api;
		$this->endpoint = $endpoint;
		$this->arguments = $arguments;
	}
}

class FastTwitterAPI_Iterator_TimelineCursor extends FastTwitterAPI {
	private $since_id = -1;
	private $latest_tweet_id;
	private $max_id = -1;
	private $first_tweet_id;
	private $use_since_id = FALSE;

	function __construct($api, $endpoint, $arguments) {
		$this->use_since_id = TRUE;
		if(isset($arguments['use_since_id'])) {
			$this->use_since_id = (bool)$arguments['use_since_id'];
		}
		parent::__construct($api, $endpoint, $arguments);

	}

	function rewind() {
		$this->since_id = $this->max_id = -1;
	}

	function current() {
		$arguments = $this->arguments;
		if($this->max_id > 0) {
			$arguments['max_id'] = $this->max_id;
		}

		if($this->since_id > 0 && $this->use_since_id) {
			$arguments['since_id'] = $this->since_id;
		}

		$i = 0;
		do {
			$resp = $this->api->get($this->endpoint, $arguments);
		} while (is_array($resp)  && ++$i <= 3); // Retry 3 times if the response isn't present

		if(is_array($resp)) {
			$first_tweet = end($resp);
			$latest_tweet = reset($resp);
		} else {
			$this->since_id = $this->max_id = 0;
		}

		if (!empty($first_tweet)) {
			$this->max_id = $first_tweet['id'] -1;
		} else {
			$this->max_id = 0;
		}

		if(!empty($latest_tweet)) {
			$this->since_id = $latest_tweet['id'];
		}

		if($this->since_id == $this->max_id) {
			// This means, on the last request, the oldest and the latest were the same tweet, so stop here
			$this->max_id = 0;
		}
		if(is_array($resp)) {
			return $resp;
		} else {
			return FALSE;
		}
	}

	function key() {
		return $this->max_id;
	}

	function next() {
		// For the next, max_id should already be set
		return;
	}

	function valid() {
		return ($this->max_id !== 0);
	}
}
