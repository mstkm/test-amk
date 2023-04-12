<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function orders() {
      return $this->hasMany(Order::class);
    }
}
