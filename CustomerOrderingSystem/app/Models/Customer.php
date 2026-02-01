<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_customer';
    protected $primaryKey = 'customer_id'; // Custom PK
    public $incrementing = false;         // IDs like "CUST-01"
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'password',
        'gcash_name',
        'gcash_number',
    ];

    /**
     * Use Email as the login identifier
     */
    public function getAuthIdentifierName()
    {
        return 'email';
    }

    /**
     * Return full name
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
