<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Supplier;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Supplier Admin',
            'email' => 'supplier@gmail.com',
            'password' => Hash::make('pass123'), 
        ]);

         Supplier::factory(10)->create();
    }
}