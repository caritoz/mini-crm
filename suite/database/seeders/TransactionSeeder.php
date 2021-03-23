<?php
namespace Database\Seeders;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::factory()
            ->count(3)
            ->for(Client::factory())
            ->create();
    }
}
