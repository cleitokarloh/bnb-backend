<?php

namespace Domain\Transaction\Policies;

use Domain\User\Enums\RoleEnum;
use Domain\User\Models\User;
use Illuminate\Auth\Access\Response;

class DepositPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    public function create(User $user): Response
    {

        return ($user->role === RoleEnum::customer) ? Response::allow() : Response::deny('You are not allowed to create this deposit');
    }

    public function update(User $user): Response
    {
        return ($user->role === RoleEnum::admin) ? Response::allow() : Response::deny('You are not allowed to update this deposit');

    }

    public function pending(User $user): Response
    {
        return ($user->role === RoleEnum::admin) ? Response::allow() : Response::deny('You are not allowed to get pending deposits');
    }
}
