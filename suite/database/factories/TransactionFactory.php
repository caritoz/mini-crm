<?php
namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => function(){
                return \App\Models\User::factory()->make()->id;
            },
            'reference' => $this->faker->regexify('[A-Za-z0-9]{24}'),
            'amount'    => $this->faker->randomFloat(2, 3, 100)
        ];
    }
}
