<?php

namespace App\Http\Controllers;

use App\Models\SectionContent;
use Illuminate\Http\Request;

class SectionContentController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $sectionContents = SectionContent::all(); // Get all section content
        return view('sectionContent.index', compact('sectionContents'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'sectionName' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Added image validation
        ]);
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            // Store the image in the 'public/section_images' folder
            $imagePath = $request->file('image')->store('section_images', 'public');
    
            // Create a new SectionContent record
            $sectionContent = SectionContent::create([
                'sectionName' => $request->sectionName,
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imagePath, // Save the image path to the database
            ]);
    
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Section Content created successfully');
        }
    
        // If no image is uploaded, return an error message
        return redirect()->back()->with('error', 'Image upload failed. Please try again.');
    }
    

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'sectionName' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
          
        ]);

        $sectionContent = SectionContent::findOrFail($id);
        $sectionContent->update($request->all());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Section Content updated successfully');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $sectionContent = SectionContent::findOrFail($id);
        $sectionContent->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Section Content deleted successfully');
    }
}
