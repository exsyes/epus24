<?php

namespace App\Providers;

use App\Services\BookServices;
use App\Services\Impl\BookServiceImpl;
use App\Services\Impl\BorrowerServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class BookServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [BookServices::class => BookServiceImpl::class];
    public function provides():array
    {
        return [BookServices::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
