<?php

declare(strict_types=1);

use App\Models\User;

test('user has correct fillable attributes', function (): void {
    $user = new User();

    $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'has_email_authentication',
        'commission_percentage',
    ];

    expect($user->getFillable())->toBe($fillable);
});

test('user has correct hidden attributes', function (): void {
    $user = new User();

    $hidden = [
        'password',
        'remember_token',
    ];

    expect($user->getHidden())->toBe($hidden);
});

test('user uses HasFactory trait', function (): void {
    $user = new User();

    expect(method_exists($user, 'factory'))->toBeTrue();
});

test('user uses Notifiable trait', function (): void {
    $user = new User();

    expect(method_exists($user, 'notify'))->toBeTrue();
    expect(method_exists($user, 'routeNotificationFor'))->toBeTrue();
});

test('user can be instantiated', function (): void {
    $user = new User([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    expect($user->name)->toBe('Test User');
    expect($user->email)->toBe('test@example.com');
});
