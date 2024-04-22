<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Sale;
use Crazymeeks\Foundation\PaymentGateway\Dragonpay;
use Crazymeeks\Foundation\PaymentGateway\DragonPay\Action\CancelTransaction;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutAndBuyNowController extends Controller
{
    public function checkout(SaleRequest $request, CartItem $cartItem)
    {
        try{
            $sale = Sale::select('transaction_id')->orderBy('transaction_id', 'desc')->first();

            if (!is_null($sale->transaction_id)) {
                $number = intval(substr($sale->transaction_id, 5));
                $trNum = 'TRID-'.$number + 1;
            } else {
                $trNum = 'TRID-1';
            }
        }catch(\Throwable $th){
            Log::error('Failed to process checkout due to server error. ' . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred during checkout process due to server error'
            ], 500);
        }

        try{
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
        }catch(\Exception $e){
            return response()->json([
                'status'=> 400,
                'message'=>'Validation failed. Please check credentials. '
            ], 400);
        }

        return response()->json([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    public function buynow(Sale $sale, CartItem $cartItem)
    {
        $transactionId = $sale->transaction_id;

        $username = env('MERCHANT_ID');
        $password = env('MERCHANT_PASSWORD');

        $client = new Client();
        $url = env('DRAGONPAY_BASEURL');

        try{
            $response = $client->request('GET', $url.'/txnid/'.$transactionId, [
                'auth' => [$username, $password]
            ]);
            if($response->getStatusCode() !== 200){
                return response()->json([
                    'status'=> 400,
                    'message'=> 'Payment Gateaway error. '
                ], 400);
            }
    
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
        }catch(GuzzleException $e){
            Log::error("HTTP request failed: " . $e->getMessage());
            return response()->json([
                'status' => 502,
                'message'=> 'Failed to process payment'
            ], 500);
        }catch(\Exception $e){
            Log::error("Error processing payment: " . $e->getMessage());
            return response()->json([
                'status' => 502,
                'message'=> 'Failed to process payment'
            ], 500);
        }

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
