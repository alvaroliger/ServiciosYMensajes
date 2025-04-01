<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Relación con los servicios.
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Genera las rutas de imágenes basadas en los servicios de esta categoría.
     *
     * @return array
     */
    public function generateImages()
    {
        $images = [];

        foreach ($this->services as $service) {
            // Agrega la imagen principal del servicio
            $images[] = "{$service->title}/{$service->title}.jpg";

            // Agrega las imágenes numeradas del 1 al 5
            for ($i = 1; $i <= 5; $i++) {
                $images[] = "{$service->title}/{$service->title}{$i}.jpg";
            }
        }

        return $images;
    }
}
