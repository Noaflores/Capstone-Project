<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'customers'; // 👈 your table name

    protected $primaryKey = 'customer_id'; // 👈 PK name

    public $incrementing = false; // varchar PK
    protected $keyType = 'string';

    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'Email',
        'contact_number',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Fix email column name
    public function getEmailAttribute()
    {
        return $this->attributes['Email'];
    }
}
