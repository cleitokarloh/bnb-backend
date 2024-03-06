<?php

namespace App\Core\Providers;

// use Illuminate\Support\Facades\Gate;

use Domain\Transaction\Models\Balance;
use Domain\Transaction\Models\Deposit;
use Domain\Transaction\Models\Movement;
use Domain\Transaction\Policies\DepositPolicy;
use Domain\Transaction\Policies\ExpensePolicy;
use Domain\Transaction\Policies\MovementPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Deposit::class => DepositPolicy::class,
        Movement::class => ExpensePolicy::class,
        Balance::class => MovementPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
