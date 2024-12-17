<?php

namespace App\Http\Controllers;

use App\Models\PackageFeature;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageFeatureController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $features = PackageFeature::all();
        $allPackages= Package::all();
        return view('PackageFeature.PackageFeature', compact ('allPackages','features'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        // Logic for form display (not needed for APIs)
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'packageid' => 'required|exists:package,packageid',
            'description' => 'nullable|string|max:255',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('features', 'public');
        }
    
        // Create a new feature
        PackageFeature::create([
            'packageid' => $request->input('packageid'),
            'description' => $request->input('description'),
            'image' => $imagePath ?? null,
        ]);
    
        return redirect()->back()->with('success', 'Feature added successfully!');
    }
    
    
    

    
    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        // Validate the incoming request, excluding the image field
        $request->validate([
            'packageid' => 'required',
            'description' => 'nullable|string|max:255',
        ]);
    
        // Find the feature to update
        $feature = PackageFeature::findOrFail($id);
    
        // Update the feature with the new data, excluding the image field
        $feature->packageid = $request->packageid;
        $feature->description = $request->description ?: $feature->description;  // Retain old description if none provided
    
        // Save the updated feature
        $feature->save();
    
        // Return a JSON response with the updated feature and success message
        return redirect()->back()->with('success', 'Feature updated successfully!');
    }
    

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $feature = PackageFeature::findOrFail($id);
        $feature->delete();
        return redirect()->back()->with('success', 'Feature deleted successfully!');
    }
}
