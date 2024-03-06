<?php

use Domain\User\Actions\CreateUserAction;
use Domain\User\Events\UserCreated;
use Illuminate\Support\Facades\Event;

it('should create a user', function () {

    Event::fake([
        UserCreated::class,
    ]);

    $data = [
        'name' => 'John Doe',
        'username' => 'john',
        'password' => 'password',
    ];

    $userData = \Domain\User\Data\UserData::from($data);

    $user = new CreateUserAction(new \Infrastructure\Persistence\Eloquent\EloquentUserRepository());

    $createdUser = $user($userData);

    expect($createdUser->name)->toBe($userData->name);

    Event::assertDispatched(UserCreated::class);
});
