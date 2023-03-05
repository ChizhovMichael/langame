<?php

namespace App\Providers;

use App\Services\PostIntegration\PostIntegrationInterface;
use App\Services\PostIntegration\PostIntegrationService;
use App\Services\PostService;
use App\Services\PostServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PostIntegrationInterface::class, function ($app) {
            return new PostIntegrationService(
                strval(config('services.news-api.url')),
                strval(config('services.news-api.token')),
            );
        });
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
