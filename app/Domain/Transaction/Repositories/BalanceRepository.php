<?php

namespace Domain\Transaction\Repositories;

use Domain\Transaction\Data\BalanceData;

interface BalanceRepository
{
    public function create(BalanceData $balance): BalanceData;

    public function getBalance(int $userId): BalanceData;

    public function update(BalanceData $balance): BalanceData;
}
