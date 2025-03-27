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
        $service = Service::with(['messages.user', 'user', 'category'])->findOrFail($id);

        // Redirigir a vistas personalizadas según el ID
        switch ($id) {
            case 1:
                return view('services.viajes.paris', compact('service'));
            case 2:
                return view('services.viajes.china', compact('service'));
            case 3:
                return view('services.viajes.serengeti', compact('service'));
            case 4:
                return view('services.viajes.italia', compact('service'));
            case 5:
                return view('services.viajes.machupicchu', compact('service'));
            case 6:
                return view('services.viajes.egipto', compact('service'));
            case 7:
                return view('services.viajes.islandia', compact('service'));
            case 8:
                return view('services.viajes.colombia', compact('service'));
            case 9:
                return view('services.viajes.mexico', compact('service'));
            case 10:
                return view('services.viajes.nuevayork', compact('service'));
            case 11:
                return view('services.viajes.costarica', compact('service'));
            case 12:
                return view('services.viajes.kyoto', compact('service'));
            case 13:
                return view('services.viajes.argentina', compact('service'));
            default:
                return view('services.show', compact('service'));
        }
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
