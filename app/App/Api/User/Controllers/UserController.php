<?php

namespace App\Api\User\Controllers;

use App\Core\Http\Controllers\Controller;
use Domain\User\Actions\CreateUserAction;
use Domain\User\Data\UserData;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function store(UserData $userData, CreateUserAction $createUserAction): JsonResponse
    {
        $user = $createUserAction($userData);

        return response()->json($user, 201);
    }
}
