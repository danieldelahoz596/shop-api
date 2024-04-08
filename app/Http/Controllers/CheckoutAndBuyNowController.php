<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Sale;
use Crazymeeks\Foundation\PaymentGateway\Dragonpay;
use Crazymeeks\Foundation\PaymentGateway\DragonPay\Action\CancelTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutAndBuyNowController extends Controller
{
    public function checkout(SaleRequest $request, CartItem $cartItem)
    {
        $sale = Sale::select('transaction_id')->orderBy('transaction_id', 'desc')->first();

        if (!is_null($sale->transaction_id)) {
            $number = intval(substr($sale->transaction_id, 5));
            $trNum = 'TRID-'.$number + 1;
        } else {
            $trNum = 'TRID-1';
        }

        $data = Sale::create([
            'transaction_id' => $trNum,
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
        $parameters = [
            'txnid' => 'TXNID3',
            'amount' => 100,
            'ccy' => 'PHP',
            'description' => 'Test',
            'email' => 'some@merchant.ph',
            'param1' => 'param1',
            'param2' => 'param2',
        ];


        $merchant_account = [
            'merchantid' => 'BUUDLKCMSO',
            'password'   => 'ak8TRcQXHeEopQx'
        ];
        // Initialize Dragonpay
        $txnid = 'TXNID3';
        $dragonpay = new Dragonpay($merchant_account);
        $dragonpay->action(new \Crazymeeks\Foundation\PaymentGateway\Dragonpay\Action\CheckTransactionStatus($txnid));

        // Set parameters, then redirect to dragonpay
        // $dragonpay->setParameters($parameters)->away();
    }
}
