<?php

namespace Splitcss\Splitcss\Providers;

use Illuminate\Support\ServiceProvider;

class SplitCssClientProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $path = realpath(__DIR__.'/../../config/splitcss.php');

        $this->publishes([$path => config_path('splitcss.php')], 'config');
        $this->mergeConfigFrom($path, 'splitcss');
        
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }
}
