<?php

namespace App\Api\Deposit\Controllers;

use App\Core\Http\Controllers\Controller;
use Domain\Transaction\Actions\CreateDepositAction;
use Domain\Transaction\Actions\GetDepositsOfCustomerAction;
use Domain\Transaction\Actions\GetDepositTotalAction;
use Domain\Transaction\Actions\GetPendingDepositsAction;
use Domain\Transaction\Actions\UpdateDepositStatusAction;
use Domain\Transaction\Data\DepositData;
use Domain\Transaction\Data\UpdateStatusDepositData;
use Illuminate\Http\JsonResponse;

class DepositController extends Controller
{
    public function getPending(GetPendingDepositsAction $action): JsonResponse
    {
        $deposits = $action();

        return response()->json($deposits, 200);
    }

    public function getByCustomer(GetDepositsOfCustomerAction $action): JsonResponse
    {

        $deposits = $action();

        return response()->json($deposits, 200);
    }

    public function store(DepositData $depositData, CreateDepositAction $createDepositAction): JsonResponse
    {
        $deposit = $createDepositAction($depositData);

        return response()->json($deposit, 201);
    }

    public function updateStatus(UpdateStatusDepositData $depositData, UpdateDepositStatusAction $updateDepositStatusAction, $id): JsonResponse
    {
        $depositData->id = $id;

        $deposit = $updateDepositStatusAction($depositData);

        return response()->json($deposit, 200);
    }

    public function getTotal(GetDepositTotalAction $GetDepositTotalAction): JsonResponse
    {
        $total = $GetDepositTotalAction();

        return response()->json($total, 200);
    }
}
