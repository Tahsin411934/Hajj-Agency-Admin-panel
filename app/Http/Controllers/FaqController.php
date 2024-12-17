<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $faqs = Faq::all();
        return view('faq.index', compact('faqs')); // Return the view with data
    }

    // Show the form for creating a new resource.
    public function create()
    {
        // Return a view for creating an FAQ (optional)
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return back()->with('success', 'FAQ created successfully!');
    }

    // Display the specified resource.
    public function show($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return back()->with('error', 'FAQ not found');
        }

        return view('faq.show', compact('faq')); // Optional: Show individual FAQ
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        // Return a view for editing the FAQ (optional)
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq = Faq::find($id);

        if (!$faq) {
            return back()->with('error', 'FAQ not found');
        }

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return back()->with('success', 'FAQ updated successfully!');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return back()->with('error', 'FAQ not found');
        }

        $faq->delete();

        return back()->with('success', 'FAQ deleted successfully!');
    }
}
