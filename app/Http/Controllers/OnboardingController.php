<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Style;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function onboardStyles(Request $request)
    {
        // request data should be like this [1,2,3,4] if you insert it on the database

        $user = User::findOrFail(auth()->user()->id);

        $user->update([
            'style_id' => $request->styles // [1,2,3]
        ]);

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }

    public function onboardCategories(Request $request)
    {
        // request data should be like this [1,2,3,4] if you insert it on the database

        $user = User::findOrFail(auth()->user()->id);

        $user->update([
            'category_id' => $request->categories // [1,2,3]
        ]);

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }

    public function onboardItems(Request $request)
    {
        // request data should be like this [1,2,3,4] if you insert it on the database

        $user = User::findOrFail(auth()->user()->id);

        $user->update([
            'item_id' => $request->items // [1,2,3]
        ]);

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }

    public function fetchAllStyles()
    {
        $data = Style::all();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function fetchAllCategories()
    {
        $data = Category::all();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function fetchAllItems()
    {
        $data = SubCategory::all();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
}
