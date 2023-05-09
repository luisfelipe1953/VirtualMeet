<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $times = [
            '10:00 - 10:55',
            '11:00 - 11:55',
            '12:00 - 12:55',
            '13:00 - 13:55',
            '16:00 - 16:55',
            '17:00 - 17:55',
            '18:00 - 18:55',
            '19:00 - 19:55'
        ];

        return [
            'time' => $this->faker->unique()->randomElement($times)
        ];
    }
}
