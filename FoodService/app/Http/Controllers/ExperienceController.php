<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $experiences = Experience::latest()->take(5)->get();

        return view('home', compact('categories', 'experiences'));
    }

    public function tours()
    {
        $tours = Experience::whereHas('category', function ($q) {
            $q->where('name', 'Meat');
        })->get();

        return view('tours', compact('tours'));
    }

    public function cookingClasses()
    {
        $classes = Experience::whereHas('category', function ($q) {
            $q->whereIn('name', ['Vegetable', 'Shake', 'Juice']); 
        })->get();

        return view('cooking-classes', ['classes' => $classes]);
    }

    public function categories()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function show($id)
    {
        $experience = Experience::with('category')->findOrFail($id);
        return view('experience-show', compact('experience'));
    }
}
