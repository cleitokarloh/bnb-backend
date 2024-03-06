<?php

use Domain\Transaction\Actions\GetCurrentBalanceAction;
use Illuminate\Auth\Access\AuthorizationException;
use Infrastructure\Persistence\Eloquent\EloquentBalanceRepository;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

});

it('should be able to list balance changes', function () {

    Sanctum::actingAs(
        $this->user,
        ['*']
    );

    $getCurrentBalanceAction = new GetCurrentBalanceAction(new EloquentBalanceRepository());

    $afterTest = $getCurrentBalanceAction();

    expect($afterTest->amount)->toBe(floatval(0));

});

it('should not be able to list balance changes from admin', function () {

    Sanctum::actingAs(
        $this->admin,
        ['*']
    );

    $getCurrentBalanceAction = new GetCurrentBalanceAction(new EloquentBalanceRepository());

    $getCurrentBalanceAction();

})->throws(AuthorizationException::class);
