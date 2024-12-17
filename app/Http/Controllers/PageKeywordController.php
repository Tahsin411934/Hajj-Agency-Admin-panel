<?php

namespace App\Http\Controllers;

use App\Models\PageKeyword;
use Illuminate\Http\Request;

class PageKeywordController extends Controller
{
    // Store a new page keyword
    public function store(Request $request)
    {
        $request->validate([
            'sectionname' => 'required|string|max:255',
            'keywords' => 'required|string',
        ]);

        $pageKeyword = PageKeyword::create($request->all());

        return back()->with('success', 'Page keyword added successfully!');
    }

    // Get all page keywords
    public function index()
    {
        $pagekeywords = PageKeyword::all();
        return view('pagekeywords.index', compact('pagekeywords'));
    }

// Update a page keyword
public function update(Request $request, $id)
{
    $request->validate([
        'sectionname' => 'required|string|max:255',
        'keywords' => 'required|string',
    ]);

    $pageKeyword = PageKeyword::findOrFail($id);
    $pageKeyword->update($request->all());

    // Flash success message and redirect back
    return back()->with('success', 'Page keyword updated successfully!');
}

// Delete a page keyword
public function destroy($id)
{
    $pageKeyword = PageKeyword::findOrFail($id);
    $pageKeyword->delete();

    // Flash success message and redirect back
    return back()->with('success', 'Page keyword deleted successfully!');
}
}
