<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;
use App\Services\HelloServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    // dependency injection menggunakan property singleton
    public array $singletons = [
        HelloService::class => HelloServiceImpl::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // echo 'FooBarServiceProvider';
        // dependency injection service container Foo::class
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        // dependency injection service container Bar::class
        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
        return [HelloService::class, Foo::class, Bar::class];
    }
}
