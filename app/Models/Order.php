<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function customer() {
      return $this->belongsTo(Customer::class);
    }

    public function order_items() {
      return $this->hasMany(OrderItem::class);
    }
}
