<?php

namespace Infrastructure\Persistence\Eloquent;

use Domain\Transaction\Data\DepositData;
use Domain\Transaction\Data\PendingDepositData;
use Domain\Transaction\Data\UpdateStatusDepositData;
use Domain\Transaction\Enums\DepositStatusEnum;
use Domain\Transaction\Models\Deposit;
use Domain\Transaction\Repositories\DepositRepository;
use Illuminate\Support\Collection;

final class EloquentDepositRepository implements DepositRepository
{
    public function create(DepositData $data): DepositData
    {
        $deposit = Deposit::create([
            ...$data->toArray(),
            'image' => json_encode($data->image),
        ]);

        return DepositData::from($deposit);
    }

    public function updateStatus(UpdateStatusDepositData $data): DepositData
    {

        $deposit = Deposit::find($data->id);
        $deposit->status = $data->status->value;
        $deposit->save();

        return DepositData::from($deposit);

    }

    public function findById(int $id): ?DepositData
    {
        $deposit = Deposit::find($id);

        return $deposit ? DepositData::from($deposit) : null;
    }

    public function findByUserId(int $userId): Collection
    {
        $deposits = Deposit::where('user_id', $userId)->orderBy('created_at', 'DESC')->get();

        return $deposits->map(fn (Deposit $deposit) => DepositData::from($deposit));
    }

    public function getPending(): Collection
    {
        $deposits = Deposit::where('status', DepositStatusEnum::PENDING->value)->orderBy('created_at', 'DESC')->with('user')->get();

        return $deposits->map(fn (Deposit $deposit) => PendingDepositData::from($deposit));
    }
}
