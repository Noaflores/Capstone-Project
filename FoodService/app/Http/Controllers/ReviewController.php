<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;


class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
        ]);

        Review::create($request->all());

        return redirect()->back()->with('success', 'Review submitted!');
    }
}
