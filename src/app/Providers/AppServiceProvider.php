<?php

namespace App\Providers;

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Services\Api\Contracts\MoviePublisherServiceInterface;
use App\Services\Api\Implementations\MoviePublisherService;
use App\Services\Similar\SimilarMoviesService;
use App\Services\Similar\SimilarMoviesServiceInterface;
use App\Services\Similar\SimilarService;
use App\Services\Similar\SimilarServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ArticleRepositoryInterface::class,
            ArticleRepository::class
        );

        $this->app->bind(
            SimilarServiceInterface::class,
            SimilarService::class
        );

        $this->app->bind(
            SimilarMoviesServiceInterface::class,
            SimilarMoviesService::class
        );

        $this->app->bind(
            MoviePublisherServiceInterface::class,
            MoviePublisherService::class
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
