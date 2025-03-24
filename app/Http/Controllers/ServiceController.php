<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Controllers\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['user', 'category'])->where('status', 'activo')->get();
        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        $messages = $service->messages()->with('user')->latest()->paginate(15);
        return view('services.show', compact('service', 'messages'));
    }

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

        return redirect()->route('services.index')
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

        return redirect()->route('services.index')
                         ->with('success', 'Servicio actualizado exitosamente.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
                         ->with('success', 'Servicio eliminado exitosamente.');
    }
}
