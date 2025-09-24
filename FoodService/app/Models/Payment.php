<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['booking_id','amount','payment_method','transaction_id','status',];
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;
}
