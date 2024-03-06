<?php

use Domain\Transaction\Actions\UpdateDepositStatusAction;
use Domain\Transaction\Enums\DepositStatusEnum;
use Illuminate\Auth\Access\AuthorizationException;
use Infrastructure\Persistence\Eloquent\EloquentBalanceRepository;
use Infrastructure\Persistence\Eloquent\EloquentDepositRepository;
use Infrastructure\Persistence\Eloquent\EloquentMovementRepository;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

    $this->deposit = \Domain\Transaction\Models\Deposit::factory([
        'user_id' => $this->user->id,
        'amount' => floatval(100),
    ])->create();
});

it('should be able to update a deposit', function () {

    Sanctum::actingAs(
        $this->admin,
        ['*']
    );

    $data = [
        'id' => $this->deposit->id,
        'status' => DepositStatusEnum::APPROVED,
    ];

    $depositData = \Domain\transaction\Data\UpdateStatusDepositData::from($data);

    $balance = \Domain\Transaction\Models\Balance::where('user_id', $this->deposit->user_id)->first();

    $updateDepositAction = new UpdateDepositStatusAction(
        new EloquentDepositRepository(),
        new EloquentMovementRepository(),
        new EloquentBalanceRepository()
    );

    $updatedDeposit = $updateDepositAction($depositData);

    expect($updatedDeposit->status)->toBe($depositData->status);

    $balance = \Domain\Transaction\Models\Balance::where('user_id', $this->deposit->user_id)->first();

    $balanceData = \Domain\transaction\Data\BalanceData::from($balance);

    expect($balanceData->amount)->toBe($this->deposit->amount);

});

it('should not be able to update a deposit from user', function () {

    Sanctum::actingAs(
        $this->user,
        ['*']
    );

    $data = [
        'id' => $this->deposit->id,
        'status' => DepositStatusEnum::APPROVED,
    ];

    $depositData = \Domain\transaction\Data\UpdateStatusDepositData::from($data);

    $updateDepositAction = new UpdateDepositStatusAction(
        new EloquentDepositRepository(),
        new EloquentMovementRepository(),
        new EloquentBalanceRepository()
    );

    $updateDepositAction($depositData);

})->throws(AuthorizationException::class);
