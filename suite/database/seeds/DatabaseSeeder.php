<?php

use App\Client;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);

        Client::create([
            'first_name'    => 'John',
            'last_name'     => 'Doe',
            'email'         => 'john@example.net',
            'avatar'        => 'https://via.placeholder.com/640x480.png/0099aa?text=lorem',
        ]);

        Transaction::create([
            'reference' => '59318212df40c0b77abd2afc',
            'amount'    => (float) 25.7,
            'client_id' => DB::table('clients')->where('email', 'john@example.net')->value('id')
        ]);

        // another factories
        factory(App\Client::class, 10)->create()->each(function ($client) {
            $client->transactions()->save(factory(App\Transaction::class)->make());
        });
    }
}
