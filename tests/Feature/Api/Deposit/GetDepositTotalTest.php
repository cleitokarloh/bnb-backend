<?php

use Domain\Transaction\Enums\MovementTypeEnum;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

    \Domain\Transaction\Models\Movement::factory()->count(2)->create([
        'user_id' => $this->user->id,
        'amount' => 100,
        'type' => MovementTypeEnum::DEPOSIT->value,
    ]);
});

it('should be able to get deposits total', function () {

    $response = $this->actingAs($this->user)
        ->get('/api/deposits/total')
        ->assertStatus(200)
        ->assertJsonStructure([
            'total',
        ]);

    expect($response['total'])->toBe(200);

});

it('should not be able to get deposits total as a admin user', function () {

    $this->actingAs($this->admin)
        ->get('/api/deposits/total')
        ->assertStatus(403);
});
