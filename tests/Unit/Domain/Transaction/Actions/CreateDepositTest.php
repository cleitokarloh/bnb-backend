<?php

use Domain\Transaction\Actions\CreateDepositAction;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);
});

it('should be able to create a deposit', function () {

    Sanctum::actingAs(
        $this->user,
        ['*']
    );

    $data = [
        'description' => 'Deposit',
        'amount' => 100,
        'image' => UploadedFile::fake()->image('deposit.jpg'),
    ];

    $depositData = \Domain\transaction\Data\DepositData::from($data);

    $createDepositAction = new CreateDepositAction(new \Infrastructure\Persistence\Eloquent\EloquentDepositRepository());

    $afterTest = $createDepositAction($depositData);

    expect($afterTest->description)->toBe($depositData->description);

});

it('should not be able to create a deposit from admin', function () {

    Sanctum::actingAs(
        $this->admin,
        ['*']
    );

    $data = [
        'description' => 'Deposit',
        'amount' => 100,
        'image' => UploadedFile::fake()->image('deposit.jpg'),
    ];

    $depositData = \Domain\transaction\Data\DepositData::from($data);

    $createDepositAction = new CreateDepositAction(new \Infrastructure\Persistence\Eloquent\EloquentDepositRepository());

    $createDepositAction($depositData);

})->throws(AuthorizationException::class);
