<?php

namespace Svodya\Payzone\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_id', 'cross_reference', 'amount', 'status_code', 'currency_code', 'product_detail', 'customer_id'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
