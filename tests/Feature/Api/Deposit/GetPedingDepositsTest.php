<?php

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

    \Domain\Transaction\Models\Deposit::factory()->count(2)->create([
        'user_id' => $this->user->id,
        'amount' => 100,
    ]);
});

it('should be able to get pending deposits', function () {

    $response = $this->actingAs($this->admin)
        ->get('/api/deposits/pending')
        ->assertStatus(200);

    expect($response->json())->toHaveCount(2);

});

it('should not be able to get pending deposits by customer', function () {

    $this->actingAs($this->user)
        ->get('/api/deposits/pending')
        ->assertStatus(403);

});
