<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Customer extends User
{
    use HasFactory;
    
    public function cart() {
        return $this->hasOne(Cart::class);
    }
}
