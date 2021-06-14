<?php

namespace Svodya\Payzone\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address_line_1', 'address_line_2', 'address_line_3', 'address_line_4', 'city', 'county', 'postal_code', 'country', 'payment_method'];

    public function order(){
        $this->belongsTo(Order::class);
    }
}
