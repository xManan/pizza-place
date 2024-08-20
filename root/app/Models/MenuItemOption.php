<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemOption extends Model
{
    use HasFactory;
    
    protected $gaurded = [];

    public function values() {
        return $this->hasMany(MenuItemOptionValue::class);
    }

    public function menuItems() {
        return $this->belongsToMany(MenuItem::class, 'menu_item_options_mapping');
    }
}
