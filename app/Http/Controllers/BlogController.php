<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Display all blog posts
    public function index()
    {
        $blogs = Blog::all();
        return view('blog.index', compact('blogs'));
    }

   
// Store a new blog post
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'shortdescription' => 'nullable|string|max:255',
        'details' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
    ]);

    $data = $request->only(['title', 'shortdescription', 'details']);

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('blog_images', 'public');
        $data['image'] = $imagePath;
    }

    Blog::create($data);

    return redirect()->back()->with('success', 'Blog created successfully!');
}

// Update a blog post
public function update(Request $request, $id)
{
    $blog = Blog::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'shortdescription' => 'nullable|string|max:255',
        'details' => 'required|string',
       
    ]);

    $data = $request->only(['title', 'shortdescription', 'details']);

    // Handle image upload if a new file is provided
   

    $blog->update($data);

    return redirect()->back()->with('success', 'Blog updated successfully!');
}

// Delete a blog post
public function destroy($id)
{
    $blog = Blog::findOrFail($id);

    // Delete the image file if it exists
    if ($blog->image && file_exists(storage_path('app/public/' . $blog->image))) {
        unlink(storage_path('app/public/' . $blog->image));
    }

    $blog->delete();

    return redirect()->back()->with('success', 'Blog deleted successfully!');
}
}