<?php

namespace Domain\Transaction\Actions;

use Domain\Transaction\Models\Deposit;
use Domain\Transaction\Repositories\DepositRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class GetPendingDepositsAction
{
    public function __construct(private DepositRepository $depositRepository)
    {
    }

    public function __invoke(): Collection
    {
        Gate::authorize('pending', Deposit::class);

        $deposits = $this->depositRepository->getPending();

        return $deposits;
    }
}
