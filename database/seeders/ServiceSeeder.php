<?php

namespace database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Descubre la magia de París',
                'description' => 'Un viaje inolvidable por la Ciudad del Amor...',
                'user_id' => 1,
                'price' => 250.00,
                'duration' => 5,
                'category_id' => 2,
                'status' => 'activo',
            ],
            [
                'title' => 'Aventura en la Gran Muralla China',
                'description' => 'Explora la historia y las impresionantes vistas...',
                'user_id' => 1,
                'price' => 320.00,
                'duration' => 7,
                'category_id' => 3,
                'status' => 'activo',
            ],
            [
                'title' => 'Safari en el Serengeti',
                'description' => 'Vive la emoción de un safari en Tanzania...',
                'user_id' => 1,
                'price' => 450.00,
                'duration' => 10,
                'category_id' => 4,
                'status' => 'activo',
            ],
            [
                'title' => 'Ruta por la Toscana en Italia',
                'description' => 'Disfruta de un recorrido por los viñedos...',
                'user_id' => 1,
                'price' => 280.00,
                'duration' => 6,
                'category_id' => 5,
                'status' => 'activo',
            ],
            [
                'title' => 'Explorando Machu Picchu',
                'description' => 'Una expedición única a la ciudad perdida de los incas...',
                'user_id' => 1,
                'price' => 400.00,
                'duration' => 8,
                'category_id' => 1,
                'status' => 'activo',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
