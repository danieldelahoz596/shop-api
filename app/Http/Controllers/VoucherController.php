<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VoucherController extends Controller
{
    public function getVoucher($code)
    {
        try{
            $data = Voucher::where('code', $code)->first();
            if(!$data){
                return response()->json([
                    'status'=> 400,
                    'message' => 'Invalid voucher.'
                ], 400);
            }
        }catch(\Throwable $th){
            Log::error('Failed getting voucher on user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while getting voucher'
            ], 500);
        }

        return response()->json([
            'status' =>200,
            'data' => $data
        ], 200);
    }

    public function addVoucher(Request $request)
    {
        try{
            $data = Voucher::create([
                'name' => $request->name,
                'code' => $request->code,
                'amount' => $request->amount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
        } catch(\Exception $e){
            return response()->json([
                'status' => 403,
                'message'=> 'Validation failed. Please check input '
            ], 403);
        }catch(\Throwable $th){
            Log::error('Failed adding voucher on user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while adding voucher'
            ], 500);
        }

        return response()->json([
            'status' => 201,
            'data' => $data
        ], 201);
    }

    public function editVoucher(Request $request, Voucher $voucher)
    {
        try{
            $voucher->update([
                'name' => $request->name,
                'çode' => $request->code,
                'amount' => $request->amount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 403,
                'message'=> 'Validation failed. Please check input '
            ], 403);
        }catch(\Throwable $th){
            Log::error('Failed updating voucher on user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while updating voucher'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $voucher
        ], 200);
    }

    public function removeVoucher(Voucher $voucher)
    {
        try{
            $voucher->delete();
        }catch(\Throwable $th){
            Log::error('Failed deleting voucher on user_id ' . auth()->id() . ": " . $th->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while deleting voucher'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Voucher Deleted.'
        ], 200);
    }
}
