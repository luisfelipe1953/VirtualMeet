<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            'Presencial',
            'Virtual',
            'Gratis'
        ];

        foreach ($packages as $package) {
            Package::insert([
                'name' => $package,
            ]);
        }
    }
}
