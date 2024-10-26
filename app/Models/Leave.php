<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'purpose',
        'status',
    ];

    // You can add relationships, such as to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
