<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CarouselImage;

class CarouselImageController extends Controller
{
    public function index()
    {
        $images = CarouselImage::orderBy('order')->get();
        return view('carousel.index', compact('images'));
    }

    public function create()
    {
        return view('carousel.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|max:2048',
            'order' => 'nullable|integer',
        ]);

        $path = $request->file('image')->store('carousel', 'public');

        CarouselImage::create([
            'title' => $validated['title'] ?? null,
            'image_path' => $path,
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('carousel.index')->with('success', 'Imagen agregada.');
    }

    public function edit(CarouselImage $carouselImage)
    {
        return view('carousel.edit', compact('carouselImage'));
    }

    public function update(Request $request, CarouselImage $carousel)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($carousel->image_path && Storage::disk('public')->exists($carousel->image_path)) {
                Storage::disk('public')->delete($carousel->image_path);
            }

            $validated['image_path'] = $request->file('image')->store('carousel', 'public');
        }

        $carousel->update([
            'title' => $validated['title'] ?? $carousel->title,
            'order' => $validated['order'] ?? $carousel->order,
            'image_path' => $validated['image_path'] ?? $carousel->image_path,
        ]);

        return redirect()->route('carousel.index')->with('success', 'Imagen actualizada.');
    }

    public function destroy(CarouselImage $carousel)
    {
        if ($carousel->image_path) {
            Storage::disk('public')->delete($carousel->image_path);
        }
        $carousel->delete();
        return redirect()->route('carousel.index')->with('success', 'Imagen eliminada.');
    }
}
