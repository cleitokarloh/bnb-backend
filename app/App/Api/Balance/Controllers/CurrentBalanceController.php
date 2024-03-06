<?php

namespace App\Api\Balance\Controllers;

use App\Core\Http\Controllers\Controller;
use Domain\Transaction\Actions\GetCurrentBalanceAction;
use Illuminate\Http\JsonResponse;

class CurrentBalanceController extends Controller
{
    public function index(GetCurrentBalanceAction $getCurrentBalanceAction): JsonResponse
    {
        $balance = $getCurrentBalanceAction();

        return response()->json($balance, 200);
    }
}
