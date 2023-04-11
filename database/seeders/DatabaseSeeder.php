<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Akun Super Admin',
            'role' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('SuperAdmin123?'),
            'verified' => true,
            'email_verified_at' => date(now())
        ]);

        // Customers
        Customer::factory(15)->create();
        // Customer::factory()->create([
        //   'name' => 'Abdul Gani',
        //   'address' => 'Jl. Gunung Muria, Purwokerto Utara, Banyumas, Jawa Tengah',
        //   'phone' => '08123456789'
        // ]);
        // Customer::factory()->create([
        //   'name' => 'Muhammad Azi',
        //   'address' => 'Jl. Seroja, Cakung, Jakarta Timur, DKI Jakarta',
        //   'phone' => '08198765432'
        // ]);
        // Customer::factory()->create([
        //   'name' => 'Ahmad Sanusi',
        //   'address' => 'Jl. Imam Bonjol, Cikarang Barat, Bekasi, Jawa Barat',
        //   'phone' => '081122334455'
        // ]);
        // Customer::factory()->create([
        //   'name' => 'Ahmad Sanusi',
        //   'address' => 'Jl. Imam Bonjol, Cikarang Barat, Bekasi, Jawa Barat',
        //   'phone' => '081122334455'
        // ]);

        // Items
        Item::factory()->create([
          'name' => 'Produk A',
          'price' => 100000,
          'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);
        Item::factory()->create([
          'name' => 'Produk B',
          'price' => 150000,
          'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);
        Item::factory()->create([
          'name' => 'Produk C',
          'price' => 200000,
          'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        ]);
    }
}
