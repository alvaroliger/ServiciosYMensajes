<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['user', 'category'])
            ->where('status', 'activo')
            ->get();

        return view('services.index', compact('services'));
    }

    public function comentar(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        \App\Models\Message::create([
            'user_id' => auth()->id(),
            'service_id' => $id,
            'body' => $request->body,
            'conversation_id' => null
        ]);

        return redirect()->route('services.show', $id)
            ->with('success', 'Comentario publicado con éxito.');
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);

        $fotos = [];

        if (!empty($service->rutas_fotos)) {
            $decoded = json_decode($service->rutas_fotos, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $fotos = $decoded;
            }
        }

        return view('services.show', compact('service', 'fotos'));
    }

    /*
    public function comentar(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        \App\Models\Message::create([
            'user_id' => auth()->id(),
            'service_id' => $id,
            'body' => $request->body,
            'conversation_id' => null
        ]);

        return redirect()->route('services.showSinC', $id)
            ->with('success', 'Comentario publicado con éxito.');
    }

    public function showSinC($id)
    {
        $service = Service::findOrFail($id);

        $fotos = [];

        if (!empty($service->rutas_fotos)) {
            $decoded = json_decode($service->rutas_fotos, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $fotos = $decoded;
            }
        }

        return view('services.showSinC', compact('service', 'fotos'));
    }
        */

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric'
        ]);

        Service::create($validatedData);

        return redirect()->route('services.create')
            ->with('success', 'Servicio creado exitosamente.');
    }

    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric'
        ]);

        $service->update($validatedData);

        return redirect()->route('services.edit')
            ->with('success', 'Servicio actualizado exitosamente.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Servicio eliminado exitosamente.');
    }
}
