<?php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {   // TODO
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

        return redirect()->route('services.edit') // TODO
                         ->with('success', 'Servicio actualizado exitosamente.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index') // TODO
                         ->with('success', 'Servicio eliminado exitosamente.');
    }
}
