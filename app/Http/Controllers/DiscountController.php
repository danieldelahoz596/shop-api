<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function getDiscount($product_id)
    {
        $data = Discount::where('product_id', $product_id)->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function addDiscount(Request $request)
    {
        $data = Discount::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'quantity_applicable' => $request->quantity_applicable,
            'symbol' => $request->symbol,
            'value' => $request->value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json([
            'status' => true,
            'data' => $data
        ], 201);
    }

    public function editDiscount(Request $request, Discount $discount)
    {
        $discount->update([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'quantity_applicable' => $request->quantity_applicable,
            'symbol' => $request->symbol,
            'value' => $request->value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json([
            'status' => true,
            'data' => $discount
        ], 200);
    }
}
