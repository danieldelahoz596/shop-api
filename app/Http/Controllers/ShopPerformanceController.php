<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SellerShop;
use App\Models\ShopPerformance;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class ShopPerformanceController extends Controller
{
    public function show(Request $request)
    {
        $users = SellerShop::findOrFail($request->user()->id);
        //probably will change the 'user_id' to 'shop_id'
        $products = Product::where('user_id', $users->id)->get();
        $sales = Sale::where('seller_id', $users->id)->get();

        //Like & Share
        $totalLikes = $products->sum('like');
        $totalShares = $products->sum('share');

        //Orders count
        $ordersCount =  $sales->count('product_id');

        //Conversion Rate
        $numberOfProducts = $products->count();
        $totalConversionRate = 0;
        //Get all the id of all the product in the shop
        $productIds = $products->pluck('id')->toArray();
        foreach ($productIds as $id) {
            //Assume that the buy now is where the product_id on the sale is equal to the id of the product of the shop
            $buyNowClicks = $sales->where('product_id', $id)->count();
            // Loop each product to get the conversion rate per product
            foreach ($products as $product) {
                $viewCount = $product->view_count;
                if ($viewCount > 0) {
                    $productConversionRate = ($buyNowClicks / $viewCount) * 100;
                    $totalConversionRate += $productConversionRate;
                }
            }
        }

        //Overall Conversion rate of the shop
        $averageConversionRate = $numberOfProducts > 0 ? $totalConversionRate / $numberOfProducts : 0;
        $averageConversionRate = round($averageConversionRate, 2);

        $totalViews = $products->sum('view_count');
        $totalSale = $sales->sum('total');

        $data = ShopPerformance::create([
            'user_id' => $users->id,
            'sales_total' => $totalSale,
            'orders_count' => $ordersCount,
            'engagements_likes'=>$totalLikes,
            'engagements_shares'=>$totalShares,
            'visitors' => $totalViews,
            'conversion_rate' => $averageConversionRate,
            // Not yet since there is no J&T 
            'return_rate' => 0,
        ]);

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
}
