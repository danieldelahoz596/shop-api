<?php

namespace App\Http\Controllers;

// Inside OrderController.php

// Inside OrderController.php

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function getOrderDetails($orderId)
    {

        try{
            $order = Order::with(['orderItems.product', 'user'])
            ->where('id', $orderId)
            ->first();
        }catch(\Throwable $th){
            Log::error('Failed to get the order details ' . $th->getMessage());
            return response()->json([
                'status'=>500,
                'message'=>'An error occurred to get order details'
            ], 500);
        }

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }


        $user = Auth::user();
        if ($order->user_id != $user->id) {
            return response()->json(['error' => 'You do not have permission to view this order'], 403);
        }


        $response = [
            'order_id' => $order->id,
            'order_date' => $order->created_at->toDateTimeString(),
            'total' => $order->total,
            'order_items' => $order->orderItems->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];
            }),
        ];

        return response()->json([
            'status'=>200,
            'data'=>$response
        ], 200);
    }

    public function getAllOrders()
    {
        $user = Auth::user();


        if ($user->role_id != 4) {
            return response()->json(['error' => 'Unauthorized - User is not a verified seller'], 403);
        }

        try{
            $orders = Order::with('orderItems.product')
                ->where('user_id', $user->id)
                ->get();
        }catch(\Throwable $th){
            Log::error('Failed to get all orders ' . $th->getMessage());
            return response()->json([
                'status'=>500,
                'message'=>'An error occurred to get all orders'
            ], 500);
        }


        $ordersResponse = $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'order_date' => $order->created_at->toDateTimeString(),
                'total' => $order->total,
                'order_items' => $order->orderItems->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ];
                }),
            ];
        });

        return response()->json([
            'status'=>200,
            'data'=>$ordersResponse
        ], 200);
    }
    public function getAllOrdersBySeller()
    {
        $seller = Auth::user();


        if ($seller->role_id != 4 || !$seller->is_seller) {
            return response()->json(['error' => 'Unauthorized!'], 403);
        }


        try{
            $orders = Order::whereHas('orderItems.product', function ($query) use ($seller) {
                $query->where('user_id', $seller->id);
            })->with(['orderItems.product', 'user'])
                ->get();
        }catch(\Throwable $th){
            Log::error('Failed to get all orders by seller ' . $th->getMessage());
            return response()->json([
                'status'=>500,
                'message'=>'An error occurred to get all order by seller'
            ], 500);
        }


        $ordersResponse = $orders->map(function ($order) use ($seller) {
            $filteredOrderItems = $order->orderItems->filter(function ($orderItem) use ($seller) {
                return $orderItem->product->user_id == $seller->id;
            });

            return [
                'order_id' => $order->id,
                'order_date' => $order->created_at->toDateTimeString(),
                'total' => $order->total,
                'buyer_info' => [
                    'name' => $order->user->name,
                    'email' => $order->user->email,
                ],
                'order_items' => $filteredOrderItems->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ];
                }),
            ];
        });

        return response()->json([
            'status'=>200,
            'data'=>$ordersResponse
        ], 200);
    }
}