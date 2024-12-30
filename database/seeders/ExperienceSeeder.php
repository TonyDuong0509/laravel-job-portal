<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Experience::insert([
            ['name' => 'Fresher'],
            ['name' => '1 Year'],
            ['name' => '2 Years'],
            ['name' => '3+ Years'],
            ['name' => '5+ Years'],
            ['name' => '8+ Years'],
            ['name' => '10+ Years'],
            ['name' => '15+ Years'],
        ]);
    }
}
