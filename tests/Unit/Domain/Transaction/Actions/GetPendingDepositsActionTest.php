<?php

use Domain\Transaction\Actions\GetPendingDepositsAction;
use Domain\Transaction\Enums\DepositStatusEnum;
use Infrastructure\Persistence\Eloquent\EloquentDepositRepository;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

    \Domain\Transaction\Models\Deposit::factory()->count(2)->create([
        'user_id' => $this->user->id,
        'status' => DepositStatusEnum::PENDING->value,
    ]);

});

it('should be able to list pending deposits', function () {

    Sanctum::actingAs(
        $this->admin,
        ['*']
    );

    $action = new GetPendingDepositsAction(new EloquentDepositRepository());

    $afterTest = $action();

    expect($afterTest)->toHaveCount(2);

});
