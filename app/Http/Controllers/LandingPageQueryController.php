<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Style;
use App\Models\User;
use App\Models\Category;

class LandingPageQueryController extends Controller
{
    public function exploreStyles()
    {
        $styleData = '';

        if(isset(auth()->user()->id)){
            $styleData = [];
            foreach(auth()->user()->style_id as $userStyle){
                $userStyleData = Style::where('id', $userStyle);
                array_push($styleData, $userStyleData);
            }
        }else{
            $styleData = Style::all();
        }

        return response()->json([
            'status' => 200,
            'data' => $styleData,
            'message' => 'Style Data Queried'
        ], 200);
    }

    public function shopCategory(Request $request)
    {
        $categoryData = '';

        if(isset(auth()->user()->id)){
            $categoryData = [];
            foreach(auth()->user()->style_id as $userStyle){
                $userCategoryData = Category::where('id', $userStyle)->skip(3)->take(4)->get();
                array_push($categoryData, $userCategoryData);
            }
        }else{
            $categoryData = Category::skip(3)->take(4)->get();
        }

        return response()->json([
            'status' => 200,
            'data' => $categoryData,
            'message' => 'Style Data Queried'
        ], 200);
    }
}
