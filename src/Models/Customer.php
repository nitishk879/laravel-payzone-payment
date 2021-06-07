<?php

namespace Svodya\Payzone\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'address', 'city', 'state', 'postcode', 'country', 'order_id'];

    public function order(){
        $this->belongsTo(Order::class);
    }
}
