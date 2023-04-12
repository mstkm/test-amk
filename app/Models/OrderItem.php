<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function orders() {
      return $this->belongsTo(Order::class);
    }

    public function item() {
      return $this->belongsTo(Item::class);
    }
}
