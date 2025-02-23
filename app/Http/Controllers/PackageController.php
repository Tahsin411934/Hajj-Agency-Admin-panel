<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::all();
        return view('package.package', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'packageName' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'keywords' => 'nullable|string|max:255',
        ]);
    
        if ($request->hasFile('image')) {
            // Store the image and get its path
            $imagePath = $request->file('image')->store('package', 'public');
            $validatedData['image'] = $imagePath; // Add the image path to the validated data
        }
    
        // Create the package with all validated data
        Package::create($validatedData);
    
        return back()->with('success', 'Package created successfully!');
    }
    

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {  
        $validatedData = $request->validate([
            'packageName' => 'required|string|max:255',
            'price' => 'required|string',
            'image' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:255',
        ]);

        $package->update($validatedData);
        return back()->with('success', 'Package updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return back()->with('success', 'Package deleted successfully!');
    }
}
