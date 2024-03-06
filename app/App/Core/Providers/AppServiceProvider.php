<?php

namespace App\Core\Providers;

use Domain\Transaction\Repositories\BalanceRepository;
use Domain\Transaction\Repositories\DepositRepository;
use Domain\Transaction\Repositories\MovementRepository;
use Domain\User\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Persistence\Eloquent\EloquentBalanceRepository;
use Infrastructure\Persistence\Eloquent\EloquentDepositRepository;
use Infrastructure\Persistence\Eloquent\EloquentMovementRepository;
use Infrastructure\Persistence\Eloquent\EloquentUserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $repositories = [
            UserRepository::class => EloquentUserRepository::class,
            BalanceRepository::class => EloquentBalanceRepository::class,
            DepositRepository::class => EloquentDepositRepository::class,
            MovementRepository::class => EloquentMovementRepository::class,
        ];

        foreach ($repositories as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
