<?php

namespace App\Http\Controllers;

use App\Mail\SendOfferMail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Measurement;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProductListingPageController extends Controller
{
    public function addProduct(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_code' => 'required|string',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'status' => 'required|boolean',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = strtolower(str_replace(' ', '-', $request->product_name));
        $tags = explode(', ', $request->tags ?? '');

        $product = Product::create([
            'category_id' => $validated['category_id'],
            'product_code' => $validated['product_code'],
            'subcategory_id' => $validated['subcategory_id'],
            'quantity' => $validated['quantity'],
            'status' => $validated['status'],
            'user_id' => Auth::id(),
            'product_name' => $validated['product_name'],
            'product_description' => $validated['product_description'],
            'price' => $validated['price'],
            'slug' => $slug,
            'keyword' => $tags,

        ]);

        if ($request->filled(['chest', 'shoulders', 'sleeve_length', 'length', 'hem'])) {
            Measurement::create([
                'product_id' => $product->id,
                'chest' => $request->chest,
                'shoulders' => $request->shoulders,
                'sleeve_length' => $request->sleeve_length,
                'length' => $request->length,
                'hem' => $request->hem,
            ]);
        }


        if ($request->hasfile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $filename = $product->id . '_' . $product->slug . '_' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images/' . $product->user_id, $filename, 'public');
                $fullpath = Storage::url($path);

                Image::create([
                    'product_id' => $product->id,
                    'filename' => $filename,
                    'path' => $fullpath
                ]);
            }
        }

        return response()->json([
            'message' => 'Product added successfully',
            'product' => $product->load(['images', 'measurements']),
        ], 201);
    }

    public function editProduct(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);


        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_code' => 'required|string',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'status' => 'required|boolean',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->update($validated);



        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product
        ]);
    }

    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);


        $product->delete();

        return response()->json(['message' => 'Product deleted successfully!']);
    }

    public function listProducts()
    {
        $products = Product::with('user')
            ->orderBy('user_id')
            ->get();

        return response()->json($products);
    }

    public function addMeasurements(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);


        $validatedData = $request->validate([
            'chest' => 'required|numeric',
            'shoulders' => 'required|numeric',
            'sleeve_length' => 'required|numeric',
            'length' => 'required|numeric',
            'hem' => 'required|numeric',
            'measurement_unit' => 'required|string',
        ]);


        $measurement = $product->measurements()->updateOrCreate(
            ['product_id' => $productId],
            $validatedData
        );

        return response()->json(['message' => 'Measurements added/updated successfully!', 'measurements' => $measurement]);
    }

    public function addShippingDetails(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $validatedData = $request->validate([
            'weight' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'depth' => 'required|numeric',
            'shipping_type' => 'required|string',
            //this is initial validation
        ]);

        $shippingDetails = $product->shipping()->updateOrCreate(
            ['product_id' => $productId],
            $validatedData
        );

        return response()->json(['message' => 'Shipping details added/updated successfully!', 'shippingDetails' => $shippingDetails]);
    }

    public function manageListing(Request $request, $productId)
    {
        $product = Product::with('likers')->findOrFail($productId);
        $user = auth()->user();

        if ($product->user_id !== $user->id) {
            return response()->json([
                'status' => false,
                'message' => "Unauthorized"
            ], 403);
        }

        if ($request->has('send_offers') && $request->get('send_offers')) {
            $this->sendOffers($product);
            $data = "Offers sent!";
        }

        if ($request->has('mark_as_sold')) {
            $data = $product->markAsSold();
        }

        return response()->json([
            'status' => true,
            'message' => "Listing managed successfully",
            'data' => $data
        ], 200);
    }



    //Helpers
    protected function sendOffers(Product $product)
    {
        $likes = $product->likers;

        //Todo: Run php artisan
        foreach ($likes as $liker) {
            Mail::to($liker->email)->send(new SendOfferMail($product));
        }
    }
}
