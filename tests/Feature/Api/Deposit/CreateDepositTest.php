<?php

use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->user = createUser();
    $this->admin = createUser(isAdmin: true);
});

it('should be able to create a deposit', function () {
    $data = [
        'description' => 'Deposit',
        'amount' => 100,
        'image' => UploadedFile::fake()->image('deposit.jpg'),
    ];

    $response = $this->actingAs($this->user)->postJson('/api/deposits', $data);

    $response->assertStatus(201);
    $response->assertJsonStructure(['id', 'amount', 'user_id', 'created_at', 'updated_at']);
    expect($response['amount'])->toBe(100);
});

it('should not be able to create a deposit as a admin user', function () {
    $data = [
        'description' => 'Deposit',
        'amount' => 100,
        'image' => UploadedFile::fake()->image('deposit.jpg'),
    ];

    $response = $this->actingAs($this->admin)->postJson('/api/deposits', $data);

    $response->assertStatus(403);
});
