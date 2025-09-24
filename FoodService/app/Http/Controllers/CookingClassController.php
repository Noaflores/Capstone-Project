<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\EventSchedule;

class CookingClassController extends Controller
{
    public function index()
    {
        // Get upcoming classes (future dates only)
        $classes = EventSchedule::where('date', '>=', now())
            ->with('experience') 
            ->orderBy('date')
            ->get();

        // Map images based on experience title
        foreach ($classes as $class) {
            $experienceTitle = $class->experience->title ?? '';

            $image = match ($experienceTitle) {
                'Meat' => 'meat.jpg',
                'Vegetable' => 'vegetable.jpg',
                'Juice' => 'juice.jpg',
                'Shake' => 'shake.jpg',
                default => 'default.jpg',
            };

            $class->experience->image = $image;
        }

        return view('cooking_classes.index', compact('classes'));
    }

    public function show($id)
{
    $class = EventSchedule::with('experience')->findOrFail($id);

    $title = $class->experience->title ?? 'Unknown';
    $chefMap = [
        'Meat' => 'Marco Ollero',
        'Vegetable' => 'Robbie Manimtim',
        'Juice' => 'Noah Flores',
        'Shake' => 'Irish Cabingue',
    ];

    $assignedChef = 'Chef Unknown';
    foreach ($chefMap as $keyword => $chef) {
        if (Str::contains($title, $keyword)) {
            $assignedChef = $chef;
            break;
        }
    }

    return view('cooking_classes.show', compact('class', 'assignedChef'));
}

}
