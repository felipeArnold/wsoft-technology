<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\LossReason;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

final class LossReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultLossReasons = [
            [
                'name' => 'High Price',
                'color' => '#ef4444',
            ],
            [
                'name' => 'Not Interested',
                'color' => '#f59e0b',
            ],
            [
                'name' => 'No Response',
                'color' => '#6b7280',
            ],
            [
                'name' => 'Bought from Competitor',
                'color' => '#8b5cf6',
            ],
            [
                'name' => 'Not the Right Time',
                'color' => '#06b6d4',
            ],
            [
                'name' => 'No Budget',
                'color' => '#ec4899',
            ],
            [
                'name' => 'Does Not Meet Needs',
                'color' => '#f97316',
            ],
            [
                'name' => 'Lost Contact',
                'color' => '#64748b',
            ],
            [
                'name' => 'Duplicate Lead',
                'color' => '#0ea5e9',
            ],
            [
                'name' => 'Other Reason',
                'color' => '#9ca3af',
            ],
        ];

        // Create default loss reasons for all tenants
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            foreach ($defaultLossReasons as $reason) {
                LossReason::firstOrCreate(
                    [
                        'tenant_id' => $tenant->id,
                        'name' => $reason['name'],
                    ],
                    [
                        'color' => $reason['color'],
                        'is_default' => true,
                        'active' => true,
                    ]
                );
            }
        }
    }
}
