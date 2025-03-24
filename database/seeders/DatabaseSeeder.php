<?php

namespace database\Seeders;

use Illuminate\Database\Seeder;
use database\Seeders\CategorySeeder;
use database\Seeders\ServiceSeeder;
use database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ServiceSeeder::class);
    }
}
