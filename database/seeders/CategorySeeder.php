<?php

namespace database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'Aventura'],
            ['id' => 2, 'name' => 'Cultural'],
            ['id' => 3, 'name' => 'Histórico'],
            ['id' => 4, 'name' => 'Naturaleza'],
            ['id' => 5, 'name' => 'Gastronomía'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['id' => $category['id']],
                [
                    'name' => $category['name'],
                    'slug' => Str::slug($category['name']), //Slug automático
                ]
            );
        }
    }
}
