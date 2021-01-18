<?php

namespace Tests\Feature;

use App\Client;
use App\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_create_client()
    {
        $faker = \Faker\Factory::create();

        $request = [
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'avatar'        => $faker->imageUrl(),
            'email'         => $faker->unique()->safeEmail,
        ];

        $client = factory(Client::class)->create($request);

        $this->assertTrue(true);
    }

    public function test_can_create_client_with_one_transaction()
    {
        $faker = \Faker\Factory::create();

        $request = [
            'first_name'    => $faker->firstName,
            'last_name'     => $faker->lastName,
            'avatar'        => $faker->imageUrl(),
            'email'         => $faker->unique()->safeEmail,
        ];

        $client = factory(Client::class)->create($request);

        $transaction = factory(Transaction::class)->create([
            'client_id' => $client->id,
            'amount'    => $faker->randomFloat(2, 3),
        ]);

        $this->assertTrue(true);
    }
}
