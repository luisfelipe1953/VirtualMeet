<?php

namespace Database\Factories;

use App\Models\Gift;
use App\Models\User;
use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   
        
        return [
            'user_id' => User::all()->random()->id,
            'package_id' => Package::all()->random()->id,
            'token' => Str::random(8),
            'payment_id' => Str::random(10),
            'gift_id' => Gift::all()->random()->id,
        ];
    }
}
