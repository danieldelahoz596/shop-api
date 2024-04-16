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

    public function addVoucher(Request $request)
    {
        $data = Voucher::create([
            'name' => $request->name,
            'code' => $request->code,
            'amount' => $request->amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json([
            'status' => true,
            'data' => $data
        ], 201);
    }

    public function editVoucher(Request $request, Voucher $voucher)
    {
        $voucher->update([
            'name' => $request->name,
            'çode' => $request->code,
            'amount' => $request->amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return response()->json([
            'status' => true,
            'data' => $voucher
        ], 200);
    }

    public function removeVoucher(Voucher $voucher)
    {
        $voucher->delete();

        return response()->json([
            'status' => true,
            'message' => 'Voucher Deleted.'
        ], 200);
    }
}
