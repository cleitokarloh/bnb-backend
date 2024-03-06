<?php

namespace Domain\User\Actions;

use Domain\User\Data\AuthenticatedUserData;
use Domain\User\Data\LoginData;
use Domain\User\Data\UserData;
use Domain\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class LoginAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(LoginData $data): AuthenticatedUserData
    {

        $user = $this->userRepository->getUserByUserName($data->username);

        if (! $user || ! Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($data->device)->plainTextToken;

        return new AuthenticatedUserData(UserData::from($user), $token);

    }
}
