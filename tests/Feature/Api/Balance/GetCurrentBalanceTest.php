<?php

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);

});

it('should be able to get balance amount', function () {

    $response = $this->actingAs($this->user)
        ->get('/api/balance')
        ->assertOk();

    expect($response->json()['amount'])->toBe(0);

});

it('should not be able to get balance amount from admin', function () {

    $this->actingAs($this->admin)
        ->get('/api/balance')
        ->assertStatus(403);

});
