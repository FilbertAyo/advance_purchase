<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
   
    public function index(Request $request)
    {
        $query = Item::orderBy('id', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('item_name', 'like', "%$search%")
                  ->orWhere('category', 'like', "%$search%")
                  ->orWhere('brand', 'like', "%$search%");
        }

        $items = $query->paginate(10);

        return view('items.item', compact('items'));
    }


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
            'sales' => 'required|numeric',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
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

    public function uploadImage(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'image_url.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each file
            'item_id' => 'required|exists:items,id', // Ensure item_id exists and is valid
        ]);

        if ($request->hasFile('image_url')) {
            foreach ($request->file('image_url') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('products'), $imageName);

                // Save each file in the database
                Product_Image::create([
                    'item_id' => $request->item_id,
                    'image_url' => 'products/' . $imageName,
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully to this Product.');
    }

    public function deleteImage($id)
    {
        $image = Product_Image::findOrFail($id);

        // Delete the image file from storage
        if (File::exists(public_path($image->image_url))) {
            File::delete(public_path($image->image_url));
        }

        // Delete the record from the database
        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::findOrFail($id);

        return view('items.view', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::findOrFail($id);

        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);

        $item->update($request->all());

        return redirect()->route('item.index')->with('success', "Item updated successfully");
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
        $category = $request->get('category');
        $query = $request->get('query');

        // Get all products (for category filtering)
        $allProducts = Item::all();

        // Filter products based on category and search query
        $products = Item::when($category, function ($queryBuilder, $category) {
            return $queryBuilder->where('category', $category);
        })
            ->when($query, function ($queryBuilder, $query) {
                return $queryBuilder->where(function ($subQuery) use ($query) {
                    $subQuery->where('item_name', 'LIKE', "%{$query}%")
                        ->orWhere('code', 'LIKE', "%{$query}%")
                        ->orWhere('brand', 'LIKE', "%{$query}%");
                });
            })
            ->get();

        return view('customer.product', compact('products', 'category', 'allProducts'));
    }
}
