<?php

namespace App\Api\Expense\Controllers;

use App\Core\Http\Controllers\Controller;
use Domain\Transaction\Actions\CreateExpenseAction;
use Domain\Transaction\Actions\GetExpenseTotalAction;
use Domain\Transaction\Data\ExpenseData;
use Illuminate\Http\JsonResponse;

class ExpenseController extends Controller
{
    public function store(ExpenseData $expenseData, CreateExpenseAction $createExpenseAction): JsonResponse
    {

        $expense = $createExpenseAction($expenseData);

        return response()->json($expense, 201);
    }

    public function getTotal(GetExpenseTotalAction $getExpenseTotalAction): JsonResponse
    {
        $total = $getExpenseTotalAction();

        return response()->json($total);
    }
}
