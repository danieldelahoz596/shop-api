<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Sale;
use Crazymeeks\Foundation\PaymentGateway\Dragonpay;
use Crazymeeks\Foundation\PaymentGateway\DragonPay\Action\CancelTransaction;
use GuzzleHttp\Client;
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
            'status' => 201,
            'data' => $data
        ], 201);
    }

    public function buynow(Sale $sale, CartItem $cartItem)
    {
        $transactionId = $sale->transaction_id;

        $username = env('MERCHANT_ID');
        $password = env('MERCHANT_PASSWORD');

        $client = new Client();
        $url = env('DRAGONPAY_BASEURL');

        $response = $client->request('GET', $url.'/txnid/'.$transactionId, [
            'auth' => [$username, $password]
        ]);

        $contents = $response->getBody()->getContents();
        $data = json_decode($contents, true);

        $status = $this->paymentStatus($data['Status']);
        $mop = $this->modeOfPayments($data['ProcId']);

        $sale->update([
            'payment_status' => $status,
            'status' => 'To be Packed',
            'mode_of_payment' => $mop
        ]);

        $cartItem->delete();

        return response()->json([
            'status' => 200,
            'data' => $sale
        ], 200);
    }

    public function cancelCheckout(Sale $sale)
    {
        $sale->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Checkout cancelled',
        ], 200);
    }

    public function payment(Sale $sale)
    {
        //paul@buudl.com

        $parameters = [
            'txnid' => $sale->transaction_id,
            'amount' => $sale->total,
            'ccy' => 'PHP',
            'description' => $sale->product->product_description,
            'email' => $sale->buyer->email,
        ];

        $merchant_account = [
            'merchantid' => env('MERCHANT_ID'),
            'password'   => env('MERCHANT_PASSWORD')
        ];

        $dragonpay = new Dragonpay($merchant_account);
        $dragonpay->setParameters($parameters)->away();
    }

    public function paymentStatus($status)
    {
        switch ($status) {
            case 'S':
                return 'Paid';
                break;
            case 'F':
                return 'Failed';
                break;
            case 'U':
                return 'Processing';
                break;
            case 'R':
                return 'Refunded';
                break;
            case 'K':
                return 'Chargeback';
            case 'V':
                return 'Cancelled';
                break;
            default:
                return 'Pending';
        }
    }

    public function modeOfPayments($mop)
    {
        switch ($mop) {
            case 'BAYD':
                return 'Bayad Center';
                break;
            case 'BDO':
                return 'BDO Online Banking';
                break;
            case 'CC':
                return 'Credit Cards';
                break;
            case 'CEBL':
                return 'Cebuana Lhuillier';
                break;
            case 'DPAY':
                return 'Dragonpay Prepaid Credits';
                break;
            case 'ECPY':
                return 'ECPay';
                break;
            case 'GCSB':
                return 'Globe Gcash';
                break;
            case 'LBC':
                return 'LBC';
                break;
            case 'PYPL':
                return 'PayPal';
                break;
            case 'MLH':
                return 'M. Lhuillier';
                break;
            case 'RDS':
                return 'Robinsons Dept Store';
                break;
            case 'SMR':
                return 'SM Payment Counters';
                break;
            case '711':
                return '7-Eleven';
                break;
            case 'INPY':
                return 'Instapay';
                break;
            default:
                return 'No payment';
        }
    }
}
