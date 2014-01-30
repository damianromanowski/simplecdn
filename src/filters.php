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

            if (is_string($output) || method_exists($output, '__toString')) {
                $urls = preg_match_all("#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|[^[:punct:]\s]|/)#", $output, $matches);

                foreach ($matches[0] as $uri)
                    foreach (Config::get('simplecdn::rules') as $group)
                        if (@$group['enabled'] && preg_match('/\.(' . @$group['pattern'] . ')(?:[\?\#].*)?$/i', $uri, $matchess))
                        {
                            $config_url = Config::get('simplecdn::url');
                            $config_remove = Config::get('simplecdn::remove');
                            $asset_path = str_replace(str_finish(url(), '/'), '', $uri);

                            if (isset($group['url']))
                                $config_url = $group['url'];

                            if (isset($group['remove']))
                                $config_remove = $group['remove'];

                            if ($config_remove)
                                $asset_path = str_replace(str_finish($config_remove, '/'), '', $asset_path);

                            $cdn_url = is_array($config_url) ? $config_url[array_rand($config_url)] : $config_url;
                            $output = str_replace($uri, str_finish($cdn_url, '/') . $asset_path, $output);
                        }

                $response->setContent($output);
            }
	    }
	}
});
