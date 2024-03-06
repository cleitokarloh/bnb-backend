<?php

namespace Domain\Transaction\Listeners;

use Domain\Transaction\Repositories\BalanceRepository;
use Domain\User\Events\UserCreated;

class StartBalanceWithZeroAmount
{
    public function __construct(private BalanceRepository $balanceRepository)
    {

    }

    public function handle(UserCreated $event): void
    {

        $balance = \Domain\Transaction\Data\BalanceData::from([
            'user_id' => $event->userData->id,
            'amount' => 0,
        ]);

        $this->balanceRepository->create($balance);
    }
}
