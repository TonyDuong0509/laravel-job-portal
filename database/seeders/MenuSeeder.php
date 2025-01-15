<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_menus = array(
            array(
                "id" => 1,
                "name" => "Navigation Menu",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 2,
                "name" => "Footer Menu One",
                "created_at" => "2025-01-14 08:44:19",
                "updated_at" => "2025-01-14 08:44:19",
            ),
            array(
                "id" => 3,
                "name" => "Footer Menu Two",
                "created_at" => "2025-01-14 08:44:36",
                "updated_at" => "2025-01-14 08:44:36",
            ),
            array(
                "id" => 4,
                "name" => "Footer Menu Three",
                "created_at" => "2025-01-14 08:44:45",
                "updated_at" => "2025-01-14 08:44:45",
            ),
            array(
                "id" => 5,
                "name" => "Footer Menu Four",
                "created_at" => "2025-01-14 08:44:55",
                "updated_at" => "2025-01-14 08:44:55",
            ),
        );

        DB::table('admin_menus')->insert($admin_menus);
    }
}
