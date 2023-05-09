<?php

namespace Database\Seeders;

use Database\Seeders\DaySeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\GiftSeeder;
use Database\Seeders\TimeSeeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\PackageSeeder;
use Database\Seeders\SpeakerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(SpeakerSeeder::class);
        $this->call(GiftSeeder::class);
        $this->call(TimeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(DaySeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(EventSeeder::class);
    }
}
