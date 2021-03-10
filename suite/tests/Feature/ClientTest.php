<?php

namespace Tests\Feature;

use App\Client;
use App\Transaction;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use WithFaker, WithoutMiddleware;//, RefreshDatabase;

//    public function test_registered_clients_may_sign_in()
//    {
//        $this->load(function (Client $client, Client $client1, Client $client2, Client $client3){
//            dump(func_get_args());
//        });
//    }

    public function test_can_create_client()
    {
        $request = [
            'first_name'    => $this->faker->firstName,
            'last_name'     => $this->faker->lastName,
            'avatar'        => $this->faker->imageUrl(),
            'email'         => $this->faker->unique()->safeEmail,
        ];

        $client = factory(Client::class)->create($request);

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

        $client = factory(Client::class)->create($request);

        $transaction = factory(Transaction::class)->create([
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

        $client = factory(Client::class)->create($request);

        $this->json( 'GET', "/api/auth/clients/{$client->id}", [], $this->headers)
                ->assertJson([
                    'first_name' => $firstName,
                ]);

        $this->assertTrue(true);
    }
}
