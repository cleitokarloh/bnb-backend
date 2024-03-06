<?php

namespace Domain\Transaction\Repositories;

use Domain\Transaction\Data\MovementData;
use Domain\Transaction\Data\MovementTotalData;
use Illuminate\Support\Collection;

interface MovementRepository
{
    public function create(MovementData $movement): MovementData;

    public function get(int $userId): Collection;

    public function getExpensesTotal(int $userId): MovementTotalData;

    public function getDepositsTotal(int $userId): MovementTotalData;
}
