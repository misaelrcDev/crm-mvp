<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'notes',
        'user_id'
    ];

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
