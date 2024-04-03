<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutAndBuyNowController extends Controller
{
    public function checkout(SaleRequest $request, CartItem $cartItem)
    {
        $data = Sale::create([
            'product_id' => $cartItem->product_id,
            'seller_id' => $cartItem->product->user->id,
            'buyer_id' => $cartItem->user_id,
            'address_id' => $request->address_id,
            'item_price' => $request->item_price,
            'item_quantity' => $cartItem->quantity,
            'voucher_code' => $request->voucher_code,
            'voucher_amount' => $request->voucher_amount,
            'shipping_fee' => $cartItem->product->shipping_fee,
            'total' => $request->total,
        ]);

        return response()->json([
            'status' => true,
            'data' => $data
        ], 201);
    }

    public function buynow(Request $request, Sale $sale, CartItem $cartItem)
    {
        $sale->update([
            'payment_status' => 'Paid',
            'status' => 'To be Packed',
            'mode_of_payment' => $request->mode_of_payment
        ]);

        $cartItem->delete();

        return response()->json([
            'status' => true,
            'message' => 'Congratulation on your purchase!',
            'data' => $sale
        ], 200);
    }

    public function cancelCheckout(Sale $sale)
    {
        $sale->delete();

        return response()->json([
            'status' => true,
            'message' => 'Checkout cancelled',
        ]);
    }

    public function dragonpay()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            // Add any other headers required by the API
        ])->post('https://test.dragonpay.ph/api/payout/merchant/v1/BUUDLKCMSO/post', [
            // "TxnId" => "20190225008",
            // "FirstName" => "Robertson",
            // "MiddleName" => "Sy",
            // "LastName" => "Chiang",
            // "Amount" => "1000",
            // "Currency" => "PHP",
            // "Description" => "Testing JSON payout",
            // "ProcId" => "CEBL",
            // "ProcDetail" => "sample@dragonpay.ph",
            // "RunDate" => "2019-02-26",
            // "Email" => "sample@dragonpay.ph",
            // "MobileNo" => "09175281679",
            // "BirthDate" => "1970-11-17",
            // "Nationality" => "Philippines",
            // "Address" => [
            //     "Street1" => "123 Sesame Street",
            //     "Street2" => "Childrens Television Workshop",
            //     "Barangay" => "Ugong",
            //     "City" => "Pasig",
            //     "Province" => "Metro Manila",
            //     "Country" => "PH"
            // ]
        ]);

        dd($response);

        $body = $response->body();

        return $body;
    }
}
