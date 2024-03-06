<?php

use Domain\Transaction\Actions\getMovementsAction;
use Illuminate\Auth\Access\AuthorizationException;
use Infrastructure\Persistence\Eloquent\EloquentMovementRepository;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

    \Domain\Transaction\Models\Movement::factory()->count(2)->create([
        'user_id' => $this->user->id,
    ]);

});

it('should be able to list balance changes', function () {

    Sanctum::actingAs(
        $this->user,
        ['*']
    );

    $getMovementsAction = new getMovementsAction(new EloquentMovementRepository());

    $afterTest = $getMovementsAction();

    expect($afterTest)->toHaveCount(2);

});

it('should not be able to list balance changes from admin', function () {

    Sanctum::actingAs(
        $this->admin,
        ['*']
    );

    $getMovementsAction = new getMovementsAction(new EloquentMovementRepository());

    $getMovementsAction();

})->throws(AuthorizationException::class);
