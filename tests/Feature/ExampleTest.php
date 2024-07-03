<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function Pest\Laravel\getJson;

// Padrão Unit dentro de classe
// class ExampleTest extends TestCase
// {
//     public function test_the_application_returns_a_successful_response(): void
//     {
//         $response = $this->get('/');

//         $response->assertStatus(200);
//     }
// }

// Padrão Pest, não precisa estar dentro de classe
it('test_the_application_returns_a_successful_respons', fn() => getJson('/')->assertOk());

