<?php

namespace App\Providers;

use App\Console\Commands\PlotsCommand;
use App\Http\Controllers\PlotsController;
use App\Models\Plot;
use App\Repositories\Contracts\PlotsRepositoryInterface;
use App\Repositories\PlotsRepository;
use App\Services\Contracts\PlotsServiceInterface;
use App\Services\PlotsService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Lib\Rosstat\Client\Contracts\ClientInterface;
use Lib\Rosstat\Client\RosstatClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(PlotsServiceInterface::class,PlotsService::class);
        $this->app->singleton(PlotsRepositoryInterface::class,PlotsRepository::class);
        $this->app->singleton(Model::class, Plot::class);
        $this->app->singleton(ClientInterface::class, RosstatClient::class);

        $this->app->when(PlotsService::class)
            ->needs(ClientInterface::class)
            ->give(RosstatClient::class);

        $this->app->when(PlotsController::class)
            ->needs(PlotsServiceInterface::class)
            ->give(PlotsService::class)
        ;

        $this->app->when(PlotsRepository::class)
            ->needs(Model::class)
            ->give(Plot::class);

        $this->app->when(PlotsCommand::class)
            ->needs(Model::class)
            ->give(Plot::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
