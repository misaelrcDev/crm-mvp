<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = [
        'name',
        'order',
        'sales_funnel_id',
        'user_id'
    ];

    public function salesFunnel()
    {
        return $this->belongsTo(SalesFunnel::class);
    }

    protected static function booted()
    {
        static::creating(function ($stage) {
            $stage->order = match ($stage->name) {
                'Contato Inicial' => 1,
                'Proposta Enviada' => 2,
                'Negociação' => 3,
                'Fechado (Ganho)' => 4,
                'Fechado (Perdido)' => 5,
                default => 1, // Define um valor padrão
            };
        });
}

}
