<?php

use App\Models\User;

use function Pest\Laravel\postJson;

// test('should create user', function () {
//     $data = [
//         'email' => '',
//         'password' => '',
//     ];
//     postJson('/create', $data)->dump();
// });

test('should auth user', function () {
    // Factory, cria usuario fake
    $user = User::factory()->create();

    $data = [
        'email' => $user->email,
        'password' => 'password',
    ];

    postJson(route('auth.login'), $data)
        ->assertOk()
        ->assertJsonStructure(['token', 'status']);
});

it('should fail auth user', function () {
    $user = User::factory()->create();

    $data = [
        'email' => $user->email,
        'password' => 'email',
    ];

    postJson(route('auth.login'), $data)
        ->assertStatus(422)
        ->assertJsonStructure(['status']);
});

it('should fail email user', function () {

    $data = [
        'email' => "emailexample.com",
        'password' => 'password',
    ];

    postJson(route('auth.login'), $data)
        ->assertStatus(422)
        ->assertJsonStructure(['status']);
});



// email inexistete
// email errrado
// VALIDAR OS ERROS, MAIS IMPORTANTE QUE O CAMINHO FELIZ


// it('show return status code 200', fn() => getJson('/login')->assertOk());

// it('get all user', fn() => getJson('/user')->assertStatus(201));
