<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product_Image;
use App\Models\User_Relative;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
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

        $perPage = $request->input('per_page', 10); // Default to 10 if no pagination option is selected
        $items = $query->paginate($perPage);

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
            'credit_price'=>'required|numeric',
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
            'image_url.*' => 'required|image|mimes:jpeg,png,jpg,gif', // Validate each file
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

        return redirect()->back()->with('success', "Item updated successfully");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the item by its ID
        $item = Item::findOrFail($id);
        if ($item->image && file_exists(public_path($item->image))) {
            unlink(public_path($item->image));
        }

        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully');
    }

    public function product_view($id)
    {
        $product = Item::findOrFail($id);
        $images = Product_Image::where('item_id', $id)->get();

        return view('customer.product_view', compact('product', 'images'));
    }

    public function product(Request $request)
    {
        $customerId = Auth::id();
        $relative = User_Relative::where('user_id', $customerId)->get();

        $category = $request->get('category');
        $query = $request->get('query');

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
            ->paginate(12);

        $products->onEachSide(1); // ✅ Add this here after paginate

        if ($request->ajax()) {
            return view('customer.partials.product_list', compact('products'))->render();
        }

        return view('customer.product', compact('products', 'category', 'relative'));
    }



    public function catalogue(Request $request){

         $category = $request->get('category');
        $query = $request->get('query');

        $products = Item::when($category, function ($queryBuilder, $category) {
                return $queryBuilder->where('category', $category);
            })
            ->when($query, function ($queryBuilder, $query) {
                return $queryBuilder->where(function ($subQuery) use ($query) {
                    $subQuery->where('item_name', 'LIKE', "%{$query}%")
                             ->orWhere('code', 'LIKE', "%{$query}%")
                             ->orWhere('brand', 'LIKE', "%{$query}%");
                });
            })->orderBy('created_at', 'desc')
            ->get();

        return view('catalogue.index',compact('products',));
    }


}
