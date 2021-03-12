<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ClientSeeder::class,
            TransactionSeeder::class
        ]);

        // another factories
//        factory(App\Models\Client::class, 10)->create()->each(function ($client) {
//            $client->transactions()->save(factory(App\Models\Transaction::class)->make());
//        });
    }
}
