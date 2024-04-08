<?php

namespace App\Http\Controllers;

// Inside OrderController.php

// Inside OrderController.php

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getOrderDetails($orderId)
    {

        $order = Order::with(['orderItems.product', 'user'])
            ->where('id', $orderId)
            ->first();

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

        return response()->json($response);
    }

    public function getAllOrders()
    {
        $user = Auth::user();


        if ($user->role_id != 4) {
            return response()->json(['error' => 'Unauthorized - User is not a verified seller'], 403);
        }

        $orders = Order::with('orderItems.product')
            ->where('user_id', $user->id)
            ->get();


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

        return response()->json($ordersResponse);
    }
    public function getAllOrdersBySeller()
    {
        $seller = Auth::user();


        if ($seller->role_id != 4 || !$seller->is_verified) {
            return response()->json(['error' => 'Unauthorized!'], 403);
        }


        $orders = Order::whereHas('orderItems.product', function ($query) use ($seller) {
            $query->where('user_id', $seller->id);
        })->with(['orderItems.product', 'user'])
            ->get();


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

        return response()->json($ordersResponse);
    }
}
