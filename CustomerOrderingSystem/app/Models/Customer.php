<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_customer';
    protected $primaryKey = 'customer_id'; // Custom PK
    public $incrementing = false;         // Because it's a string (e.g., CUST-01)
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'customer_id', 
        'first_name', 
        'last_name', 
        'Email', 
        'contact_number', 
        'password'
    ];

    /**
     * This tells Laravel to use 'Email' instead of 'email' for login
     */
    public function getAuthIdentifierName()
    {
        return 'Email';
    }
}