<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Style;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OnboardingController extends Controller
{
    public function onboardStyles(Request $request)
    {
        // request data should be like this [1,2,3,4] if you insert it on the database

        try{
            $user = User::findOrFail(auth()->user()->id);
            $user->update([
                'style_id' => $request->styles // [1,2,3]
            ]);
        }catch(\Throwable $th){
            Log::error('Something went wrong on updating onboardStyles: ' . $th->getMessage() );
            return response()->json([
                'status'=>500,
                'message'=>'An error occurred on updating onboardStyles'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $user
        ], 200);
    }

    public function onboardCategories(Request $request)
    {
        // request data should be like this [1,2,3,4] if you insert it on the database

        try{
            $user = User::findOrFail(auth()->user()->id);
            $user->update([
                'category_id' => $request->categories // [1,2,3]
            ]);
        }catch(\Throwable $th){
            Log::error('Something went wrong on updating onboardCategories: ' . $th->getMessage() );
            return response()->json([
                'status'=>500,
                'message'=>'An error occurred on updating onboardCategories'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }

    public function onboardItems(Request $request)
    {
        // request data should be like this [1,2,3,4] if you insert it on the database

        try{
            $user = User::findOrFail(auth()->user()->id);

            $user->update([
                'item_id' => $request->items // [1,2,3]
            ]);
        }catch(\Throwable $th){
            Log::error('Something went wrong on updating onboardItems: ' . $th->getMessage() );
            return response()->json([
                'status'=>500,
                'message'=>'An error occurred on updating onboardItems'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }

    public function fetchAllStyles()
    {
        try{
            $data = Style::all();
        }catch(\Throwable $th){
            Log::error('Failed to fetch all style due to server error: ' . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'Failed to fetch all styles.'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function fetchAllCategories()
    {

        try{
            $data = Category::all();
        }catch(\Throwable $th){
            Log::error('Failed to fetch all categories due to server error: ' . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'Failed to fetch all categories.'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function fetchAllItems()
    {
        try{
            $data = SubCategory::all();
        }catch(\Throwable $th){
            Log::error('Failed to fetch all items due to server error: ' . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'Failed to fetch all items.'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
}
