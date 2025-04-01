<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('services')->get();

        // Generar imágenes para todas las categorías basadas en los servicios
        $images = [];
        foreach ($categories as $category) {
            $images = array_merge($images, $category->generateImages());
        }

        return view('services.index', [
            'categories' => $categories,
            'images' => $images,
        ]);
    }
}
