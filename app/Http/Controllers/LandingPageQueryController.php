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
use Laravel\Sanctum\PersonalAccessToken;

class LandingPageQueryController extends Controller
{
    public function exploreStyles(Request $request)
    {
        $token = $request->bearerToken();
        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);
            if ($accessToken && $accessToken->tokenable) {
                auth()->setUser($accessToken->tokenable);
            }
        }

        $styleData = '';

        if(auth()->check()){
            $styleData = [];
            $userStyles = json_decode(auth()->user()->style_id, true);
            $userStyleData = Style::whereIn('id', $userStyles)->get();
            array_push($styleData, $userStyleData);
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
        $token = $request->bearerToken();
        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);
            if ($accessToken && $accessToken->tokenable) {
                auth()->setUser($accessToken->tokenable);
            }
        }

        $categoryData = '';

        if(auth()->check()){
            $categoryData = [];
            $userCategories = json_decode(auth()->user()->category_id, true);
            $userCategoryData = Category::whereIn('id', $userCategories)->get();
            array_push($categoryData, $userCategoryData);
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
        $now = Carbon::now();

        $data = Product::whereBetween('created_at', [$oneWeekAgo, $now])
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
                            ->get();

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }
}
