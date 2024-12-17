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
            'image' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:255',
        ]);

        $package = Package::create($validatedData);
        return back()->with('success', 'Package created successfully!');
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    { 
        $validatedData = $request->validate([
            'packageName' => 'required|string|max:255',
            'price' => 'required|numeric',
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
