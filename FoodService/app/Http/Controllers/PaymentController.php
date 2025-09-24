<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    // This method shows the payment form/page
    public function show() 
    {
        $data = session()->all();

    $amount = $data['amount'] ?? 0;

    return view('payment.form', [
        'bookingData' => $data,
        'amount' => $amount,
    ]);
}

    // This method processes the payment submission
    public function process(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        Payment::create([
            'booking_id' => $request->booking_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'transaction_id' => rand(100000, 999999), 
        ]);

        return redirect()->route('payment.form')->with('success', 'Successful Purchase');
    }
}
