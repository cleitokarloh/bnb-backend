<?php

use Domain\Transaction\Actions\GetExpenseTotalAction;
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
        'type' => MovementTypeEnum::EXPENSE->value,
    ]);

});

it('should be able to list balance changes', function () {

    Sanctum::actingAs(
        $this->user,
        ['*']
    );

    $getExpenseTotalAction = new GetExpenseTotalAction(new EloquentMovementRepository());

    $afterTest = $getExpenseTotalAction();

    expect($afterTest->total)->toBe(floatval(200));

});

it('should not be able to list balance changes from admin', function () {

    Sanctum::actingAs(
        $this->admin,
        ['*']
    );

    $getExpenseTotalAction = new GetExpenseTotalAction(new EloquentMovementRepository());

    $getExpenseTotalAction();

})->throws(AuthorizationException::class);
