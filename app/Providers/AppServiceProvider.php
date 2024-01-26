<?php

namespace App\Providers;

use App\Services\Interfaces\ChatServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\OpenAi\ChatService;
use App\Services\OpenAi\ImageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ImageServiceInterface::class,
            ImageService::class
        );

        $this->app->bind(
            ChatServiceInterface::class,
            ChatService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
