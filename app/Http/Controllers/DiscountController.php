<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiscountController extends Controller
{
    public function getDiscount($product_id)
    {
        try{
            $data = Discount::where('product_id', $product_id)->get();
            if($data->isEmpty()){
                return response()->json([
                    'status'=> 204,
                    'message' => 'No discount.'
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error('Failed getting discount on user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while getting discount'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function addDiscount(Request $request)
    {
        try{
            $data = Discount::create([
                'product_id' => $request->product_id,
                'name' => $request->name,
                'quantity_applicable' => $request->quantity_applicable,
                'symbol' => $request->symbol,
                'value' => $request->value,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 403,
                'message'=> 'Validation failed. Please check input ' 
            ], 403);
        }catch(\Throwable $th){
            Log::error('Failed adding discount on user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while adding discount'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 201);
    }

    public function editDiscount(Request $request, Discount $discount)
    {
        try{
            $discount->update([
                'product_id' => $request->product_id,
                'name' => $request->name,
                'quantity_applicable' => $request->quantity_applicable,
                'symbol' => $request->symbol,
                'value' => $request->value,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 403,
                'message'=> 'Validation failed. Please check input ' 
            ], 403);
        }catch(\Throwable $th){
            Log::error('Failed editing discount on user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while editing discount'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $discount
        ], 200);
    }
}
