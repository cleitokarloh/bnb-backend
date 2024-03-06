<?php

use Domain\User\Actions\LoginAction;
use Domain\User\Models\User;

beforeEach(function () {
    User::factory()->create([
        'name' => 'John Doe',
        'username' => 'john',
        'password' => bcrypt('password'),
    ]);
});

it('should login a user', function () {

    $data = [
        'username' => 'john',
        'password' => 'password',
        'device' => 'test',
    ];

    $userData = \Domain\User\Data\LoginData::from($data);

    $loginAction = new LoginAction(new \Infrastructure\Persistence\Eloquent\EloquentUserRepository());

    $authenticated = $loginAction($userData);

    expect($authenticated->userData->name)->toBe('John Doe');

});
