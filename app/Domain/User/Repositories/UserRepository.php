<?php

namespace Domain\User\Repositories;

use Domain\User\Data\UserData;
use Domain\User\Models\User;

interface UserRepository
{
    public function create(UserData $data): UserData;

    public function getUserByUserName(string $username): ?User;
}
