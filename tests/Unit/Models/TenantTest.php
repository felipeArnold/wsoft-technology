<?php

declare(strict_types=1);

use App\Models\Tenant;

test('tenant has correct fillable attributes', function (): void {
    $tenant = new Tenant();
    
    $fillable = [
        'name',
        'slug',
        'avatar',
        'document',
        'email',
        'phone',
        'mobile',
        'zip_code',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'website',
        'type',
        'max_users',
    ];

    expect($tenant->getFillable())->toBe($fillable);
});

test('tenant has correct guarded attributes', function (): void {
    $tenant = new Tenant();
    
    $guarded = ['id'];

    expect($tenant->getGuarded())->toBe($guarded);
});

test('tenant uses SoftDeletes trait', function (): void {
    $tenant = new Tenant();

    expect(method_exists($tenant, 'trashed'))->toBeTrue();
});

test('tenant uses Billable trait', function (): void {
    $tenant = new Tenant();

    expect(method_exists($tenant, 'subscriptions'))->toBeTrue();
    // customer method may not exist directly in all versions
});

test('tenant can be instantiated', function (): void {
    $tenant = new Tenant([
        'name' => 'Test Company',
        'email' => 'test@example.com',
    ]);

    expect($tenant->name)->toBe('Test Company');
    expect($tenant->email)->toBe('test@example.com');
});