<?php

namespace Domain\Transaction\Actions;

use Domain\Transaction\Repositories\DepositRepository;
use Illuminate\Support\Collection;

class GetDepositsOfCustomerAction
{
    public function __construct(private DepositRepository $depositRepository)
    {
    }

    public function __invoke(): Collection
    {
        $deposits = $this->depositRepository->findByUserId(auth()->user()->id);

        return $deposits;
    }
}
