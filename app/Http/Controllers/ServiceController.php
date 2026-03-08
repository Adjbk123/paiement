<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
       public function index()
    {
        $services = Service::latest()->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'link' => 'nullable|url'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/services'), $filename);
            $imagePath = 'uploads/services/'.$filename;
        }

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_path' => $imagePath,
            'features' => $request->features ?? [],
            'link' => $request->link
        ]);

        return redirect()->route('employer.gestservices.services.index')
                         ->with('success','Service créé avec succès !');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'link' => 'nullable|url'
        ]);

        $imagePath = $service->image_path;
        if ($request->hasFile('image')) {
            if ($service->image_path && file_exists(public_path($service->image_path))) {
                unlink(public_path($service->image_path));
            }
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/services'), $filename);
            $imagePath = 'uploads/services/'.$filename;
        }

        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'image_path' => $imagePath,
            'features' => $request->features ?? [],
            'link' => $request->link
        ]);

        return redirect()->route('employer.gestservices.services.index')
                         ->with('success','Service mis à jour avec succès !');
    }

    public function destroy(Service $service)
    {
        if ($service->image_path && file_exists(public_path($service->image_path))) {
            unlink(public_path($service->image_path));
        }

        $service->delete();
        return back()->with('success','Service supprimé avec succès !');
    }
}

