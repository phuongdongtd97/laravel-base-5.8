<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
     * Repository services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Test\TestRepository::class, \App\Repositories\Test\TestRepositoryEloquent::class);
        //:end-bindings:
    }
}
