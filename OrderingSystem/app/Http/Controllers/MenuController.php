<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\MenuItem;


class MenuController extends Controller
{
    // show the create form
    public function create()
    {
        return view('manager.create-menu');
    }

    // handle POST /menu/store
    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id' => 'nullable|string|unique:menu_items,item_id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // if no item_id was provided, generate one automatically (like M001, M002…)
        if (empty($data['item_id'])) {
            $lastItem = DB::table('menu_items')->orderBy('created_at', 'desc')->first();
            $nextNumber = $lastItem ? ((int) filter_var($lastItem->item_id, FILTER_SANITIZE_NUMBER_INT) + 1) : 1;
            $data['item_id'] = 'M' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        }

        // handle image upload
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menu_images', 'public');
        }

        // insert into DB
        DB::table('menu_items')->insert([
            'item_id'     => $data['item_id'],
            'name'        => $data['name'],
            'price'       => $data['price'],
            'description' => $data['description'] ?? null,
            'image'       => $path,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('menu.edit')->with('success', 'Menu item created.');
    }

   // 1. Show the list of all menu items (edit-menu.blade.php)
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

// 2. Show the edit form for one item (menu/edit.blade.php)
public function editItem($id)
{
    $item = MenuItem::findOrFail($id);
    return view('menu.edit', compact('item'));
}

// 3. Handle updating one item
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
    ]);

    $item = MenuItem::findOrFail($id);
    $item->update($request->only(['name', 'price', 'description']));

    return redirect()->route('menu.edit')->with('success', 'Menu item updated successfully.');
}


    public function destroy($item_id)
{
    // Check if the item is referenced in order_items
    $exists = DB::table('order_items')->where('item_id', $item_id)->exists();

    if ($exists) {
        return redirect()->route('menu.edit')
            ->with('error', 'This item cannot be deleted because it is already used in an order.');
    }

    DB::table('menu_items')->where('item_id', $item_id)->delete();

    return redirect()->route('menu.edit')->with('success', 'Menu item deleted successfully.');
}


}
