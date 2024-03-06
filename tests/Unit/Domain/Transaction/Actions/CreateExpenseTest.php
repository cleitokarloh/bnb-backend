<?php

use App\Core\Exceptions\CustomError;
use Domain\Transaction\Actions\CreateExpenseAction;
use Illuminate\Auth\Access\AuthorizationException;
use Infrastructure\Persistence\Eloquent\EloquentBalanceRepository;
use Infrastructure\Persistence\Eloquent\EloquentMovementRepository;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

    $this->expenseData = [
        'description' => 'My Expense',
        'amount' => 100,
        'date' => now()->format('Y-m-d'),
    ];
});

it('should be able to create an expense', function () {

    Sanctum::actingAs(
        $this->user,
        ['*']
    );

    \Domain\Transaction\Models\Balance::where('user_id', $this->user->id)->first()->update([
        'amount' => 1000,
    ]);

    $data = \Domain\transaction\Data\ExpenseData::from($this->expenseData);

    $createExpenseAction = new CreateExpenseAction(new EloquentMovementRepository(), new EloquentBalanceRepository());

    $afterTest = $createExpenseAction($data);

    expect($afterTest->description)->toBe($data->description);

});

it('should not be able to create an expense without founds', function () {

    Sanctum::actingAs(
        $this->user,
        ['*']
    );

    $data = \Domain\transaction\Data\ExpenseData::from($this->expenseData);

    $createExpenseAction = new CreateExpenseAction(new EloquentMovementRepository(), new EloquentBalanceRepository());

    $createExpenseAction($data);

})->throws(CustomError::class);

it('should not be able to create an expense from admin', function () {

    Sanctum::actingAs(
        $this->admin,
        ['*']
    );

    $data = \Domain\transaction\Data\ExpenseData::from($this->expenseData);

    $createExpenseAction = new CreateExpenseAction(new EloquentMovementRepository(), new EloquentBalanceRepository());

    $createExpenseAction($data);

})->throws(AuthorizationException::class);
