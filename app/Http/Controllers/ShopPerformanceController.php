<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sale;
use App\Models\SellerShop;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class ShopPerformanceController extends Controller
{
    public function show(Request $request)
    {
        $user = SellerShop::findOrFail($request->user()->id);
            $ordersCount =  Order::count();
            $visitors = random_int(3000, 5000);
            $data =[
                'salesTotal'=> Sale::sum('total'),
                'ordersCount'=> $ordersCount,
                'engagements'=>[
                    'likes'=> $user->like,
                    'shares'=> $user->share,
                ],
                'visitors'=>$visitors, // Dummy data
                'conversionRate'=>$ordersCount / max($visitors, 1),
                'returnRate'=> 0,
            ];

            return response()->json([
                'status'=> true,
                'data'=> $data
            ], 200);

    }
}
