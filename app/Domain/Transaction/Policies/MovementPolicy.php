<?php

namespace Domain\Transaction\Policies;

use Domain\User\Enums\RoleEnum;
use Domain\User\Models\User;
use Illuminate\Auth\Access\Response;

class MovementPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    public function index(User $user): Response
    {
        return ($user->role === RoleEnum::customer) ? Response::allow() : Response::deny('You are not allowed to see the list if movements.');
    }
}
