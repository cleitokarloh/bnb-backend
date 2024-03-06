<?php

namespace Domain\Transaction\Actions;

use Domain\Transaction\Data\MovementTotalData;
use Domain\Transaction\Models\Balance;
use Domain\Transaction\Repositories\MovementRepository;
use Illuminate\Support\Facades\Gate;

class GetExpenseTotalAction
{
    public function __construct(private MovementRepository $movementRepository)
    {
    }

    public function __invoke(): MovementTotalData
    {
        Gate::authorize('index', Balance::class);

        $total = $this->movementRepository->getExpensesTotal(auth()->user()->id);

        return $total;
    }
}
