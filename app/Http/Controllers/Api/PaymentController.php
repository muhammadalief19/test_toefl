<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public function store(Request $request) {
        date_default_timezone_set('Asia/Jakarta');

        $validator = Validator::make($request->all(), [
            'user_id' => ['required'],
            'course_id' => ['required'],
            'amount' => ['required','numeric'],
            'payment_method' => ['required'],
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $now = Carbon::now();

        $createData = Payment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_date' => $now->isoFormat('Y-M-D H:mm:ss'),
            'transaction_status' => 'pending'
        ]);

        if($createData) {
            return response()->json([
                'success' => true,
                'data' => $createData
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'data' => false
            ], 500);
        }
    }

    public function updateTransactionCompleted($id) {
        $payment = Payment::where('_id', $id)->first();

        if(!$payment) {
            return response()->json([
                'success' => false,
                'data' => false,
                'message' => 'Payment Tidak Ditemukan!'
            ], 404);
        }

        $updateStatus = $payment->update([
            'transaction_status' => 'completed'
        ]);
        
        if($updateStatus) {
            return response()->json([
                'success' => true,
                'data' => true,
                'message' => 'Payment is completed!'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => false,
            ], 500);
        }
    }

    public function updateTransactionFailed($id) {
        $payment = Payment::where('_id', $id)->first();

        if(!$payment) {
            return response()->json([
                'success' => false,
                'data' => false,
                'message' => 'Payment Tidak Ditemukan!'
            ], 404);
        }

        $updateStatus = $payment->update([
            'transaction_status' => 'failed'
        ]);
        
        if($updateStatus) {
            return response()->json([
                'success' => true,
                'data' => true,
                'message' => 'Payment is failed!'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => false,
            ], 500);
        }
    }
}
