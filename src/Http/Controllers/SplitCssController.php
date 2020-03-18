<?php

namespace Vladf86\Splitcss\Http\Controllers;

use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Http\Request;
use Vladf86\Splitcss\Services\CssOptimizer;

class SplitCssController extends Controller
{
	protected $cssOptimizer;
	
	public function __construct(CssOptimizer $cssOptimizer)
	{
		$this->cssOptimizer = $cssOptimizer;
	}
	
    public function splitCss(Request $request)
    {
    	$cssFallbackUrl = $request->get('css_fallback_url');
    	
    	if($cssFallbackUrl && !in_array( config('app.env'), ['production', 'live'] ) )
    	{
    		$response = file_get_contents($cssFallbackUrl);
    		return response($response)->header('Content-Type', 'text/css');
    	}

    	$htmlUrl = $request->get('html_url');
    	$cssUrls = $request->get('css_urls');
    	
    	$cacheKey = md5( $htmlUrl );
    	
		$response = Cache::get($cacheKey, function() use ($cacheKey, $htmlUrl,  $cssUrls) {
			$styles = $this->cssOptimizer->splitCss(
	    		$htmlUrl, 
	    		$cssUrls
	    	);

	    	if( $styles['processed'] == true && strlen( $styles['css'] ) )
	    	{
	    		Cache::put( $cacheKey, $styles['css'], now()->addSeconds( config('splitcss.cache_ttl_seconds') ) );
	    	}
	    	
	    	return $styles['css'];
		});
		
    	return response($response)->header('Content-Type', 'text/css');
    }
}
