<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemOptionValue extends Model
{
    use HasFactory;

    public function option() {
        $this->belongsTo(MenuItemOption::class);
    }
}
