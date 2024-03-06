<?php

use Domain\Transaction\Enums\DepositStatusEnum;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

    $this->deposit = \Domain\Transaction\Models\Deposit::factory(
        [
            'user_id' => $this->user->id,
            'amount' => floatval(100),
        ]
    )->create();
});

it('should be able to update a deposit', function () {

    $data = [
        'status' => DepositStatusEnum::APPROVED,
    ];

    $response = $this->actingAs($this->admin)
        ->patchJson('/api/deposits/'.$this->deposit->id, $data)
        ->assertStatus(200);

    expect($response['status'])->toBe(DepositStatusEnum::APPROVED->value);

});

it('should not be able to update a deposit from user', function () {

    $data = [
        'status' => DepositStatusEnum::APPROVED,
    ];

    $this->actingAs($this->user)
        ->patchJson('/api/deposits/'.$this->deposit->id, $data)
        ->assertStatus(403);

});
