<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use App\Models\MenuSubcategory;
use App\Models\MenuItem;
use App\Models\SubCategory;

class MenuController extends Controller
{
    // --------------------------
    // PART 1 — Show all categories
    // Route: /menu
    // --------------------------
    public function index()
    {
        $categories = MenuCategory::all();
        return view('menu.index', compact('categories'));
    }

    // --------------------------
    // PART 2 — Show subcategories of a category
    // Route: /menu/category/{id}
    // --------------------------
    public function showCategory($id)
    {
        $category = MenuCategory::findOrFail($id);
        $subcategories = MenuSubcategory::where('category_id', $id)->get();

        return view('menu.category_show', compact('category', 'subcategories'));
    }

    // --------------------------
    // PART 3 — Show items of a subcategory
    // Route: /menu/subcategory/{id}
    // --------------------------
   public function showSubcategory($id)
{
    $subcategory = MenuSubcategory::findOrFail($id);

    $items = MenuItem::where('sub_category_id', $subcategory->id)
                     ->where('is_available', 1)
                     ->get();

    return view('menu.subcategory_show', compact('subcategory', 'items'));
}



    // --------------------------
    // PART 4 — Show single item details
    // Route: /item/{id}
    // --------------------------
    public function showItem($id)
    {
        $item = MenuItem::findOrFail($id);
        return view('menu.item_show', compact('item'));
    }
}
