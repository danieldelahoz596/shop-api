<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Models\User;
use Crazymeeks\Foundation\PaymentGateway\Dragonpay;
use Crazymeeks\Foundation\PaymentGateway\DragonPay\Action\CancelTransaction;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Xendit\Configuration;
use Xendit\Payout\PayoutApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Omnipay\Omnipay;

class CheckoutAndBuyNowController extends Controller
{

    public function checkout(SaleRequest $request)
    {

        try {
            $sale = Sale::select('transaction_id')->orderBy('id', 'desc')->first();

            if (!is_null($sale) && !is_null($sale->transaction_id)) {
                $number = intval(substr($sale->transaction_id, 5));
                $trNum = 'TRID-' . ($number + 1);
            } else {
                $trNum = 'TRID-1';
            }
        } catch(\Throwable $th) {
            Log::error('Failed to process checkout due to server error. ' . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred during checkout process due to server error'
            ], 500);
        }

        // try {
            $data = Sale::create([
                'transaction_id' => $trNum,
                'buyer_id' => auth()->guard('sanctum')->id(),
                'address_id' => $request->address_id,
                'item_price' => $request->item_price,
                'item_quantity' => $request->quantity,
                'voucher_code' => $request->voucher_code,
                'voucher_amount' => $request->voucher_amount,
                'shipping_fee' => $request->shipping_fee,
                'total' => $request->total,
                'status' => 'Pending',
                'mode_of_payment' => $request->mode_of_payment,
            ]);

            $id = $data->id;
            $p = $request->product_id;
            foreach($p as $index => $product)
            {
                $saleProduct = new SaleProduct();
                $saleProduct->transection_id = $data->transaction_id;
                $saleProduct->sale_id = $id;
                $saleProduct->product_id = $product;
                $saleProduct->save();
            }
        // } catch(\Exception $e) {
        //     return response()->json([
        //         'status'=> 400,
        //         'message'=>'Validation failed. Please check credentials. '
        //     ], 400);
        // }

        if($data->mode_of_payment == 'card')
        {
            $u = User::where('id', $data->buyer_id)->first();
            return $this->createPayout($data->id, $u->email, $data->total);
        }
        elseif($data->mode_of_payment == 'gCash')
        {
            $u = User::where('id', $data->buyer_id)->first();
            return $this->createPayout($data->id, $u->email, $data->total);
        }
        elseif($data->mode_of_payment == 'cod')
        {

            $d = Sale::where('id', $data->id)->first();
            $d->status = 'Completed';
            $d->save();
            return response()->json([
                'status' => 200,
                'data' => $data
            ], 200);
        }
    }



    public function createPayout($order_id, $email, $amount)
    {
        $success_url = url('/') . "/api/payment/success-url?order_id=$order_id";
        $cancel_url = url('/') . "/api/stripe/payment/error-url";
        $data = array(
            "external_id" => "invoice-1715343198",
            "amount" => $amount * 1000,
            "payer_email" => $email,
            "description" => "Invoice Data",
            "success_redirect_url" => $success_url,
            "failure_redirect_url" => $cancel_url,
            "currency" => "IDR",
        );

        // Encode data array to JSON
        $json_data = json_encode($data);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.xendit.co/v2/invoices',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$json_data,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic eG5kX2RldmVsb3BtZW50X1E3UmxOZDVYN1VxSHBmOEV4Vld3VTdnYjVUQ3djZENKb3U5cEFmS0FPVTdXQXV3alh2WHBqaXJNb1BEdjo=',
            'Cookie: __cf_bm=x6ibnXOtkrv2oExG_VTLkdFUr0S4kyAyASVU2jGnqIw-1715343136-1.0.1.1-E2CBxrGc374pyb5EHERxR7_7PptSUsxoWTdF_hO9_lrtloomzNtrRSimIpMXWATWtEG0AYJdVhHiEys41Cei1A'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $decoded_response = json_decode($response, true);

        return response()->json(['data'=> $decoded_response, 'status' => true]);
    }

    public function  paymentSuccess(Request $request)
    {
        $payment = Sale::where([
            'id' => $request->order_id,
        ]);

        $payment->update([
            'status' => 'Completed',
        ]);

        return response()->json(['message' => 'Payment completed successfully!', 'status' => true]);
    }

    public function paymenterror(Request $request)
    {

        return response()->json(['message' => 'Payment was unsuccessful. Your credit card was not charged!', 'status' => false]);
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
