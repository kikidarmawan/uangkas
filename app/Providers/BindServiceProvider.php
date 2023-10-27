<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
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
        $this->app->bind(
            'App\Repositories\Transaksi\TransaksiInterface',
            'App\Repositories\Transaksi\TransaksiRepository'
        );

        $this->app->bind(
            'App\Repositories\Dompet\DompetInterface',
            'App\Repositories\Dompet\DompetRepository'
        );

        $this->app->bind(
            'App\Repositories\DompetRiwayat\DompetRiwayatInterface',
            'App\Repositories\DompetRiwayat\DompetRiwayatRepository'
        );

        $this->app->bind(
            'App\Repositories\User\UserInterface',
            'App\Repositories\User\UserRepository'
        );
    }
}
