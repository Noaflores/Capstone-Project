<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\MenuItem;
use App\Models\SubCategory;

class MenuController extends Controller
{
    // Show create form
    public function create()
{
    $subCategories = SubCategory::all();

    return view('manager.create-menu', compact('subCategories'));
}


    // Store new menu item
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'sub_category_id' => 'required|integer|min:1',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('menu_images', 'public');
        }

        MenuItem::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image_path'  => $imagePath,
            'is_available'=> true,
        ]);

        return redirect()
            ->route('menu.manage')
            ->with('success', 'Menu item created successfully!');
    }

    // Show all menu items
    public function index()
    {
        $menuItems = MenuItem::all();
        return view('manager.edit-menu', compact('menuItems'));
    }

    // Show edit form
    public function editItem($id)
    {
        $item = MenuItem::findOrFail($id);
        return view('menu.edit', compact('item'));
    }

    // Update menu item
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $item = MenuItem::findOrFail($id);

        // Replace image if uploaded
        if ($request->hasFile('image')) {

            if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
                Storage::disk('public')->delete($item->image_path);
            }

            $item->image_path = $request->file('image')
                ->store('menu_images', 'public');
        }

        $item->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'image_path'  => $item->image_path,
        ]);

        return redirect()
            ->route('menu.manage')
            ->with('success', 'Menu item updated successfully.');
    }

    // Delete menu item
    public function destroy($id)
    {
        $exists = DB::table('order_items')
            ->where('menu_item_id', $id)
            ->exists();

        if ($exists) {
            return redirect()
                ->route('menu.manage')
                ->with('error', 'This item cannot be deleted because it is already used in an order.');
        }

        $item = MenuItem::findOrFail($id);

        if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()
            ->route('menu.manage')
            ->with('success', 'Menu item deleted successfully.');
    }
}
