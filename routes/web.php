<?php

declare(strict_types=1);

use App\Http\Controllers\BlogController;
use App\Http\Controllers\Landing\FunilariaLeadController;
use App\Http\Controllers\Landing\MecanicaLeadController;
use App\Http\Controllers\Landing\OficinaLeadController;
use App\Http\Controllers\Stripe\StripeBillingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Páginas informativas
Route::get('/beneficios', function () {
    return view('pages.beneficios');
})->name('pages.beneficios');

Route::get('/demonstracao', function () {
    return view('pages.demonstracao');
})->name('pages.demonstracao');

Route::get('/faq', function () {
    return view('pages.faq');
})->name('pages.faq');

// Landing Page para Software de Oficina
Route::get('/oficina', [OficinaLeadController::class, 'index'])->name('landing.oficina');
Route::post('/oficina/lead', [OficinaLeadController::class, 'store'])->name('landing.oficina.store');

// Landing Page para Sistema de Mecânica
Route::get('/mecanica', [MecanicaLeadController::class, 'index'])->name('landing.mecanica');
Route::post('/mecanica/lead', [MecanicaLeadController::class, 'store'])->name('landing.mecanica.store');

// Landing Page para Sistema de Funilaria
Route::get('/funilaria', [FunilariaLeadController::class, 'index'])->name('landing.funilaria');
Route::post('/funilaria/lead', [FunilariaLeadController::class, 'store'])->name('landing.funilaria.store');

// Landing Page para Sistema de Gestão de Clientes
Route::get('/sistema-para-gestao-de-clientes', function () {
    return view('site.gestao-clientes');
})->name('landing.gestao-clientes');

// Landing Page para Sistema de Gestão de Fornecedores
Route::get('/sistema-para-gestao-de-fornecedores', function () {
    return view('site.gestao-fornecedores');
})->name('landing.gestao-fornecedores');

// Landing Page para Sistema de Gestão de Estoque
Route::get('/sistema-para-gestao-de-estoque', function () {
    return view('site.gestao-estoque');
})->name('landing.gestao-estoque');

// Landing Page para Sistema de Contas a Pagar
Route::get('/sistema-para-contas-a-pagar', function () {
    return view('site.contas-pagar');
})->name('landing.contas-pagar');

// Landing Page para Sistema de Contas a Receber
Route::get('/sistema-para-contas-a-receber', function () {
    return view('site.contas-receber');
})->name('landing.contas-receber');

// Landing Page para Sistema de Controle de Inadimplência
Route::get('/sistema-para-controle-de-inadimplencia', function () {
    return view('site.controle-inadimplencia');
})->name('landing.controle-inadimplencia');

// Landing Page para Sistema de Fluxo de Caixa
Route::get('/sistema-para-fluxo-de-caixa', function () {
    return view('site.movimentacao-financeira');
})->name('landing.movimentacao-financeira');

// Stripe Billing Routes
Route::middleware(['auth'])->prefix('stripe')->name('stripe.')->group(function () {
    Route::get('/billing-portal/{tenant}', [StripeBillingController::class, 'billingPortal'])->name('billing-portal');
    Route::get('/invoices/{tenant}', [StripeBillingController::class, 'invoices'])->name('invoices');
    Route::get('/invoices/{tenant}/{invoiceId}/download', [StripeBillingController::class, 'downloadInvoice'])->name('invoice.download');
    Route::post('/subscription/cancel/{tenant}', [StripeBillingController::class, 'cancelSubscription'])->name('subscription.cancel');
    Route::post('/subscription/resume/{tenant}', [StripeBillingController::class, 'resumeSubscription'])->name('subscription.resume');
    Route::get('/checkout/{tenant}', [StripeBillingController::class, 'checkout'])->name('checkout');
});

// Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/categoria/{slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
Route::get('/feed', [App\Http\Controllers\FeedController::class, 'index'])->name('feed');

Route::get('/robots.txt', function () {
    return response()->view('seo.robots')->header('Content-Type', 'text/plain');
});

Route::view('/oferta-especial', 'landing.sales')->name('landing.sales');
