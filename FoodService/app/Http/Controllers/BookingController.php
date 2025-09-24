<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Experience;
use App\Models\ChefUser;

class BookingController extends Controller
{
    // Show booking form by topic (meat, vegetable, juice, shake)
    public function form($topic)
    {
        $experience = Experience::where('title', 'LIKE', '%' . ucfirst($topic) . '%')->firstOrFail();

        $chefMap = [
            'meat' => 'Marco Ollero',
            'vegetable' => 'Robbie Manimtim',
            'juice' => 'Noah Flores',
            'shake' => 'Irish Cabingue',
        ];

        $chefName = $chefMap[$topic] ?? null;
        $chef = ChefUser::where('name', $chefName)->first();

        return view('booking.form', compact('experience', 'chef'));
    }

    // Handle booking submission
  public function submitBooking(Request $request)
{
    // Make sure validation matches input names
    $request->validate([
        'experience_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'date' => 'required|date',
        'time_slot' => 'required|string',
    ]);

    $experience = Experience::findOrFail($request->input('experience_id'));
    $bookingDateTime = $request->input('date') . ' ' . explode(' - ', $request->input('time_slot'))[0];
  
    $booking = Booking::create([
        'experience_id' => $request->input('experience_id'),
        'customer_name' => $request->input('name'), 
        'email' => $request->input('email'), 
        'booking_date' => $bookingDateTime, 
        'status' => 'pending',
    ]);

    session([
        'booking_id' => $booking->id,
        'amount' => $experience->price,
        'experience_title' => $experience->title,
        'customer_name' => $request->name, 
        'email' => $request->email,
        'date' => $request->date,
        'time_slot' => $request->time_slot,
    ]);

    return redirect()->route('payment.form', ['booking_id' => $booking->id]);
}
}
