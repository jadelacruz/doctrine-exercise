<?php

namespace App\Providers;

use App\Services\AuthorService;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();
        $this->handleLocalDependencies();
        
        $this->app->singleton(AuthorService::class, fn () => new AuthorService($this->app->get(EntityManager::class)));
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

    private function handleLocalDependencies()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
