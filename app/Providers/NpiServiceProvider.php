<?php
/**
 * Service provider for setting up NPI Api client;
 *
 * @since 0.0.0
 */
namespace App\Providers;

use App\Http\Clients\NpiRegistry;
use Illuminate\Support\ServiceProvider;


class NpiServiceProvider extends ServiceProvider {
    /**
     * Registers services
     *
     * @return void
     */
    public function register(): void
    {

    }
    /**
     * Bootstraps application services
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->singleton(NpiRegistry::class, function($app){
            return new NpiRegistry(config('npi.npi_url'), config('npi.npi_version'));
        });
    }
}
