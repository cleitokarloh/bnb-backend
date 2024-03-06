<?php

namespace Domain\Transaction\Actions;

use App\Core\Exceptions\CustomError;
use Domain\Transaction\Data\BalanceData;
use Domain\Transaction\Data\DepositData;
use Domain\Transaction\Data\MovementData;
use Domain\Transaction\Data\UpdateStatusDepositData;
use Domain\Transaction\Enums\DepositStatusEnum;
use Domain\Transaction\Enums\MovementTypeEnum;
use Domain\Transaction\Models\Deposit;
use Domain\Transaction\Repositories\BalanceRepository;
use Domain\Transaction\Repositories\DepositRepository;
use Domain\Transaction\Repositories\MovementRepository;
use Illuminate\Support\Facades\Gate;

class UpdateDepositStatusAction
{
    public function __construct(
        private DepositRepository $depositRepository,
        private MovementRepository $movementRepository,
        private BalanceRepository $balanceRepository)
    {
    }

    public function __invoke(UpdateStatusDepositData $updateStatusDepositData): DepositData
    {
        Gate::authorize('update', Deposit::class);

        $deposit = $this->depositRepository->findById($updateStatusDepositData->id);

        if (! $deposit) {
            throw new CustomError('Deposit not found', 404);
        }

        if ($deposit->status == $updateStatusDepositData->status) {
            throw new CustomError('Deposit already in this status', 400);
        }

        $updatedDeposit = $this->depositRepository->updateStatus($updateStatusDepositData);

        if ($updatedDeposit->status == DepositStatusEnum::APPROVED) {
            $createMovementData = MovementData::from([
                'user_id' => $deposit->user_id,
                'description' => $deposit->description,
                'amount' => $deposit->amount,
                'date' => now()->format('Y-m-d'),
                'type' => MovementTypeEnum::DEPOSIT,
            ]);
            $this->movementRepository->create($createMovementData);

            $balance = $this->balanceRepository->getBalance($deposit->user_id);

            $updateBalanceData = BalanceData::from([
                'user_id' => $deposit->user_id,
                'amount' => $balance->amount + $deposit->amount,
            ]);

            $this->balanceRepository->update($updateBalanceData);
        }

        return $updatedDeposit;
    }
}
