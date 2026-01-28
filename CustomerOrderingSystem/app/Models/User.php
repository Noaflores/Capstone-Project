<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';

    public $incrementing = false;
    protected $keyType = 'string';

    // ⚡ Use lowercase for easier Laravel mapping
    protected $fillable = [
        'first_name',
        'last_name',
        'email', // lowercase, map to DB in accessor
        'contact_number',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Map lowercase 'email' to DB column 'Email'
    public function getEmailAttribute()
    {
        return $this->attributes['Email'];
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['Email'] = $value;
    }

    // Helper to get full name
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function setNameAttribute($value)
    {
        $names = explode(' ', $value, 2);
        $this->attributes['first_name'] = $names[0];
        $this->attributes['last_name'] = $names[1] ?? '';
    }
}
