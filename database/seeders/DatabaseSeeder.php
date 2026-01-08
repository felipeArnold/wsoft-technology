<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enum\TenantType;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar tenant
        $tenant = Tenant::create([
            'name' => 'WSoft Technology',
            'slug' => Tenant::generateUniqueSlug('WSoft Technology'),
            'stripe_id' => 'cus_test_'.uniqid(),
            'type' => TenantType::AUTO_REPAIR
        ]);

        // Criar usuário
        $user = User::factory()->create([
            'name' => 'Felipe Wustar',
            'email' => 'felipe@example.com',
            'password' => bcrypt('password'),
        ]);

        // Associar usuário ao tenant
        $tenant->users()->attach($user);

        // Criar subscription fixa
        $tenant->subscriptions()->create([
            'type' => 'default',
            'stripe_id' => 'sub_test_'.uniqid(),
            'stripe_status' => 'active',
            'stripe_price' => 'price_test',
            'quantity' => 1,
            'trial_ends_at' => null,
            'ends_at' => null,
        ]);

        // Chamar seeders
        $this->call([
            SourceSeeder::class,
            LossReasonSeeder::class,
        ]);
    }
}
