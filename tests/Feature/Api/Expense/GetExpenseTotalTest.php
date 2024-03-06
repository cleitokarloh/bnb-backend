<?php

use Domain\Transaction\Enums\MovementTypeEnum;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

    \Domain\Transaction\Models\Movement::factory()->count(2)->create([
        'user_id' => $this->user->id,
        'amount' => 100,
        'type' => MovementTypeEnum::EXPENSE->value,
    ]);
});

it('should be able to create an expense', function () {

    $response = $this->actingAs($this->user)
        ->get('/api/expenses/total')
        ->assertStatus(200)
        ->assertJsonStructure([
            'total',
        ]);

    expect($response['total'])->toBe(200);

});

it('should not be able to create an expense as a admin user', function () {

    $this->actingAs($this->admin)
        ->get('/api/expenses/total')
        ->assertStatus(403);
});
