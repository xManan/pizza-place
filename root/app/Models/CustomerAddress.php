<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function customer() {
        $this->belongsTo(Customer::class);
    }
}
