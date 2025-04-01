<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $destinos = [
            1 => 'paris',
            2 => 'china',
            3 => 'serengeti',
            4 => 'toscana',
            5 => 'machupicchu',
            6 => 'egipto',
            7 => 'islandia',
            8 => 'colombia',
            9 => 'mexico',
            10 => 'nuevayork',
            11 => 'costarica',
            12 => 'kyoto',
            13 => 'argentina',
        ];

        foreach ($destinos as $id => $carpeta) {
            Service::create([
                'title' => ucfirst($carpeta),
                'description' => "Viaje increíble a $carpeta.",
                'user_id' => 1,
                'price' => 100 + ($id * 20),
                'duration' => 3 + $id,
                'category_id' => 1,
                'status' => 'activo',
                'rutas_fotos' => json_encode(
                    array_map(fn($i) => "images/$carpeta/{$carpeta}$i.jpg", range(1, 5)),
                    JSON_UNESCAPED_SLASHES
                ),
            ]);
        }
    }
}
