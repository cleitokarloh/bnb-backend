<?php

namespace Infrastructure\Persistence\Eloquent;

use Domain\Transaction\Data\MovementData;
use Domain\Transaction\Data\MovementTotalData;
use Domain\Transaction\Enums\MovementTypeEnum;
use Domain\Transaction\Models\Movement;
use Domain\Transaction\Repositories\MovementRepository;
use Illuminate\Support\Collection;

final class EloquentMovementRepository implements MovementRepository
{
    public function create(MovementData $movement): MovementData
    {
        $movementModel = Movement::create($movement->toArray());

        return MovementData::from($movementModel);
    }

    public function get(int $userId): Collection
    {
        $movements = Movement::where('user_id', $userId)->orderBy('created_at', 'DESC')->get();

        return $movements;
    }

    public function getExpensesTotal(int $userId): MovementTotalData
    {
        $amount = Movement::where('user_id', $userId)
            ->where('type', MovementTypeEnum::EXPENSE->value)
            ->sum('amount');

        return MovementTotalData::from(['total' => $amount]);
    }

    public function getDepositsTotal(int $userId): MovementTotalData
    {
        $amount = Movement::where('user_id', $userId)
            ->where('type', MovementTypeEnum::DEPOSIT->value)
            ->sum('amount');

        return MovementTotalData::from(['total' => $amount]);
    }
}
