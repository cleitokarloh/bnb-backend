<?php

namespace Domain\User\Actions;

use Domain\User\Data\UserData;
use Domain\User\Events\UserCreated;
use Domain\User\Repositories\UserRepository;

final class CreateUserAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(UserData $data): UserData
    {
        $user = $this->userRepository->create($data);

        event(new UserCreated($user));

        return $user;
    }
}
