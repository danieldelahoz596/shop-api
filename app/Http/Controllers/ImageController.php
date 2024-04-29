<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadImage(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if ($request->hasFile('image')) {
            $images = $request->file('image');

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

        return response()->json(['message' => 'Image uploaded successfully!']);
    }

    public function deleteImage($productId, $imageId)
    {
        $image = Image::where('product_id', $productId)->findOrFail($imageId);
        Storage::delete('public/' . $image->path);
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully!']);
    }
}
