<?php

namespace App\Providers;

use App\Interfaces\FractionReadServiceInterface;
use App\Interfaces\FractionWriteServiceInterface;
use App\Interfaces\MeterReadingReadServiceInterface;
use App\Interfaces\MeterReadingWriteServiceInterface;
use App\Repositories\FractionReadRepository;
use App\Repositories\FractionWriteRepository;
use App\Repositories\MeterReadingReadRepository;
use App\Repositories\MeterReadingWriteRepository;
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
        $this->app->bind(FractionReadServiceInterface::class, FractionReadRepository::class);
        $this->app->bind(FractionWriteServiceInterface::class, FractionWriteRepository::class);
        $this->app->bind(MeterReadingReadServiceInterface::class, MeterReadingReadRepository::class);
        $this->app->bind(MeterReadingWriteServiceInterface::class, MeterReadingWriteRepository::class);
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
}
