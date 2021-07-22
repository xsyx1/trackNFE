<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'pay', 'form_pay', 'shipping',
        'discount', 'total'
    ];

    public function getInfoAttribute()
    {
        return $this->cod." - ".$this->name;
    }
}
