<?php

namespace Domain\Transaction\Actions;

use Domain\Transaction\Data\BalanceData;
use Domain\Transaction\Models\Balance;
use Domain\Transaction\Repositories\BalanceRepository;
use Illuminate\Support\Facades\Gate;

class GetCurrentBalanceAction
{
    public function __construct(private BalanceRepository $balanceRepository)
    {
    }

    public function __invoke(): BalanceData
    {
        Gate::authorize('index', Balance::class);

        $balance = $this->balanceRepository->getBalance(auth()->user()->id);

        return $balance;
    }
}
