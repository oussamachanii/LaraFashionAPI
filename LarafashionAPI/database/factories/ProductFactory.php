<?php

namespace Database\Factories;

use App\Models\Product;
use Facade\Ignition\ErrorPage\Renderer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(20) ,
            'price' =>  rand(10,300),
            'shipping' => rand(0 ,20) ,
            'quantity' => rand(0 ,200) ,
            'sex' => rand(0 ,2) ,
            'views' => rand(0 ,200) ,
            'discount' => rand(10,50) ,
            'discount_start_date' => date('Y-m-d'),
            'discount_end_date' => date('Y-m-d') ,
            'category_id' => rand(1,9) ,
            // 'category_id' => 1 ,
                            
        ];
    }
}
