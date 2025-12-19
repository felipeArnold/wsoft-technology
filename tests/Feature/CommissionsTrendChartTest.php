<?php

declare(strict_types=1);

use App\Filament\Widgets\CommissionsTrendChart;
use Filament\Support\RawJs;
use ReflectionClass;
use Tests\TestCase;

uses(TestCase::class);

it('exposes currency formatter as RawJs', function (): void {
    $ref = new ReflectionClass(CommissionsTrendChart::class);
    $method = $ref->getMethod('currencyFormatter');
    $method->setAccessible(true);

    /** @var RawJs $raw */
    $raw = $method->invoke(null);

    expect($raw)->toBeInstanceOf(RawJs::class);
});
