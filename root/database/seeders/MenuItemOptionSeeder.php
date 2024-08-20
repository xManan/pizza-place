<?php

namespace Database\Seeders;

use App\Enums\MenuCategory;
use App\Models\MenuItem;
use App\Models\MenuItemOption;
use App\Models\MenuItemOptionValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizeOpt = MenuItemOption::create([
            'name' => 'size',
            'label' => 'Size',
            'is_multiselect' => false
        ]);
        
        MenuItemOptionValue::insert([
            [
                'menu_item_option_id' => $sizeOpt->id,
                'label' => 'Small',
                'value' => 'small',
                'price' => 0,
                'is_default' => true,
            ],
            [
                'menu_item_option_id' => $sizeOpt->id,
                'label' => 'Medium',
                'value' => 'medium',
                'price' => 10000,
                'is_default' => false,
            ],
            [
                'menu_item_option_id' => $sizeOpt->id,
                'label' => 'Large',
                'value' => 'large',
                'price' => 20000,
                'is_default' => false,
            ],
        ]);

        $crustOpt = MenuItemOption::create([
            'name' => 'crust',
            'label' => 'Crust',
            'is_multiselect' => false
        ]);
        
        MenuItemOptionValue::insert([
            [
                'menu_item_option_id' => $crustOpt->id,
                'label' => 'Hand-Tossed',
                'value' => 'hand-tossed',
                'price' => 0,
                'is_default' => true,
            ],
            [
                'menu_item_option_id' => $crustOpt->id,
                'label' => 'Pan',
                'value' => 'pan',
                'price' => 0,
                'is_default' => false,
            ],
            [
                'menu_item_option_id' => $crustOpt->id,
                'label' => 'Cheese Burst',
                'value' => 'cheese-burst',
                'price' => 15000,
                'is_default' => false,
            ],
            [
                'menu_item_option_id' => $crustOpt->id,
                'label' => 'Thin Crust',
                'value' => 'thin-crust',
                'price' => 15000,
                'is_default' => false,
            ],
        ]);

        $toppingsOpt = MenuItemOption::create([
            'name' => 'toppings',
            'label' => 'Extra Toppings',
            'is_multiselect' => true
        ]);
        
        MenuItemOptionValue::insert([
            [
                'menu_item_option_id' => $toppingsOpt->id,
                'label' => 'Cheese',
                'value' => 'cheese',
                'price' => 5000,
                'is_default' => false,
            ],
            [
                'menu_item_option_id' => $toppingsOpt->id,
                'label' => 'Onions',
                'value' => 'onions',
                'price' => 2000,
                'is_default' => false,
            ],
            [
                'menu_item_option_id' => $toppingsOpt->id,
                'label' => 'Capsicum',
                'value' => 'capsicum',
                'price' => 2000,
                'is_default' => false,
            ],
            [
                'menu_item_option_id' => $toppingsOpt->id,
                'label' => 'Corns',
                'value' => 'corns',
                'price' => 2000,
                'is_default' => false,
            ],
        ]);

        $items = MenuItem::where('category', MenuCategory::PIZZAS)->get();
        foreach($items as $item) {
            $item->options()->attach($sizeOpt->id);
            $item->options()->attach($crustOpt->id);
            $item->options()->attach($toppingsOpt->id);
        }

    }
}
