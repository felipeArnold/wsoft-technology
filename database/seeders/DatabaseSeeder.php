<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'felipe@example.com',
            'password' => bcrypt('password'),
        ]);

        Tenant::query()->create([
            'name' => 'WSoft',
            'slug' => 'w-soft',
        ])->users()->attach(User::find(1));
    }
}
