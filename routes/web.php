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

Route::view('/quem-somos', 'site.quem-somos')->name('site.quem-somos');

// Landing Page para Software de Oficina
Route::get('/oficina', [OficinaLeadController::class, 'index'])->name('landing.oficina');
Route::post('/oficina/lead', [OficinaLeadController::class, 'store'])->name('landing.oficina.store');

// Landing Page para Sistema de Mecânica
Route::get('/software-gestao-oficina-mecanica', [MecanicaLeadController::class, 'index'])->name('landing.mecanica');
Route::post('/software-gestao-oficina-mecanica/lead', [MecanicaLeadController::class, 'store'])->name('landing.mecanica.store');

// 301 Redirect from old URL to new SEO-optimized URL
Route::redirect('/mecanica', '/software-gestao-oficina-mecanica', 301);

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

// Landing Page para Sistema de Ordem de Serviço
Route::get('/sistema-ordem-servico', function () {
    return view('site.ordem-servico');
})->name('landing.ordem-servico');

// Landing Page para Sistema para Barbearia
Route::get('/sistema-para-barbearia', function () {
    return view('site.barbearia');
})->name('landing.barbearia');

// Landing Page para Salão de Beleza
Route::get('/sistema-para-salao-de-beleza', function () {
    return view('site.salao-beleza');
})->name('landing.salao-beleza');

// Landing Page para Clínica de Estética
Route::get('/sistema-para-clinica-estetica', function () {
    return view('site.clinica-estetica');
})->name('landing.clinica-estetica');

// Landing Page para Loja de Roupas
Route::get('/sistema-para-loja-de-roupas', function () {
    return view('site.loja-roupas');
})->name('landing.loja-roupas');

// Landing Page para Pet Shop
Route::get('/sistema-para-pet-shop', function () {
    return view('site.pet-shop');
})->name('landing.pet-shop');

// Landing Page para Pizzaria
Route::get('/sistema-para-pizzaria', function () {
    return view('site.pizzaria');
})->name('landing.pizzaria');

// Landing Page para Lava Rápido
Route::get('/sistema-para-lava-rapido', function () {
    return view('site.lava-rapido');
})->name('landing.lava-rapido');

// Landing Page para Assinatura Digital
Route::get('/assinatura-digital', function () {
    return view('site.assinatura-digital');
})->name('landing.assinatura-digital');

// Stripe Billing Routes
Route::middleware(['auth'])->prefix('stripe')->name('stripe.')->group(function (): void {
    Route::get('/billing-portal/{tenant}', [StripeBillingController::class, 'billingPortal'])->name('billing-portal');
    Route::get('/invoices/{tenant}', [StripeBillingController::class, 'invoices'])->name('invoices');
    Route::get('/invoices/{tenant}/{invoiceId}/download', [StripeBillingController::class, 'downloadInvoice'])->name('invoice.download');
    Route::post('/subscription/cancel/{tenant}', [StripeBillingController::class, 'cancelSubscription'])->name('subscription.cancel');
    Route::post('/subscription/resume/{tenant}', [StripeBillingController::class, 'resumeSubscription'])->name('subscription.resume');
    Route::get('/checkout/{tenant}', [StripeBillingController::class, 'checkout'])->name('checkout');
});

// Blog Routes
Route::prefix('blog')->name('blog.')->group(function (): void {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/categoria/{slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
Route::get('/feed', [App\Http\Controllers\FeedController::class, 'index'])->name('feed');

Route::get('/robots.txt', function () {
    return response()->view('seo.robots')->header('Content-Type', 'text/plain');
});

Route::get('/llms.txt', function () {
    return response()->view('seo.llms')->header('Content-Type', 'text/plain; charset=utf-8');
});

// IndexNow verification file
Route::get('/{key}.txt', function (string $key) {
    $indexNowKey = config('services.indexnow.key', '');

    if ($key === $indexNowKey) {
        return response($indexNowKey, 200)->header('Content-Type', 'text/plain');
    }

    abort(404);
})->where('key', '[a-f0-9]{32}');

Route::view('/oferta-especial', 'landing.sales')->name('landing.sales');

// Landing Page para CRM e Gestão Empresarial
Route::view('/crm-gestao-empresarial', 'landing.crm-gestao')->name('landing.crm-gestao');

// Landing Page para Software Sob Medida
Route::view('/software-sob-medida', 'site.software-sob-medida')->name('landing.software-sob-medida');

// Landing Page para Sistema White Label
Route::view('/sistema-white-label-para-revenda', 'site.white-label')->name('landing.white-label');

// Landing Page para Revenda Mecânica
Route::view('/revenda-sistema-oficina', 'landing.revenda-mecanica')->name('landing.revenda-mecanica');

// Landing Page para Oficina Automóvel (Portugal - PT-PT)
Route::get('/pt-pt/software-gestao-oficina-automovel', function () {
    return view('landing.pt-pt.software-gestao-oficina-automovel');
})->name('landing.pt-pt.oficina-automovel');
