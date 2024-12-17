<?php

namespace App\Http\Controllers;

use App\Models\PackageInclusionExclusion;
use Illuminate\Http\Request;

class PackageInclusionExclusionController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $packageInclusionExclusions = PackageInclusionExclusion::all();
        return view('packageInclusionExclusion.index', compact('packageInclusionExclusions'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        // This is for returning a view with the form (if needed)
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:Inclusion,Exclusion',
            'description' => 'nullable|string',
        ]);

        $packageInclusionExclusion = PackageInclusionExclusion::create($request->all());
        return redirect()->back()->with('success', 'Package Inclusion/Exclusion added successfully!');
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|in:Inclusion,Exclusion',
            'description' => 'nullable|string',
        ]);

        $packageInclusionExclusion = PackageInclusionExclusion::findOrFail($id);
        $packageInclusionExclusion->update($request->all());
        return redirect()->back()->with('success', 'Package Inclusion/Exclusion updated successfully!');
    }

    // Delete the specified resource from storage
    public function destroy($id)
    {
        $packageInclusionExclusion = PackageInclusionExclusion::findOrFail($id);
        $packageInclusionExclusion->delete();
        return redirect()->back()->with('success', 'Package Inclusion/Exclusion deleted successfully!');
    }
}
