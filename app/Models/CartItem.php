<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    
    protected $gaurded = [];
    protected $fillable = [ 'menu_item_id', 'options', 'qty', 'total_price' ];

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function menuItem() {
        return $this->belongsTo(MenuItem::class);
    }
    
    public function optionValues() {
        return MenuItemOptionValue::findMany($this->options);
    }

    public function getOptionsAttribute($value)
    {
        return json_decode($value, true);
    }
}
