<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Database\Seeders\TransactionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Run a specific seeder before each test.
     *
     * @var string
     */
    protected $seeder = TransactionSeeder::class;

    public function test_transaction_can_be_created_with_seeders_and_factories()
    {
        // Run the DatabaseSeeder...
        $this->seed();

        $this->assertTrue(true);
    }

    public function test_can_create_a_transaction_without_client_id_IsNotAccepted()
    {
        Passport::actingAs(
            \App\Models\User::factory()->create(),
            ['check-status']
        );

        $attributes = \App\Models\User::factory()->raw(['client_id' => null]);

        $response = $this->json('POST','/api/auth/transactions', $attributes);

        $response->assertStatus(422);
    }
}
