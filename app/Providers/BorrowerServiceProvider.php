<?php

namespace App\Providers;

use App\Services\BorrowerServices;
use App\Services\Impl\BorrowerServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class BorrowerServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
      BorrowerServices::class => BorrowerServiceImpl::class
    ];
    public function provides():array
    {
       return [BorrowerServices::class];
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
