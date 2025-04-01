<?php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Obtén los servicios activos con sus relaciones
        $services = Service::with(['user', 'category'])->where('status', 'activo')->get();

        // Define manualmente las rutas de las imágenes para cada servicio
        $images = [
            1 => [
                '/images/paris/paris1.jpg',
                '/images/paris/paris2.jpg',
                '/images/paris/paris3.jpg',
                '/images/paris/paris4.jpg',
                '/images/paris/paris5.jpg',
            ],
            2 => [
                '/images/china/china1.jpg',
                '/images/china/china2.jpg',
                '/images/china/china3.jpg',
                '/images/china/china4.jpg',
                '/images/china/china5.jpg',
            ],
            3 => [
                '/images/serengeti/serengeti1.jpg',
                '/images/serengeti/serengeti2.jpg',
                '/images/serengeti/serengeti3.jpg',
                '/images/serengeti/serengeti4.jpg',
                '/images/serengeti/serengeti5.jpg',
            ],
            4 => [
                '/images/toscana/toscana1.jpg',
                '/images/toscana/toscana2.jpg',
                '/images/toscana/toscana3.jpg',
                '/images/toscana/toscana4.jpg',
                '/images/toscana/toscana5.jpg',
            ],
            5 => [
                '/images/machupicchu/machupicchu1.jpg',
                '/images/machupicchu/machupicchu2.jpg',
                '/images/machupicchu/machupicchu3.jpg',
                '/images/machupicchu/machupicchu4.jpg',
                '/images/machupicchu/machupicchu5.jpg',
            ],
            6 => [
                '/images/egipto/egipto1.jpg',
                '/images/egipto/egipto2.jpg',
                '/images/egipto/egipto3.jpg',
                '/images/egipto/egipto4.jpg',
                '/images/egipto/egipto5.jpg',
            ],
            7 => [
                '/images/islandia/islandia1.jpg',
                '/images/islandia/islandia2.jpg',
                '/images/islandia/islandia3.jpg',
                '/images/islandia/islandia4.jpg',
                '/images/islandia/islandia5.jpg',
            ],
            8 => [
                '/images/colombia/colombia1.jpg',
                '/images/colombia/colombia2.jpg',
                '/images/colombia/colombia3.jpg',
                '/images/colombia/colombia4.jpg',
                '/images/colombia/colombia5.jpg',
            ],
            9 => [
                '/images/mexico/mexico1.jpg',
                '/images/mexico/mexico2.jpg',
                '/images/mexico/mexico3.jpg',
                '/images/mexico/mexico4.jpg',
                '/images/mexico/mexico5.jpg',
            ],
            10 => [
                '/images/nuevayork/nuevayork1.jpg',
                '/images/nuevayork/nuevayork2.jpg',
                '/images/nuevayork/nuevayork3.jpg',
                '/images/nuevayork/nuevayork4.jpg',
                '/images/nuevayork/nuevayork5.jpg',
            ],
            11 => [
                '/images/costarica/costarica1.jpg',
                '/images/costarica/costarica2.jpg',
                '/images/costarica/costarica3.jpg',
                '/images/costarica/costarica4.jpg',
                '/images/costarica/costarica5.jpg',
            ],
            12 => [
                '/images/kyoto/kyoto1.jpg',
                '/images/kyoto/kyoto2.jpg',
                '/images/kyoto/kyoto3.jpg',
                '/images/kyoto/kyoto4.jpg',
                '/images/kyoto/kyoto5.jpg',
            ],
            13 => [
                '/images/argentina/argentina1.jpg',
                '/images/argentina/argentina2.jpg',
                '/images/argentina/argentina3.jpg',
                '/images/argentina/argentina4.jpg',
                '/images/argentina/argentina5.jpg',
            ],
        ];

        // Pasa los servicios e imágenes a la vista
        return view('services.index', [
            'services' => $services,
            'images' => $images,
        ]);
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
        return view('services.show', compact('service'));
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
