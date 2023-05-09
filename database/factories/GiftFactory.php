<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GiftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $names = [
            'Paquete Stickers',
            'Camisa Mujer - Chica',
            'Camisa Mujer - Mediana',
            'Camisa Mujer - Grande',
            'Camisa Mujer - XL',
            'Camisa Hombre - Chica',
            'Camisa Hombre - Mediana',
            'Camisa Hombre - Grande',
            'Camisa Hombre - XL'
         ];

        return [
            'name' => $this->faker->unique()->randomElement($names)
        ];
    }
}
