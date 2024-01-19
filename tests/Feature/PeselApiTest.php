<?php

namespace Tests\Feature;

use Tests\TestCase;

class PeselApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Puste znaczenia
     */
    public function test_pesel_empty_request(): void
    {
        $response = $this->postJson('pesel', []);

        $response->assertStatus(201)
            ->assertContent('{"ok":"OK"}');
    }

    /**
     * Błędne znaczenie pesel
     */
    public function test_pesel_error_request(): void
    {
        $response = $this->postJson('pesel', ['pesel' => '1', 'gender' => '']);

        $response->assertStatus(422)
            ->assertContent('{"message":"PESEL must contain eleven digits","errors":{"pesel":["PESEL must contain eleven digits"]}}');
    }

    /**
     * Puste znaczenie gender
     */
    public function test_empty_gender_request(): void
    {
        $response = $this->postJson('pesel', ['pesel' => '11111111111', 'gender' => '']);

        $response->assertStatus(422)
            ->assertContent('{"message":"Gender cannot be empty","errors":{"gender":["Gender cannot be empty"]}}');
    }

    /**
     * Puste znaczenie gender
     */
    public function test_gender_error_request(): void
    {
        $response = $this->postJson('pesel', ['pesel' => '11111111111', 'gender' => '2']);

        $response->assertStatus(422)
            ->assertContent('{"message":"The selected gender does not match the PESEL number entered","errors":{"gender":["The selected gender does not match the PESEL number entered"]}}');
    }

    /**
     * Puste znaczenie gender
     */
    public function test_success_request(): void
    {
        $response = $this->postJson('pesel', ['pesel' => '11111111111', 'gender' => '1']);

        $response->assertStatus(201)
            ->assertContent('{"ok":"OK"}');
    }
}
