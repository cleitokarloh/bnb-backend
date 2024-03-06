<?php

namespace Domain\Transaction\Repositories;

use Domain\Transaction\Data\DepositData;
use Domain\Transaction\Data\UpdateStatusDepositData;
use Illuminate\Support\Collection;

interface DepositRepository
{
    public function create(DepositData $deposit): DepositData;

    public function updateStatus(UpdateStatusDepositData $deposit): DepositData;

    public function findById(int $id): ?DepositData;

    public function findByUserId(int $userId): Collection;

    public function getPending(): Collection;
}
