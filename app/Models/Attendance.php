<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'check_in',
        'check_out',
        'status',
    ];

    // Automatically cast 'check_in' and 'check_out' as Carbon instances
    protected $dates = ['check_in', 'check_out'];

    public function getCheckInAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    public function getCheckOutAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
