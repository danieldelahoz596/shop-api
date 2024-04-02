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
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('images', $filename, 'public');

            $imageModel = new Image();
            $imageModel->filename = $filename;
            $imageModel->path = $path;
            $product->images()->save($imageModel); // Assuming a one-to-many relationship

            return response()->json(['message' => 'Image uploaded successfully!', 'image' => $imageModel]);
        }

        return response()->json(['message' => 'No image was uploaded.'], 400);
    }

    public function deleteImage($productId, $imageId)
    {
        $image = Image::where('product_id', $productId)->findOrFail($imageId);
        Storage::delete('public/' . $image->path);
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully!']);
    }
}