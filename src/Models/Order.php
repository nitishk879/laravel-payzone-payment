<?php

namespace Svodya\Payzone\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'order_status', 'order_price', 'order_type', 'total_price', 'order_details', 'cross_reference', 'customer_id'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
