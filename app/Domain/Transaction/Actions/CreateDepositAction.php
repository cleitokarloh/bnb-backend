<?php

namespace Domain\Transaction\Actions;

use Domain\Transaction\Data\DepositData;
use Domain\Transaction\Models\Deposit;
use Domain\Transaction\Repositories\DepositRepository;
use Illuminate\Support\Facades\Gate;

class CreateDepositAction
{
    public function __construct(private DepositRepository $depositRepository)
    {
    }

    public function __invoke(DepositData $depositData): DepositData
    {
        Gate::authorize('create', Deposit::class);

        $depositData = [
            ...$depositData->toArray(),
            'user_id' => auth()->user()->id,
        ];

        return $this->depositRepository->create(DepositData::from($depositData));
    }
}
