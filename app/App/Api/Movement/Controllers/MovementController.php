<?php

namespace App\Api\Movement\Controllers;

use App\Core\Http\Controllers\Controller;
use Domain\Transaction\Actions\GetCurrentBalanceAction;
use Domain\Transaction\Actions\GetMovementsAction;
use Illuminate\Http\JsonResponse;

class MovementController extends Controller
{
    public function get(GetMovementsAction $getMovementsAction): JsonResponse
    {
        $movements = $getMovementsAction();

        return response()->json($movements, 200);
    }

    public function getCurrentBalance(GetCurrentBalanceAction $getCurrentBalanceAction): JsonResponse
    {
        $balance = $getCurrentBalanceAction();

        return response()->json($balance, 200);
    }
}
