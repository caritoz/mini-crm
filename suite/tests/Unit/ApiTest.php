<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use WithFaker;

    /**
     * Testing the application is working.
     *
     * @return void
     */
    public function test_application_is_working()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_relationships_are_defined()
    {
        $this->assertInstanceOf(BelongsTo::class, (new \App\Models\Transaction())->client());
        $this->assertInstanceOf(HasMany::class, (new \App\Models\Client())->transactions());
    }

    public function test_incorrect_credentials_is_not_accepted()
    {
        $attributes = [
            'email'     => 'admin@admin.com',
            'password'  => ''
        ];

        $response = $this->json('POST','/api/auth/login', $attributes, $this->headers);
        $response->assertStatus(422);
    }

    public function test_get_clients_with_credentials()
    {
        Passport::actingAs(
            \App\Models\User::factory()->create(),
            ['create-servers']
        );

        $response = $this->json( 'GET', '/api/auth/clients', [], $this->headers);

        $response->assertStatus(200);
    }
}
