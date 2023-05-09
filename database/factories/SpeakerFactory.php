<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SpeakerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'image' => $this->faker->md5(),
            'tags' => implode(',', $this->faker->words(3, false)),
            'networks' => json_encode([
                'facebook' => $this->faker->optional()->url,
                'twitter' => $this->faker->optional()->url,
                'youtube' => $this->faker->optional()->url,
                'instagram' => $this->faker->optional()->url,
                'tiktok' => $this->faker->optional()->url,
                'github' => $this->faker->optional()->url,
            ]),
        ];
    }
}
