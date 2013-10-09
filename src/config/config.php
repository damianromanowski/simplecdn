<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Content Delivery Network Support
	|--------------------------------------------------------------------------
	|
	| Enable the CDN filter to rewrite all URL's to their corresponding CDN URL.
	|
	*/

	'enabled' => false,

	/*
	|--------------------------------------------------------------------------
	| CDN Hostnames
	|--------------------------------------------------------------------------
	|
	| Specify the hostnames that should be rewritten if we find a file match.
	| If more then one value is provided, we will use a random value each time.
	|
	*/

	'url' => array(

		'http://static.example.com/',
		// 'http://static2.example.com/'

	),

	/*
	|--------------------------------------------------------------------------
	| Rewrite Rules
	|--------------------------------------------------------------------------
	|
	| Rules for rewriting URLs. Seperate patterns with a pipe.
	| The url parameter can be an array of hostnames, if set we will use a random
	| value each time, or default back to the hostname specified above.
	|
	*/

	'rules' => array(
		array(
			/*'url'		=> array(
				'http://images.example.com/',
				'http://images2.example.com/'
			),*/
			'pattern'	=> 'png|tif|tiff|gif|jpeg|jpg|jif|jfif|jp2|jpx|j2k|j2c|ico',
			'enabled'	=> true
		),
		array(
			'pattern'	=> 'css',
			'enabled'	=> true
		),
		array(
			'pattern'	=> 'js',
			'enabled'	=> true
		),
		array(
			'pattern'	=> 'asf|avi|flv|m1v|m2v|m4v|mkv|mpeg|mpg|mpe|ogg|rm|wmv|mp4|webm',
			'enabled'	=> TRUE
		)
	),

);