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
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function productFilter(Request $request)
    {
        try {
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
        } catch (\Throwable $th) {
            Log::error("Failed something went wrong on filtering product: " . $th->getMessage());
        }
    }
    public function categories()
    {
        try{
            $data = Category::where('status', 1)->get();
            if($data->isEmpty()){
                return response()->json([
                    'status'=> 204,
                    'message'=> 'No data.'
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error("Failed getting the categories data: " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred getting the categories'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function subCategories($category_id)
    {
        try{
            $data = SubCategory::where('category_id', $category_id)->get();
            if($data->isEmpty()){
                return response()->json([
                    'status'=> 204,
                    'message'=> 'No data.'
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error("Failed getting the sub-categories data: " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred getting the sub-categories'
            ], 500);
        }


        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function subSubCategories($subcategory_id)
    {
        try{
            $data = SubsubCategory::where('subcategory_id', $subcategory_id)->get();
            if($data->isEmpty()){
                return response()->json([
                    'status'=> 204,
                    'message'=> 'No data.'
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error("Failed getting the sub-subcategories data: " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred getting the sub-subcategories'
            ], 500);
        }


        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function brands()
    {
        try{
            $data = Brand::where('status', 1)->get();
            if($data->isEmpty()){
                return response()->json([
                    'status'=> 204,
                    'message'=> 'No data.'
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error("Failed getting the brands data: " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred getting the brands'
            ], 500);
        }


        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function styles()
    {
        try{
            $data = StyleEnum::values();
            if(!$data){
                return response()->json([
                    'status'=> 204,
                    'message'=> 'No data.'
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error("Failed getting the style data: " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred getting the style'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function sizes()
    {
        try{
            $data = SizeEnum::values();
            if(!$data){
                return response()->json([
                    'status'=> 204,
                    'message'=> 'No data.'
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error("Failed getting the sizes data: " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred getting the sizes'
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function colors()
    {
        try{
            $data = ColorEnum::values();
            if(!$data){
                return response()->json([
                    'status'=> 204,
                    'message'=> 'No data.'
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error("Failed getting the colors data: " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred getting the colors'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }
}
