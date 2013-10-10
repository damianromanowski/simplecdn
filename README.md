## Simple CDN for Laravel 4

[![Latest Stable Version](https://poser.pugx.org/damianromanowski/simplecdn/v/stable.png)](https://packagist.org/packages/damianromanowski/simplecdn) [![Total Downloads](https://poser.pugx.org/damianromanowski/simplecdn/downloads.png)](https://packagist.org/packages/damianromanowski/simplecdn) [![Build Status](https://travis-ci.org/damianromanowski/simplecdn.png?branch=master)](https://travis-ci.org/damianromanowski/simplecdn)

Simple CDN provides a simple way of re-writing your URL's for specific assets using custom defined rules.
Offload your assets to a content delivery network by using an origin-pull and re-writing your URL's to point to your off-site host.

> Note that URL's will only be rewritten in your production environment!

### Installation

- [Simple CDN on Packagist](https://packagist.org/packages/damianromanowski/simplecdn)
- [Simple CDN on GitHub](https://github.com/damianromanowski/simplecdn)

To get the latest version of Simple CDN simply require it in your `composer.json` file.

~~~
"damianromanowski/simplecdn": "dev-master"
~~~

You'll then need to run `composer install` to download it and have the autoloader updated.

> Note that once Simple CDN has a stable version tagged you should use a tagged release instead of the master branch.

Once Simple CDN is installed you need to register the service provider with the application. Open up `app/config/app.php` and find the `providers` key.

~~~
'providers' => array(
    
    'Damianromanowski\Simplecdn\SimplecdnServiceProvider'

)
~~~

### Configuration

Simple CDN provides easy configuration options for various situations. You could for example only rewrite URL's for images and video files, and even cycle between multiple hosts.
Simple CDN comes with a configuration file that you can edit at your leisure.

You'll need to run `php artisan config:publish damianromanowski/simplecdn` to publish the configuration to your application.

#### Step 1: Enable the rewriter
This is a global setting, if this is disabled, no rules will be processed.
~~~
'enabled' => true,
~~~

#### Step 2: Set your URL
If you want to cycle between multiple hosts, just add them to the array.
~~~
'url' => array(

	'http://cdn1.example.com/',
	'http://cdn2.example.com

),
~~~

#### Step 3: Define your rules
Define each group of patterns that you want, you can have one for images, css, js and video files that you can quickly enable or disable at any time.
The url parameter works just like the global url option, specify multiple to cycle between hosts.
~~~
'rules' => array(

	array(
	    'url'       => array('http://images.example.com/'),
		'pattern'	=> 'png|tif|tiff|gif|jpeg|jpg|jif|jfif|jp2|jpx|j2k|j2c|ico',
		'enabled'	=> true
	),

	array(
		'pattern'	=> 'css',
		'enabled'	=> false
	),

	array(
		'pattern'	=> 'js',
		'enabled'	=> false
	),
	
	array(
	    'url'       => array('http://video1.example.com/', 'http://video2.example.com/'),
		'pattern'	=> 'asf|avi|flv|m1v|m2v|m4v|mkv|mpeg|mpg|mpe|ogg|rm|wmv|mp4|webm',
		'enabled'	=> true
	)
	
),
~~~

And you're all done!
