<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::latest()->paginate(10);
        return view('abouts.index', compact('abouts'));
    }

    public function create()
    {
        return view('abouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subtitle' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/abouts'), $filename);
            $imagePath = 'uploads/abouts/'.$filename;
        }

        About::create([
            'subtitle' => $request->subtitle,
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'tabs' => $request->tabs ? json_encode($request->tabs) : null,
            'features' => $request->features ? json_encode($request->features) : null,
        ]);

        return redirect()->route('employer.gestabouts.abouts.index')
            ->with('success', 'About ajouté avec succès');
    }

    public function edit(About $about)
    {
        return view('abouts.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $request->validate([
            'subtitle' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $about->image_path;

        if ($request->hasFile('image')) {

            // supprimer ancienne image
            if ($about->image_path && file_exists(public_path($about->image_path))) {
                unlink(public_path($about->image_path));
            }

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/abouts'), $filename);
            $imagePath = 'uploads/abouts/'.$filename;
        }

        $about->update([
            'subtitle' => $request->subtitle,
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'tabs' => $request->tabs ? json_encode($request->tabs) : null,
            'features' => $request->features ? json_encode($request->features) : null,
        ]);

        return redirect()->route('employer.gestabouts.abouts.index')
            ->with('success', 'About modifié avec succès');
    }

    public function destroy(About $about)
    {
        if ($about->image_path && file_exists(public_path($about->image_path))) {
            unlink(public_path($about->image_path));
        }

        $about->delete();

        return redirect()->route('employer.gestabouts.abouts.index')
            ->with('success', 'About supprimé avec succès');
    }
}
