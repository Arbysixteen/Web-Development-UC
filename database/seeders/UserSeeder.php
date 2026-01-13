<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@digitalmarket.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create demo customer
        $customer = User::create([
            'name' => 'Customer Demo',
            'email' => 'customer@example.com',
            'phone' => '081234567891',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // Create cart for customer
        Cart::create([
            'user_id' => $customer->id,
            'status' => 'active',
        ]);
    }
}
