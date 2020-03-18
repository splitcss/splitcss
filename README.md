# SplitCSS API Client for Laravel

The SplitCSS API Client is a configurable package for easy consumption of the SplitCSS API.  
It caches the split CSS per page in the your app, saving you unnecessary API calls.  

## Installation

To install the client, you will need to download this package:

`composer require splitcss/splitcss`

and add the provider in the `config/app.php` file:

`Splitcss\Splitcss\Providers\SplitCssClientProvider::class`


## Prerequisites

Before using the SplitCSS API, you will need to obtain an **API Key**.

You can get your free API Token by [registering](https://splitcss.com/register).

After registering, head over to your profile and click on **"Manage API Keys"**. Then choose a name for your key and click *Create new key*.

After that your API token will be displayed.

Copy it and add it to your `.env` file:

`SPLITCSS_TOKEN=YOUR_API_TOKEN`


## Usage

Once you have your token, you can add this line in your Blade templates: 

`<link href="{{ route('split.css') }}?html_url={{ urlencode(url()->current()) }}&css_urls[]={{ urlencode(mix('css/app.css')) }}" rel="stylesheet">`

This basically passes the current URL (without the query string) and the stylesheet (assuming you have one stylesheet file) to the SplitCSS client.

The package itself registers the named route `route('split.css')`.

To ease the development process, by default, the SplitCSS API will not be triggered in non-production environment.

If you want to see it in action anyway, you can control that with the `APP_ENV` variable in your `.env` file.

You can use the vendor:publish artisan command to override the configuration settings:

`php artisan vendor:publish`

This will create a `splitcss.php` file in your `app/config/` folder.


## Further Information

For further information, you can check out the [SplitCSS documentation](https://splitcss.com/documentation) and the [FAQ](https://splitcss.com/faq) section.

## License

The SplitCSS client package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).