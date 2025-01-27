<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    
    public function options() {
        return $this->belongsToMany(MenuItemOption::class, 'menu_item_options_mapping');
    }
}
