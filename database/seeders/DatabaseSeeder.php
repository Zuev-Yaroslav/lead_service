<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(['email' => 'admin@admin.com'], [
            'name' => 'Admin',
            'password' => Hash::make(config('dev.first_user_password')),
        ]);
        $this->call([StatusSeeder::class]);
    }
}
