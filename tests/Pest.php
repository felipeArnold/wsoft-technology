<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test function is set up once, then
| run for each individual test case. We recommend using closures
| to make your tests cleaner and provide better type hints.
|
*/

uses(Illuminate\Foundation\Testing\TestCase::class)
    ->beforeEach(function () {
        //
    })
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| Here you may define all of your expectations for your tests. These
| expectations are used by Pest to verify that your code behaves as
| expected. You can add as many expectations as you like.
|
*/

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is not a framework, it provides some helpful functions
| that you can use to make your tests more readable and maintainable.
|
*/

uses(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Unit');

uses(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature');