<?php

namespace App\Http\Controllers;

use App\Models\ChefUser; // Assuming your chefs are stored in ChefUser model
use Illuminate\Http\Request;

class ChefController extends Controller
{
    // Show all chefs
    public function index()
    {
        $chefs = ChefUser::all();

$imagesMap = [
    'Irish Cabingue' => 'chef1.jpg',
    'Marco Ollero' => 'chef2.jpg',
    'Robbie Manimtim' => 'chef3.jpg',
    'Noah Flores' => 'chef4.jpg',
];


foreach ($chefs as $chef) {
    $chef->image = $imagesMap[$chef->name] ?? 'default.jpg';
}

return view('chefs.index', compact('chefs'));

    }

    // Show single chef profile
    public function show($id)
{
    $chef = ChefUser::findOrFail($id);

    // Add image mapping here as well
    $imagesMap = [
        'Irish Cabingue' => 'chef1.jpg',
        'Marco Ollero' => 'chef2.jpg',
        'Robbie Manimtim' => 'chef3.jpg',
        'Noah Flores' => 'chef4.jpg',
    ];

    $chef->image = $imagesMap[$chef->name] ?? 'default.jpg';

    return view('chefs.show', compact('chef'));
}

}
