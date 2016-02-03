<?php

namespace Rubobaquero;

class Curl {
	
	public static function request($url, $options = NULL)
	{
		// Mix options with default options
		$options = self::options($options);
		
		// Start Request
		$connection = curl_init($url);
		
		// Set Options
		curl_setopt_array($connection,$options);
		
		// Execute request
		$result = curl_exec($connection);

		// Return body
		return $result;
	}
	
	public static function request_with_http_code($url, $options = NULL)
	{
		// Mix options with default options
		$options = self::options($options);
		
		// Start Request
		$connection = curl_init($url);
		
		// Set Options
		curl_setopt_array($connection,$options);
		
		// Execute request and get info
		$result = curl_exec($connection);
		$info = curl_getinfo($connection);
		
		// Return body and http code
		return array(
			'body' => $result,
			'http_code' => $info['http_code']
		);
	}
	
	public static function variables($variables)
	{
		return http_build_query($variables);
	}
	
	public static function options($options = NULL)
	{
		$default = array(
				CURLOPT_RETURNTRANSFER => true,     // return web page
				CURLOPT_HEADER         => false,    // don't return headers
				CURLOPT_FOLLOWLOCATION => true,    	// follow redirects
				CURLOPT_ENCODING       => "",       // handle all encodings
				CURLOPT_AUTOREFERER    => true,     // set referer on redirect
				CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
				CURLOPT_TIMEOUT        => 120,      // timeout on response
				CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
				CURLINFO_HEADER_OUT    => true
		);
	
		if($options && is_array($options)){
			foreach($options as $key=>$value){
				$default[$key] = $value;
			}
		}
	
		return $default;
	}

}