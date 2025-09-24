<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    protected $fillable = ['experience_id','start_time','end_time', 'date',];
    /** @use HasFactory<\Database\Factories\EventScheduleFactory> */
    use HasFactory;
    
    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}
