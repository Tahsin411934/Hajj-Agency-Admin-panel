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
        $galleries= Gallery::all();
        return view('gallery.index', compact('galleries'));
    }

 

    // Store a newly created resource in storage.


    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Allow jpg, jpeg, png up to 2MB
            'caption' => 'nullable|string|max:255',
        ]);
    
        // Handle File Upload
        if ($request->hasFile('image')) {
            // Store file in 'public' disk (storage/app/public) and get the path
            $path = $request->file('image')->store('images/gallery', 'public');
        }
    
        // Store in database
        Gallery::create([
            'image' => $path, // Save the file path
            'caption' => $request->input('caption'),
        ]);
    
        // Return back with success message
        return back()->with('success', 'Gallery item created successfully.');
    }
    

   


    // Update the specified resource in storage.
    public function update(Request $request, Gallery $gallery)
    {
        // Validation
        $request->validate([
            
            'caption' => 'nullable|string',
        ]);

        // Update in database
        $gallery->update($request->all());

        return back()->with('success', 'Gallery item updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return back()->with('success', 'Gallery item deleted successfully.');
    }
}
