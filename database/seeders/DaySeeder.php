<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            'Viernes',
            'Sabado',
        ];

        foreach ($days as $day) {
            Day::insert([
                'name' => $day,
            ]);
        }
    }
}
