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
                'category_id' => 1,
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
                'title' => 'Viaja por Machupicchu',
                'description' => 'Conoce un nuevo "mundo"',
                'user_id' => 1,
                'price' => 300.00,
                'duration' => 4,
                'category_id' => 2,
                'status' => 'activo',
            ],
            [
                'title' => 'Egipto: Misterios de las Pirámides',
                'description' => 'Sumérgete en la historia milenaria del antiguo Egipto y admira la majestuosidad de sus pirámides...',
                'user_id' => 1,
                'price' => 600.00,
                'duration' => 8,
                'category_id' => 1,
                'status' => 'activo',
            ],
            [
                'title' => 'Islandia: Tierra de fuego y hielo',
                'description' => 'Aguas termales, glaciares y paisajes únicos en un viaje inolvidable por la isla nórdica...',
                'user_id' => 1,
                'price' => 900.00,
                'duration' => 10,
                'category_id' => 1,
                'status' => 'activo',
            ],
            [
                'title' => 'Ruta del café en Colombia',
                'description' => 'Adéntrate en las montañas cafeteras y descubre el sabor auténtico de Colombia, visitando fincas tradicionales y probando café recién tostado.',
                'user_id' => 1,
                'price' => 350.00,
                'duration' => 6,
                'category_id' => 1,
                'status' => 'activo',
            ],
            [
                'title' => 'Tour gastronómico en Ciudad de México',
                'description' => 'Deléitate con la variada y deliciosa cocina mexicana: tacos, moles, antojitos y una cultura llena de colores y tradiciones.',
                'user_id' => 1,
                'price' => 400.00,
                'duration' => 5,
                'category_id' => 1,
                'status' => 'activo',
            ],
            [
                'title' => 'Nueva York: la ciudad que nunca duerme',
                'description' => 'Vive la energía de Manhattan, pasea por Central Park y sumérgete en la multiculturalidad de la Gran Manzana.',
                'user_id' => 1,
                'price' => 750.00,
                'duration' => 7,
                'category_id' => 1,
                'status' => 'activo',
            ],
            [
                'title' => 'Costa Rica: paraíso natural',
                'description' => 'Descubre playas de ensueño, bosques lluviosos y una biodiversidad única en un país comprometido con la ecología.',
                'user_id' => 1,
                'price' => 650.00,
                'duration' => 8,
                'category_id' => 1,
                'status' => 'activo',
            ],
            [
                'title' => 'La magia de Kyoto y Tokio en Japón',
                'description' => 'Un viaje entre tradición y modernidad, templos ancestrales y rascacielos futuristas, gastronomía única y cultura milenaria.',
                'user_id' => 1,
                'price' => 1200.00,
                'duration' => 10,
                'category_id' => 1,
                'status' => 'activo',
            ],
            [
                'title' => 'Ruta por la Patagonia Argentina',
                'description' => 'Maravíllate con glaciares, montañas imponentes y paisajes vírgenes en uno de los destinos más espectaculares de Sudamérica.',
                'user_id' => 1,
                'price' => 1000.00,
                'duration' => 12,
                'category_id' => 1,
                'status' => 'activo',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
