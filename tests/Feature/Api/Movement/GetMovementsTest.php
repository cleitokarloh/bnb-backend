<?php

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

    \Domain\Transaction\Models\Movement::factory()->count(2)->create([
        'user_id' => $this->user->id,
    ]);

});

it('should be able to list balance changes', function () {

    $response = $this->actingAs($this->user)
        ->get('/api/movements')
        ->assertOk();

    expect($response->json())->toHaveCount(2);

});

it('should not be able to list balance changes from admin', function () {

    $this->actingAs($this->admin)
        ->get('/api/movements')
        ->assertStatus(403);

});
