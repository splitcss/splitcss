<?php 

namespace Splitcss\Splitcss\Services;

use \Exception;
use GuzzleHttp\Client;

class CssOptimizer {
	
	public static function splitCss($htmlUrl, $cssUrls)
	{
		    $client = new Client(['base_uri' => config('splitcss.api_base_uri')]);
		    try {
		    	$preparedCssUrls = collect($cssUrls)->map(function($cssUrl) {
					return url($cssUrl) ;
				});
		    	$queryStringData = [
					'html_url' =>  url($htmlUrl),
					'css_urls' => $preparedCssUrls->values()->toArray(),
					'token'	   => config('splitcss.token')
				];
				
		    	$response = $client->request('GET', '/clean-css', [
		    		'query' => $queryStringData,
		    		'timeout' => config('splitcss.api_timeout_seconds')
		    	]);
		    	$body = (string)$response->getBody();
		    	return [
		    		'processed' => true,
		    		'cleaned'	=>	$response->getHeader('X-Cleaned'),
		    		'css' => $body
		    	];
		    } catch( Exception $e ) {
		    	$css = '';
		    	foreach( $cssUrls as $cssUrl )
		    	{
		    		$response = $client->request('GET', $cssUrl);
		    		$css .= (string)$response->getBody();
		    	}
		    	return [
		    		'processed' => false,
		    		'cleaned' => false,
		    		'css' => $css
		    	];	
		    }
		
	}
}