<?php

use Domain\Transaction\Actions\GetDepositsOfCustomerAction;
use Infrastructure\Persistence\Eloquent\EloquentDepositRepository;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

    \Domain\Transaction\Models\Deposit::factory()->count(2)->create([
        'user_id' => $this->user->id,
    ]);

});

it('should be able to list deposits of user', function () {

    Sanctum::actingAs(
        $this->user,
        ['*']
    );

    $action = new GetDepositsOfCustomerAction(new EloquentDepositRepository());

    $afterTest = $action();

    expect($afterTest)->toHaveCount(2);

});
