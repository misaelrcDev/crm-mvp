<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = [
        'name',
        'order',
        'sales_funnel_id'
    ];

    public function salesFunnel()
    {
        return $this->belongsTo(SalesFunnel::class);
    }
}
