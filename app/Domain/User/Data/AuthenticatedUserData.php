<?php

namespace Domain\User\Data;

use Spatie\LaravelData\Data;

class AuthenticatedUserData extends Data
{
    public function __construct(
        public UserData $userData,
        public string $token,

    ) {
    }
}
