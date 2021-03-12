<?php

namespace Tests\Feature;

use Database\Seeders\ClientSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use WithFaker, WithoutMiddleware, RefreshDatabase;

    /**
     * Run a specific seeder before each test.
     *
     * @var string
     */
    protected $seeder = ClientSeeder::class;

    public function test_client_can_be_created_with_seeders_and_factories()
    {
        // Run a specific seeder...
        $this->seed(ClientSeeder::class);
        $this->assertTrue(true);
    }

    public function test_can_create_client()
    {
        $request = [
            'first_name'    => $this->faker->firstName,
            'last_name'     => $this->faker->lastName,
            'avatar'        => $this->faker->imageUrl(),
            'email'         => $this->faker->unique()->safeEmail,
        ];

        $client = \App\Models\Client::factory()->create($request);

        $this->assertTrue(true);
    }

    public function test_can_create_client_with_one_transaction()
    {
        $request = [
            'first_name'    => $this->faker->firstName,
            'last_name'     => $this->faker->lastName,
            'avatar'        => $this->faker->imageUrl(),
            'email'         => $this->faker->unique()->safeEmail,
        ];

        $client = \App\Models\Client::factory()->create($request);

        $transaction = \App\Models\Transaction::factory()->create([
            'client_id' => $client->id,
            'reference' => $this->faker->regexify('[A-Za-z0-9]{24}'),
            'amount'    => $this->faker->randomFloat(2, 3),
        ]);

        $this->assertTrue(true);
        $this->assertCount(1, $client->transactions);
        $this->assertEquals($client->email, $transaction->client->email);
    }

    public function test_can_the_api_require_client_first_name()
    {
        //$this->withoutExceptionHandling();

        $firstName = $this->faker->firstName;

        $request = [
            'first_name'    => $firstName,
            'last_name'     => $this->faker->lastName,
            'avatar'        => $this->faker->imageUrl(),
            'email'         => $this->faker->unique()->safeEmail,
        ];

        $client = \App\Models\Client::factory()->create($request);

        $this->json( 'GET', "/api/auth/clients/{$client->id}", [], $this->headers)
                ->assertJson([
                    'first_name' => $firstName,
                ]);

        $this->assertTrue(true);
    }
}
