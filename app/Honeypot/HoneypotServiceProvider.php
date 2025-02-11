<?php

namespace App\Honeypot;

use App\Honeypot\View\Components\Honeypot;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HoneypotServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/honeypot.php', 'honeypot');
    }

    public function boot()
    {
        Blade::component('honeypot', Honeypot::class);
    }
}
