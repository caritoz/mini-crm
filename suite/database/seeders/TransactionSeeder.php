<?php
namespace Database\Seeders;

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
//        Transaction::create([
//            'reference' => '59318212df40c0b77abd2afc',
//            'amount'    => (float) 25.7,
//            'client_id' => DB::table('clients')->where('email', 'john@example.net')->value('id')
//        ]);

        $client = \App\Models\Client::factory()->create();

        $transactions = Transaction::factory()
            ->count(3)
            ->for($client)
            ->create();
    }
}
