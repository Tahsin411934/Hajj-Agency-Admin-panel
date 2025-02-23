<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $galleries = Gallery::all();
        return view('gallery.index', compact('galleries'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {  
        try {
            // Validation
            $validated = $request->validate([
                'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'caption' => 'nullable|string|max:255',
                'video_url' => 'nullable|string|max:255',
            ]);

            // Handle File Upload
            $path = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images/gallery', 'public');
            }

            // Store in database
            Gallery::create([
                'image' => $path,
                'caption' => $request->input('caption'),
                'video_url' => $request->input('video_url'),
            ]);

            return back()->with('success', 'Gallery item created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    // Update the specified resource in storage.
    public function update(Request $request, Gallery $gallery)
    {
        try {
            // Validation
            $validated = $request->validate([
                'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'caption' => 'nullable|string|max:255',
                'video_url' => 'nullable|string|max:255',
            ]);

            // Handle File Upload
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    Storage::disk('public')->delete($gallery->image);
                }

                // Store the new image
                $validated['image'] = $request->file('image')->store('images/gallery', 'public');
            }

            // Update in database
            $gallery->update($validated);

            return back()->with('success', 'Gallery item updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    // Remove the specified resource from storage.
    public function destroy(Gallery $gallery)
    {
        // Delete the image file if it exists
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return back()->with('success', 'Gallery item deleted successfully.');
    }
}
