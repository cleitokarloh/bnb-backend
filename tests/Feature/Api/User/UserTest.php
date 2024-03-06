<?php

it('should be able to create an user', function () {
    $data = [
        'name' => 'John Doe',
        'username' => 'john',
        'password' => 'password',
    ];

    $response = $this->postJson('/api/users', $data);

    $response->assertStatus(201);
    $response->assertJsonFragment([
        'name' => $data['name'],
        'username' => $data['username'],
    ]);
});
