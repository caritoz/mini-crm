<?php
namespace Database\Seeders;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Client::create([
//            'first_name'    => 'John',
//            'last_name'     => 'Doe',
//            'email'         => 'john@example.net',
//            'avatar'        => 'https://via.placeholder.com/640x480.png/0099aa?text=lorem',
//        ]);

        Client::factory()
            ->count(50)
            ->has(Transaction::factory()->count(3))
            ->create();
    }
}
