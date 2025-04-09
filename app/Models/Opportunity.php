<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    protected $fillable = [
        'title',
        'value',
        'notes',
        'stage_id',
        'contact_id'
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
