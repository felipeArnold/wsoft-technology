<?php

declare(strict_types=1);

use App\Models\Product;

test('product has correct guarded attributes', function (): void {
    $product = new Product();

    $guarded = ['net_profit', 'profit_margin'];

    expect($product->getGuarded())->toBe($guarded);
});

test('product uses HasFactory trait', function (): void {
    $product = new Product();

    expect(method_exists($product, 'factory'))->toBeTrue();
});

test('product uses SoftDeletes trait', function (): void {
    $product = new Product();

    expect(method_exists($product, 'trashed'))->toBeTrue();
});

test('product uses Categorizable trait', function (): void {
    $product = new Product();

    expect(method_exists($product, 'categories'))->toBeTrue();
});

test('product can be instantiated', function (): void {
    $product = new Product();
    $product->name = 'Test Product';
    $product->price_sale = 100.50;

    expect($product->name)->toBe('Test Product');
    expect($product->price_sale)->toBe(100.50);
});
