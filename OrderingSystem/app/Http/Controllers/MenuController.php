<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MenuItem;
use App\Models\SubCategory;

class MenuController extends Controller
{
    // Show create form
    public function create()
    {
        $subCategories = SubCategory::all();
        $existingSubCategoryIds = $subCategories->pluck('id')->toArray(); // get all existing sub-category IDs
        return view('manager.create-menu', compact('subCategories', 'existingSubCategoryIds'));
    }

    // Store new menu item
    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'sub_category_id'  => 'required|integer|min:1000|max:9999|unique:sub_categories,id',
            'description'      => 'required|string',
            'price'            => 'required|numeric|min:0',
            'image'            => 'nullable|image|max:2048',
            'item_type'        => 'required|string|in:Appetizers,Main Courses,Desserts,Snacks,Side Dishes,Beverages',
        ], [
            'sub_category_id.unique' => 'This Sub Category ID already exists. Please enter a different one.'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        MenuItem::create([
            'name'             => $request->name,
            'sub_category_id'  => $request->sub_category_id,
            'description'      => $request->description,
            'price'            => $request->price,
            'image_path'       => $imagePath,
            'is_available'     => true,
            'item_type'        => $request->item_type,
        ]);

        return redirect()->route('menu.manage')
                         ->with('success', 'Menu item created successfully!');
    }

    public function checkSubCategory($id)
    {
        $exists = SubCategory::where('id', $id)->exists();
        return response()->json(['exists' => $exists]);
    }

    // Show all menu items (for edit/manage page) with filtering & pagination
    public function index(Request $request)
    {
        $query = MenuItem::query();

        // Filter by type if selected
        $categories = ['Appetizers','Main Courses','Desserts','Snacks','Side Dishes','Beverages'];
        if ($request->filled('type') && in_array($request->type, $categories)) {
            $query->where('item_type', $request->type);
        }

        // Filter by search keyword if entered
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Pagination: 10 items per page
        $menuItems = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('manager.edit-menu', compact('menuItems', 'categories'));
    }

    // Show edit form
    public function editItem($id)
    {
        $item = MenuItem::findOrFail($id);
        $subCategories = SubCategory::all();
        return view('menu.edit', compact('item', 'subCategories'));
    }

    // Update menu item
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sub_category_id' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'item_type' => 'required|string|in:Appetizers,Main Courses,Desserts,Snacks,Side Dishes,Beverages',
        ]);

        $item = MenuItem::findOrFail($id);

        // Image handling
        if ($request->hasFile('image')) {
            if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
                Storage::disk('public')->delete($item->image_path);
            }
            $item->image_path = $request->file('image')->store('menu_images', 'public');
        }

        $item->update([
            'name' => $request->name,
            'sub_category_id' => $request->sub_category_id,
            'price' => $request->price,
            'description' => $request->description,
            'item_type' => $request->item_type,
            'image_path' => $item->image_path,
        ]);

        return redirect()->route('menu.manage')
                         ->with('success', 'Menu item updated successfully.');
    }

    // Delete menu item
    public function destroy($id)
    {
        $item = MenuItem::withCount('orderItems')->findOrFail($id);

        if ($item->order_items_count > 0) {
            return redirect()->route('menu.manage')
                ->with('error', 'This item cannot be deleted because it is already used in an order.');
        }

        if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()->route('menu.manage')->with('success', 'Menu item deleted successfully.');
    }
}
