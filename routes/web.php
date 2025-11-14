<?php

declare(strict_types=1);

use App\Http\Controllers\Landing\OficinaLeadController;
use App\Http\Controllers\Stripe\StripeBillingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Landing Page para Software de Oficina
Route::get('/oficina', [OficinaLeadController::class, 'index'])->name('landing.oficina');

Route::post('/oficina/lead', [OficinaLeadController::class, 'store'])->name('landing.oficina.store');

// Stripe Billing Routes
Route::middleware(['auth'])->prefix('stripe')->name('stripe.')->group(function () {
    Route::get('/billing-portal/{tenant}', [StripeBillingController::class, 'billingPortal'])->name('billing-portal');
    Route::get('/invoices/{tenant}', [StripeBillingController::class, 'invoices'])->name('invoices');
    Route::get('/invoices/{tenant}/{invoiceId}/download', [StripeBillingController::class, 'downloadInvoice'])->name('invoice.download');
    Route::post('/subscription/cancel/{tenant}', [StripeBillingController::class, 'cancelSubscription'])->name('subscription.cancel');
    Route::post('/subscription/resume/{tenant}', [StripeBillingController::class, 'resumeSubscription'])->name('subscription.resume');
    Route::get('/checkout/{tenant}', [StripeBillingController::class, 'checkout'])->name('checkout');
});
