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
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

use function PHPSTORM_META\map;

class LandingPageQueryController extends Controller
{
    //Get the products if user pick styles or not
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
        try{
            if(auth()->check()){
                $styleData = [];
                $userStyles = json_decode(auth()->user()->style_id, true);
                if($userStyles !== null){
                    try{
                        $userStyleData = Style::whereIn('id', $userStyles)->get();
                        array_push($styleData, $userStyleData);
                    } catch (\Throwable $th){
                        Log::error("Failed to query to get exploreStyles on user id " . auth()->id() . " : " . $th->getMessage());
                        return response()->json([
                            'status'=> 500,
                            'message' => 'Internal server error failed to get the exploreStyles'
                        ],500);
                    }
                } else {
                    $styleData = Style::all();
                }
            }else{
                $styleData = Style::all();
            }
        }catch(\Exception $e){
            Log::error('Something went wrong on getting exploreStyle: ' . $e->getMessage());
            return response()->json([
                'status'=>500,
                'message'=>'Internal server error failed on getting explore data'
            ], 500);
        }
        return response()->json([
            'status' => 200,
            'data' => $styleData,
            'message' => 'Style Data Queried'
        ], 200);
    }

    //Get the proucts by category
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
            if($userCategories !== null){
                try{
                    $userCategoryData = Category::whereIn('id', $userCategories)->get();
                    array_push($categoryData, $userCategoryData);
                }catch(\Throwable $th){
                    Log::error("Failed to query get shopCategory on user id " . auth()->id() . " : " . $th->getMessage());
                    return response()->json([
                        'status'=> 500,
                        'message' => 'Internal server error failed to get the shopCategory'
                    ],500);
                }
            } else {
                $categoryData = Category::skip(3)->take(4)->get();
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

    //Get the latest products
    public function getNewArrivals()
    {
        $oneWeekAgo = Carbon::now()->subWeek();
        $now = Carbon::now();

        try{
            $data = Product::whereBetween('created_at', [$oneWeekAgo, $now])
                        ->with(['user', 'images'])
                        ->take(4)
                        ->get();
        } catch (\Throwable $th) {
            Log::error("Failed to query getNewArrivals on user " . auth()->id() . " : " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while retrieving getNewArrivals'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'New Arrival Data Queried'
        ], 200);
    }

    //get the recommended products
    public function getOurPicks()
    {
        $oneWeekAgo = Carbon::now()->subWeek();

        try{
            $data = Product::inRandomOrder()
                        ->with(['user', 'images'])
                        ->take(4)
                        ->get();
        } catch (\Throwable $th){
            Log::error("Failed to query getOurPicks on user " . auth()->id() . " : " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while retrieving getOurPicks'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'Our Picks Data Queried'
        ], 200);
    }

    //Get the top or popular products
    public function getPopularItem()
    {
        $oneWeekAgo = Carbon::now()->subWeek();

        try{
            $data = Product::where('view_count', '>=', 100)
                        ->inRandomOrder()
                        ->with('user')
                        ->take(4)
                        ->get();
        } catch (\Throwable $th){
            Log::error("Failed to query get getPopularItem on user " . auth()->id() . " : " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while retrieving getPopularItem'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'Popular Items Data Queried'
        ], 200);
    }

    //Get the additional products
    public function getMoreItemsForYou()
    {
        try{
            $data = Product::inRandomOrder()
                        ->with(['user', 'images'])
                        ->take(8)
                        ->get();
        } catch (\Throwable $th){
            Log::error("Failed to query getMoreItemsForYou on user " . auth()->id() . " : " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while retrieving getMoreItemsForYou'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }

    //Get the shop or store that is highlighted
    public function shopSpotlight()
    {

        try{
            $data = SellerShop::orderBy('rating', 'desc')
                            ->take(4)
                            ->with('user')
                            ->get();
        } catch (\Throwable $th){
            Log::error("Failed to query get shopSpotlight on user " . auth()->id() . " : " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while retrieving shopSpotlight'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }

    //Get the shop to watch
    public function shopsToWatch()
    {
        try{
            $data = SellerShop::where('rating', '>=', 100)
                            ->orderBy('rating', 'asc')
                            ->take(4)
                            ->with('user')
                            ->get();
        }catch (\Throwable $th){
            Log::error("Failed to query get shopsToWatch on user " . auth()->id() . " : " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while retrieving shopsToWatch'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'More Items Data Queried'
        ], 200);
    }
}
