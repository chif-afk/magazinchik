<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $filliable = ['qty', 'total', 'name', 'email', 'phone', 'address', 'note'];

    public function products() {
        return $this->hasMany(orderProduct::class);
    }
}
