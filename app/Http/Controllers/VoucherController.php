<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function getVoucher($code)
    {
        $data = Voucher::where('code', $code)->first();

        return response()->json([
            'status' => $data ? true : false,
            'data' => $data
        ], $data ? 200 : 404);
    }
}
