<?php

namespace App\Http\Controllers;

use App\Models\MakeOffer;
use Illuminate\Http\Request;

class MakeOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($product_id)
    {
        $data = MakeOffer::with('product')->where('product_id', $product_id)->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $offer = MakeOffer::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'amount' => $request->amount
        ]);

        return response()->json([
            'status' => true,
            'data' => $offer
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MakeOffer $makeOffer)
    {
        $makeOffer->update([
            'amount' => $request->amount
        ]);

        return response()->json([
            'status' => true,
            'data' => $makeOffer
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MakeOffer $makeOffer)
    {
        $makeOffer->delete();

        return response()->json([
            'status' => true,
            'message' => 'Offer Successfully Deleted'
        ]);
    }
}
