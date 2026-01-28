<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;

class ItemController extends Controller
{
    public function show($id)
    {
        $item = MenuItem::findOrFail($id);
        return view('menu.item-detail', compact('item'));
    }
}


