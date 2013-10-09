<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::after(function($request, $response)
{
	if (App::Environment() != 'local' && Config::get('simplecdn::enabled'))
	{
	    if ($response instanceof Illuminate\Http\Response)
	    {
	    	$output = $response->getOriginalContent();

	    	$urls = preg_match_all("#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|[^[:punct:]\s]|/)#", $output, $matches);

	    	foreach ($matches[0] as $uri)
	    		foreach (Config::get('simplecdn::rules') as $group)
	    			if (@$group['enabled'] && preg_match('/\.(' . @$group['pattern'] . ')(?:[\?\#].*)?$/i', $uri, $matchess))
	    			{
	    				$cdn_url = Config::get('simplecdn::url')[array_rand(Config::get('simplecdn::url'))];
	    				
	    				if (isset($group['url']))
	    					$cdn_url = $group['url'][array_rand($group['url'])];
	    				
						$output = str_replace($uri, str_replace(url() . '/', $cdn_url, $uri), $output);
	    			}

	    	$response->setContent($output);
	    }
	}
});