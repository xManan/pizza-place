<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerAddress;
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
                'phone' => '9625219955',
                'email' => 'test@example.com',
                'password' => 'asdf',
            ],
            [
                'first_name' => 'Test',
                'last_name' => 'Customer',
                'phone' => '9775554444',
                'email' => 'customer@example.com',
                'password' => 'asdf',
            ]
        ]);
        
        $customers->each(function($customer) {
            $cust = Customer::factory()->create($customer);
            $cust->cart()->create();
            CustomerAddress::factory()->create([
                'customer_id' => $cust->id,
            ]);
        });
    }
}
