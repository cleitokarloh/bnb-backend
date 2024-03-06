<?php

use Domain\User\Models\User;

beforeEach(function () {
    User::factory()->create([
        'name' => 'John Doe',
        'username' => 'john',
        'password' => bcrypt('password'),
    ]);
});

it('should be able to login an user', function () {
    $data = [
        'username' => 'john',
        'password' => 'password',
        'device' => 'test',
    ];

    $response = $this->postJson('/api/users/token', $data);

    $response->assertStatus(200);
    $response->assertJsonStructure(['userData', 'token']);
    expect($response['token'])->not->toBeEmpty();
});
