<?php
namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function services()
    {
        $services = Service::with(['user', 'category'])->where('status', 'activo')->get();
        return view('services.index', compact('services'));
    }
    public function show(Service $service)
    {
        $messages = $service->messages()->with('user')->latest()->paginate(15);
        return view('services.show', compact('service', 'messages'));
        $service = \App\Models\Service::with('user')->findOrFail($id);
        return view('services.show', compact('service'));


    }
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }


}
