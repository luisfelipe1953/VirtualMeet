<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use App\Repositories\SpeakerRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\SpeakerRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SpeakerRepositoryInterface::class, SpeakerRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
