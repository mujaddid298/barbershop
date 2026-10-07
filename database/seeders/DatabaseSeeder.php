<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'nohp' => '08435545453',
                'role' => 'admin',
            ]);
        }
        if (! User::where('email', 'User@gmail.com')->exists()) {
            User::create([
                'name' => 'User',
                'email' => 'User@gmail.com',
                'password' => Hash::make('password'),
                'nohp' => '08435545453',
                'role' => 'user',
            ]);
        }

        $this->call([
            LayananSeeder::class,
            PromoSeeder::class,
        ]);
    }
}
