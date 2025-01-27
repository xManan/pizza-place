<?php

namespace App\Enums;

use App\Traits\EnumValid;

enum MenuCategory: string
{
    use EnumValid;
    
    case PIZZAS = 'PIZZAS';
    case PASTAS = 'PASTAS';
    case SIDES = 'SIDES';
    case DRINKS = 'DRINKS';
}
