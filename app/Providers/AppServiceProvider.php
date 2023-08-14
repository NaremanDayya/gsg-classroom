<?php

namespace App\Providers;

use App\Models\Classwork;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // $this->app->bind('x',function(){
        //     return new \App\Services\x();
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Paginator::defaultView();
        Relation::enforceMorphMap([
            'classwork' => Classwork::class,
            'post' => Post::class,
        ]);
    }
}
