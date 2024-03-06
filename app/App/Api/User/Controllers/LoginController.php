<?php

namespace App\Api\User\Controllers;

use App\Core\Http\Controllers\Controller;
use Domain\User\Actions\LoginAction;
use Domain\User\Data\LoginData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function login(LoginData $data, LoginAction $loginAction): JsonResponse
    {
        $authenticatedUser = $loginAction($data);

        return response()->json($authenticatedUser, 200);
    }

    public function csrfToken(): Response
    {
        return response()->noContent();
    }
}
