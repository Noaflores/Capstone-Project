<?php

namespace App\Http\Controllers;

 
use Illuminate\Http\Request;
use App\Models\MenuCategory; // Ensure you have a Model for the table
use App\Models\MenuItem; 
use App\Models\SubCategory;


class MenuController extends Controller
{
    public function index()
    {
        // Fetch all categories from the menu_categories table
        $categories = MenuCategory::all();

        // Pass the data to your blade file
        return view('menu.index', compact('categories'));
    }

   public function show($id)
{
    // Fetch the sub-category
    $category = SubCategory::findOrFail($id);

    // Fetch items belonging to this sub-category
    $items = MenuItem::where('sub_category_id', $id)->get();

    return view('category-show', compact('category', 'items'));
}

public function showItem($id) {
        $item = Item::findOrFail($id);
        return view('menu.item-detail', compact('item'));
    }
}