<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Item::orderBy('id', 'desc')->get();

        return view('items.item', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cost' => 'required|numeric',
            'sales' => 'required|numeric',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'expire_date' => 'nullable|date',
            'created_by' => 'required|string|max:255',
        ]);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $speakerName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('products'), $speakerName);
            $validated['image'] = 'products/' . $speakerName;
        }

        Item::create($validated);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'New item added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::findOrFail($id);

        return view('items.view',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::findOrFail($id);

        return view('items.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item= Item::findOrFail($id);

        $item->update($request->all());

        return redirect()->route('item.index')->with('success',"Item updated successfully");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the item by its ID
        $item = Item::findOrFail($id);

        // Check if the item has an image and if the image file exists
        if ($item->image && file_exists(public_path($item->image))) {
            // Delete the image file from the public directory
            unlink(public_path($item->image));
        }

        // Delete the item from the database
        $item->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Item deleted successfully');
    }

    public function product(Request $request)
    {
        $category = $request->get('category'); // Get the category from the request
        $products = Item::when($category, function ($query, $category) {
            return $query->where('category', $category); // Filter by category if provided
        })->get();

        return view('customer.product', compact('products', 'category'));
    }


}
