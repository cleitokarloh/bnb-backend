<?php

use Domain\Transaction\Data\BalanceData;

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

    \Domain\Transaction\Models\Balance::where('user_id', $this->user->id)->first()->update([
        'amount' => 1000,
    ]);

    $response = $this->actingAs($this->user)->postJson('/api/expenses', $this->expenseData);

    $response->assertStatus(201);
    $response->assertJsonStructure(['id', 'amount', 'user_id', 'created_at', 'updated_at']);

    expect($response['amount'])->toBe(100);
    $balanceAfter = \Domain\Transaction\Models\Balance::where('user_id', $this->user->id)->first();

    $balanceDataAfter = BalanceData::from($balanceAfter);

    expect($balanceDataAfter->amount)->toBe(floatval(900));

});

it('should not be able to create an expense as a admin user', function () {

    $this->actingAs($this->admin)
        ->postJson('/api/expenses', $this->expenseData)
        ->assertStatus(403);
});
