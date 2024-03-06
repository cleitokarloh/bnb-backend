<?php

beforeEach(function () {
    $this->user = createUser();

    \Domain\Transaction\Models\Deposit::factory()->count(2)->create([
        'user_id' => $this->user->id,
        'amount' => 100,
    ]);
});

it('should be able to get deposits of user based in authentication', function () {

    $response = $this->actingAs($this->user)
        ->get('/api/deposits/customer')
        ->assertStatus(200);

    expect($response->json())->toHaveCount(2);

});
