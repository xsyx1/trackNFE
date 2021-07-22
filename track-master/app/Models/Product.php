<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'cod', 'ncm', 'cest',
        'amount', 'unit', 'weight', 'origin',
        'subtotal', 'total', 'federal_texas',
        'state_texas', 'order_id','is_enabled'
    ];

    public function getInfoAttribute()
    {
        return $this->cod." - ".$this->name;
    }
}
