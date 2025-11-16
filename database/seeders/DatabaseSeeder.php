<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
        ->count(3)
        ->hasThreads(3)
        ->hasPosts(2)
        ->create();

        // viewerユーザーを１人作成
        User::factory()->create([
            'name' => 'viewer',
            'email' => 'viewer@example.com',
            'role' => Role::Viewer,
            'password' => bcrypt('viewer'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
