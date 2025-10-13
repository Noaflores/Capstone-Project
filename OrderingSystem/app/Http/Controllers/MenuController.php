<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\MenuItem;

class MenuController extends Controller
{
    // Show the create form
    public function create()
    {
        return view('manager.create-menu');
    }

    // Handle POST /menu/store
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|max:2048',
    ]);

    // ✅ Get latest item based on the numeric part of item_id (e.g., IID1008)
    $latestItem = MenuItem::orderByDesc('item_id')->first();

    if ($latestItem) {
        // Extract numeric portion from item_id (e.g., from "IID1008" → 1008)
        $lastNumber = (int) preg_replace('/\D/', '', $latestItem->item_id);
        $nextNumber = $lastNumber + 1;
    } else {
        $nextNumber = 1001; // starting point if no records yet
    }

    // ✅ Build new item ID
    $itemId = 'IID' . $nextNumber;

    // ✅ Handle file upload (optional)
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('menu_images', 'public');
    }

    // ✅ Create new menu record
    MenuItem::create([
        'item_id' => $itemId,
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image' => $imagePath,
    ]);

    return redirect()->route('menu.edit')->with('success', 'Menu item created successfully!');
}


    // Show all menu items (manager/edit-menu.blade.php)
    public function edit()
    {
        $menuItems = MenuItem::all(); 
        return view('manager.edit-menu', compact('menuItems'));
    }

    public function index()
    {
        $menuItems = MenuItem::all();
        return view('manager.edit-menu', compact('menuItems'));
    }

    // Show the edit form for one item
    public function editItem($id)
    {
        $item = MenuItem::findOrFail($id);
        return view('menu.edit', compact('item'));
    }

    // Handle updating one item
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $item = MenuItem::findOrFail($id);

    // ✅ If a new image is uploaded, store it
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($item->image && \Storage::disk('public')->exists($item->image)) {
            \Storage::disk('public')->delete($item->image);
        }

        // Store the new one
        $imagePath = $request->file('image')->store('menu_images', 'public');
        $item->image = $imagePath;
    }

    // ✅ Update text fields
    $item->update([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'image' => $item->image,
    ]);

    return redirect()->route('menu.edit')->with('success', 'Menu item updated successfully.');
}


    // Handle deleting an item
    public function destroy($item_id)
    {
        // Check if item is used in order_items
        $exists = DB::table('order_items')->where('item_id', $item_id)->exists();

        if ($exists) {
            return redirect()->route('menu.edit')
                ->with('error', 'This item cannot be deleted because it is already used in an order.');
        }

        DB::table('menu_items')->where('item_id', $item_id)->delete();

        return redirect()->route('menu.edit')
            ->with('success', 'Menu item deleted successfully.');
    }
}
