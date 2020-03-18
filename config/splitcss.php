<?php 
return [
	/*
    |--------------------------------------------------------------------------
    | SplitCSS Secret Token
    |--------------------------------------------------------------------------
    |
    | Don't forget to set this in your .env file, as it will be used to authenticate
    | your requests.
    |
    */
	'token'	=>	env('SPLITCSS_TOKEN'),
	
	/*
    |--------------------------------------------------------------------------
    | SplitCSS API Base URI
    |--------------------------------------------------------------------------
    |
	| Normally you would not need to change the default
    |
    */
	'api_base_uri'	=>	env('SPLITCSS_API_URI', 'https://api.splitcss.com'),
	
	/*
    |--------------------------------------------------------------------------
    | SplitCSS API Timeout in Seconds
    |--------------------------------------------------------------------------
    |
    | How long should your app wait for a response from the SplitCSS API.
    | Usually websites respond within few seconds, but the network is unpredictable.
    |
    */
	'api_timeout_seconds'	=>	env('SPITCSS_API_TIMEOUT_SECONDS', 60),
	
	/*
    |--------------------------------------------------------------------------
    | SplitCSS Cache TTL
    |--------------------------------------------------------------------------
    |
    | How many seconds should the API response be cached by your app.
    |
    */
	'cache_ttl_seconds'	=>	env('SPLITCSS_API_CACHE_TTL_SECONDS', 300)
];