<?php

declare(strict_types=1);

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('product can be created', function (): void {
    $product = Product::factory()->create([
        'name' => 'Test Product',
        'price_sale' => 100.50,
    ]);

    expect($product->name)->toBe('Test Product');
    expect($product->price_sale)->toBe(100.50);
});
