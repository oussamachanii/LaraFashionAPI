<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        // $categories=array('Dress','Jacket','T-shirt','Coat','Outerwear','Hoodies','blouse','jeans','blazer');
        return [

            // 'title'=> $categories[$this->faker->unique()->randomDigit],
            // randomElement([1, 3, 5, 7, 9])
            // 'title'=> $this->faker->randomElement('Dress','Jacket','T-shirt','Coat','Outerwear','Hoodies','blouse','jeans','blazer')
            'title'=> $this->faker->unique()->word
            
            
        ];
    }
}
