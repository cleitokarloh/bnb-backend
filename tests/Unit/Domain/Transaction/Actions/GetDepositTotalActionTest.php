<?php

use Domain\Transaction\Actions\GetDepositTotalAction;
use Domain\Transaction\Enums\MovementTypeEnum;
use Illuminate\Auth\Access\AuthorizationException;
use Infrastructure\Persistence\Eloquent\EloquentMovementRepository;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

    \Domain\Transaction\Models\Movement::factory()->count(2)->create([
        'user_id' => $this->user->id,
        'amount' => 100,
        'type' => MovementTypeEnum::DEPOSIT->value,
    ]);

});

it('should be able to show deposit total', function () {

    Sanctum::actingAs(
        $this->user,
        ['*']
    );

    $getDepositTotalAction = new GetDepositTotalAction(new EloquentMovementRepository());

    $afterTest = $getDepositTotalAction();

    expect($afterTest->total)->toBe(floatval(200));

});

it('should not be able to show deposit total from admin', function () {

    Sanctum::actingAs(
        $this->admin,
        ['*']
    );

    $getDepositTotalAction = new GetDepositTotalAction(new EloquentMovementRepository());

    $getDepositTotalAction();

})->throws(AuthorizationException::class);
