<?php

namespace Database\Seeders;

use App\Models\JobExperience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experiences = [
            'Fresher',
            '1 Year',
            '2 Years',
            '3+ Years',
            '5+ Years',
            '8+ Years',
            '10+ Years',
            '15+ Years',
        ];

        foreach ($experiences as $item) {
            $createItem = new JobExperience();
            $createItem->name = $item;
            $createItem->save();
        }
    }
}
