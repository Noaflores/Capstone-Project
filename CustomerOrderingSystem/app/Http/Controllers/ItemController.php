<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class ItemController extends Controller
{
    public function show($id)
    {
        // Find the item by primary key `id` in menu_items table
        $item = MenuItem::findOrFail($id); // throws 404 if not found

        return view('menu.item-detail', compact('item'));
    }
}
