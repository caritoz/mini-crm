<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use WithFaker;

    public function test_can_create_a_transaction_without_client_id_IsNotAccepted()
    {
        Passport::actingAs(
            factory(\App\User::class)->create(),
            ['check-status']
        );

        $attributes = \factory(\App\Transaction::class)
            ->raw(['client_id' => null]);

        $response = $this->json('POST','/api/auth/transactions', $attributes);

        $response->assertStatus(422);
    }
}
