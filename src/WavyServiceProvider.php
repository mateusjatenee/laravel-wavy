<?php

namespace Mateusjatenee\Wavy;

use Illuminate\Support\ServiceProvider;
use Mateusjatenee\Wavy\WavyChannel;

class WavyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(WavyChannel::class)
            ->needs(Wavy::class)
            ->give(function () {
                return new Wavy(config('services.wavy'));
            });
    }
}
