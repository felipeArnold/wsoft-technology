<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Source;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

final class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultSources = [
            [
                'name' => 'Website',
                'color' => '#3b82f6',
            ],
            [
                'name' => 'Social Media',
                'color' => '#8b5cf6',
            ],
            [
                'name' => 'Referral',
                'color' => '#10b981',
            ],
            [
                'name' => 'Google Ads',
                'color' => '#f59e0b',
            ],
            [
                'name' => 'Email Marketing',
                'color' => '#ef4444',
            ],
            [
                'name' => 'WhatsApp',
                'color' => '#22c55e',
            ],
            [
                'name' => 'Phone',
                'color' => '#06b6d4',
            ],
            [
                'name' => 'Event',
                'color' => '#ec4899',
            ],
            [
                'name' => 'Partner',
                'color' => '#6366f1',
            ],
            [
                'name' => 'Unknown',
                'color' => '#64748b',
            ],
        ];

        // Create default sources for all tenants
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            foreach ($defaultSources as $source) {
                Source::firstOrCreate(
                    [
                        'tenant_id' => $tenant->id,
                        'name' => $source['name'],
                    ],
                    [
                        'color' => $source['color'],
                        'is_default' => true,
                        'active' => true,
                    ]
                );
            }
        }
    }
}
