<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data["title"] = "Payment";
    }

    public function index() {
        $data = $this->data;
        $data['paymentsData'] = Payment::with(['user', 'course'])->get();
        $data['no'] = 1;

        return view('payment.index', compact(['data']));
    }
}
