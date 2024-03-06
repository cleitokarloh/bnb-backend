<?php

namespace Infrastructure\Persistence\Eloquent;

use Domain\Transaction\Data\BalanceData;
use Domain\Transaction\Models\Balance;
use Domain\Transaction\Repositories\BalanceRepository;

final class EloquentBalanceRepository implements BalanceRepository
{
    public function create(BalanceData $balance): BalanceData
    {
        $balanceModel = new Balance();
        $balanceModel->user_id = $balance->user_id;
        $balanceModel->amount = $balance->amount;
        $balanceModel->save();

        return BalanceData::from($balanceModel);
    }

    public function getBalance(int $userId): BalanceData
    {
        $balanceModel = Balance::where('user_id', $userId)->first();

        return BalanceData::from($balanceModel);
    }

    public function update(BalanceData $balanceData): BalanceData
    {
        $balanceModel = Balance::where('user_id', $balanceData->user_id)->first();

        $balanceModel->amount = $balanceData->amount;
        $balanceModel->save();

        return BalanceData::from($balanceModel);
    }
}
