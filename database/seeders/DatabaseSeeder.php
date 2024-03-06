<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \Domain\Transaction\Models\Balance::whereNotNull('id')->delete();
        \Domain\Transaction\Models\Deposit::whereNotNull('id')->delete();
        \Domain\User\Models\User::whereNotNull('id')->delete();

        \Domain\User\Models\User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
    }
}
