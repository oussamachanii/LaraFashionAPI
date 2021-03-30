<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity'=> rand(1,10),
            'total_price'=> rand(1,200),
            'user_id'=> rand(1,99),
            'color_id'=> rand(1,10),
            'size_id'=> rand(1,4),
            'product_id'=> rand(1,9999),
        ];
    }
}
