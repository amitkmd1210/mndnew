<?php

namespace Artfreek\Mnd;

use Illuminate\Support\ServiceProvider;

class MndServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('mnd', function () {
            return new Mnd();
        });
    }

    public function boot()
    {
        //
    }
}