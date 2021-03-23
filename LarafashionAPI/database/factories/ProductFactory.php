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
            'title' => 'Lorem ipsum dolor sit',
            'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deleniti vel veniam provident, praesentium fugit atque modi quo magni tempora! Repellat autem quasi adipisci aperiam, incidunt debitis beatae vitae asperiores ipsa.',
            'price' =>  rand(10,300),
            'shipping' => rand(0 ,20) ,
            'sex' => rand(0 ,2) ,
            'views' => rand(0 ,200) ,
            'discount' => 0 ,
            // 'category_id' => rand(1,10) ,
            'category_id' => 1 ,
                            
        ];
    }
}
