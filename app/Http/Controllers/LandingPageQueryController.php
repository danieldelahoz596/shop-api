<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Style;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\SellerShop;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
            'message' => 'Category Data Queried'
        ], 200);
    }

    public function getNewArrivals() {
        $oneWeekAgo = Carbon::now()->subWeek();

        $data = Product::where('created_at', '>=', $oneWeekAgo)
                        ->where('created_at', '<=', Carbon::now())
                        ->with('user')
                        ->take(4)
                        ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'New Arrival Data Queried'
        ], 200);
    }

    public function getOurPicks() {
        $oneWeekAgo = Carbon::now()->subWeek();

        $data = Product::inRandomOrder()
                        ->with('user')
                        ->take(4)
                        ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'Our Picks Data Queried'
        ], 200);
    }

    public function getPopularItem() {
        $oneWeekAgo = Carbon::now()->subWeek();

        $data = Product::where('view_count', '>=', 100)
                        ->inRandomOrder()
                        ->with('user')
                        ->take(4)
                        ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'Popular Items Data Queried'
        ], 200);
    }

    public function getMoreItemsForYou() {

        $data = Product::inRandomOrder()
                        ->with('user')
                        ->take(8)
                        ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }

    public function shopSpotlight() {

        $data = SellerShop::orderBy('rating', 'desc')
                            ->take(4)
                            ->with('user')
                            ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }

    public function shopsToWatch(){
        $data = SellerShop::where('rating', '>=', 100)
                            ->orderBy('rating', 'asc')
                            ->take(4)
                            ->with('user')
                            ->with('shop')
                            ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }
}
