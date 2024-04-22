<?php

namespace App\Http\Controllers;

use App\Models\MakeOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class MakeOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($product_id)
    {
        try{
            $data = MakeOffer::with('product')
            ->where('product_id', $product_id)
            ->where('user_id', auth()->user()->id)
            ->get();
            if($data->isEmpty()){
                return response()->json([
                    'status'=> 204,
                    'message'=> 'No offer for this product'
                ], 200);
            }
        }catch(\Throwable $th){
            Log::error('Failed to get make offer for this product_id ' . $product_id . ": " . $th->getMessage());
            return response()->json([
                'status'=>500,
                'message'=> 'An error occurred getting make offer'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $offer = MakeOffer::create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
                'amount' => $request->amount
            ]);
        } catch(\Throwable $th){
            Log::error('Failed to create make offer for user_id ' . auth()->id() . ': ' . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=> 'An error occurred creating make offer '
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $offer
        ], 200);
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
        try{
            $makeOffer->update([
                'amount' => $request->amount
            ]);

        } catch(\Exception $e){
            return response()->json([
                'status' => 403,
                'message'=> 'Validation failed. Please check input ' 
            ], 403);
        }catch(\Throwable $th){
            Log::error('Failed to update make offer for user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=> 'An error occurred updating make offer'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $makeOffer
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MakeOffer $makeOffer)
    {
        try{
            $makeOffer->delete();
        } catch(\Throwable $th){
            Log::error('Failed deleting make offer on user_id ' . auth()->id() . ': ' . $th->getMessage() );
            return response()->json([
                'status'=> 500,
                'message'=> 'An error occurred while deleting make offer'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Offer Successfully Deleted'
        ], 200);
    }
}
