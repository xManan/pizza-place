<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = collect([
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'phone' => '919123455555',
                'email' => 'test@example.com',
                'password' => Hash::make('asdf'),
            ],
            [
                'first_name' => 'Test',
                'last_name' => 'Customer',
                'phone' => '919123466666',
                'email' => 'customer@example.com',
                'password' => Hash::make('asdf'),
            ]
        ]);
        
        $customers->each(function($customer) {
            Customer::factory()->create($customer)->cart()->create();
        });
    }
}
