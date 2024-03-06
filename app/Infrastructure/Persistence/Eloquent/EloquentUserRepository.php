<?php

namespace Infrastructure\Persistence\Eloquent;

use Domain\User\Data\UserData;
use Domain\User\Models\User;
use Domain\User\Repositories\UserRepository;

final class EloquentUserRepository implements UserRepository
{
    public function create(UserData $data): UserData
    {
        $user = User::create($data->toArray());

        return UserData::from($user)->except('password');
    }

    public function getUserByUserName(string $username): ?User
    {
        $user = User::where('username', $username)->first();

        return $user ? $user : null;
    }
}
