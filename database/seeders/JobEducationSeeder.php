<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educations = [
            'Intermediate',
            'Bachelor Degree',
            'PhD',
            'High School',
            'Any'
        ];

        foreach ($educations as $item) {
            $createItem = new Education();
            $createItem->name = $item;
            $createItem->save();
        }
    }
}
