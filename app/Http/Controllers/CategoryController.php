<?php

namespace App\Http\Controllers;

use App\Enum\ColorEnum;
use App\Enum\SizeEnum;
use App\Enum\StyleEnum;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubsubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function productFilter(Request $request)
    {
        $query = Product::query();

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->subcategory) {
            $query->orWhere('subcategory_id', $request->subcategory);
        }

        if ($request->subsubcategory) {
            $query->orWhere('sub_subcategory_id', $request->subsubcategory);
        }

        if ($request->brand) {
            $query->orWhere('product_brand', $request->brand);
        }

        if ($request->style) {
            $query->orWhere('style', $request->style);
        }

        if ($request->size) {
            $query->orWhereJsonContains('size', $request->size);
        }

        if ($request->color) {
            $query->orWhere('color', $request->color);
        }

        if ($request->price) {
            $query->orderBy('price', $request->price);
        }

        if ($request->sale) {
            $query->orWhere('discount', '>', 0);
        }

        if ($request->sort) {
            $query->orderBy('product_name', $request->sort);
        }

        return $query->orderBy('created_at', 'desc')->paginate(20);
    }

    public function categories()
    {
        $data = Category::where('status', 200)->get();

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function subCategories($category_id)
    {
        $data = SubCategory::where('category_id', $category_id)->get();

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function subSubCategories($subcategory_id)
    {
        $data = SubsubCategory::where('subcategory_id', $subcategory_id)->get();

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function brands()
    {
        $data = Brand::where('status', 200)->get();

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function styles()
    {
        $data = StyleEnum::values();

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function sizes()
    {
        $data = SizeEnum::values();

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function colors()
    {
        $data = ColorEnum::values();

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }
}
