<?php

namespace Domain\Transaction\Actions;

use App\Core\Exceptions\CustomError;
use Domain\Transaction\Data\BalanceData;
use Domain\Transaction\Data\ExpenseData;
use Domain\Transaction\Data\MovementData;
use Domain\Transaction\Models\Movement;
use Domain\Transaction\Repositories\BalanceRepository;
use Domain\Transaction\Repositories\MovementRepository;
use Illuminate\Support\Facades\Gate;

class CreateExpenseAction
{
    public function __construct(private MovementRepository $movementRepository, private BalanceRepository $balanceRepository)
    {
    }

    public function __invoke(ExpenseData $expenseData): MovementData
    {
        Gate::authorize('create', Movement::class);

        $balance = $this->balanceRepository->getBalance(auth()->user()->id);

        if ($balance->amount < $expenseData->amount) {
            throw new CustomError('Insufficient funds');
        }

        $expenseData = [
            ...$expenseData->toArray(),
            'user_id' => auth()->user()->id,
        ];

        $updateBalanceData = [
            'id' => $balance->id,
            'user_id' => auth()->user()->id,
            'amount' => $balance->amount - $expenseData['amount'],

        ];

        $expense = $this->movementRepository->create(MovementData::from($expenseData));

        $this->balanceRepository->update(BalanceData::from($updateBalanceData));

        return $expense;
    }
}
