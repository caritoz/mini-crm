<?php

namespace Tests\Unit;

use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;

use Laravel\Passport\ClientRepository;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PassportTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    protected $headers = [];
    protected $scopes = [];
    protected $user;
    protected $baseUrl;

    public function setUp() :void
    {
        parent::setUp();

        $this->baseUrl = env('APP_URL');

        $clientRepository = new ClientRepository();

        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', $this->baseUrl
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        $this->user = \App\Models\User::factory()->create();

        $token = $this->user->createToken('TestToken', $this->scopes)->accessToken;

        $this->headers['Accept']        = 'application/json';
        $this->headers['Authorization'] = 'Bearer '.$token;
    }

    public function test_can_i_create_a_passport_client()
    {
        Passport::actingAsClient(
            \App\Models\Client::factory()->create(),
            ['create-servers']
        );

        $this->assertTrue(true);
    }
}
