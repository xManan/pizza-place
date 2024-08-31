<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerAddress>
 */
class CustomerAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => '1',
            'name' => 'Home',
            'address1' => fake()->address(),
            'address2' => '',
            'city' => fake()->city(),
            'pincode' => '110015',
        ];
    }
}
