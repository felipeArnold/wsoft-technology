<?php

declare(strict_types=1);

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Stripe\Price;
use Stripe\Product;
use Stripe\Stripe;

final class OficinaLeadController extends Controller
{
    public function index(): View
    {
        $priceData = $this->getStripeProductData();

        return view('landing.oficina', $priceData);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'company_name' => 'required|string|max:255',
        ], [
            'name.required' => 'O nome é obrigatório',
            'phone.required' => 'O telefone é obrigatório',
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'Digite um e-mail válido',
            'company_name.required' => 'O nome da empresa é obrigatório',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor, corrija os erros no formulário.');
        }

        try {
            Lead::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'source' => $request->input('source', 'landing_oficina'),
                'status' => 'novo',
            ]);

            return redirect()
                ->route('landing.oficina')
                ->with('success', 'Obrigado! Em breve nossa equipe entrará em contato.');
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Ocorreu um erro ao enviar seus dados. Tente novamente.');
        }
    }

    private function getStripeProductData(): array
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $priceId = config('cashier.stripe.price_ids.default.price_id');

            // Buscar informações do Price
            $price = Price::retrieve($priceId);

            // Buscar informações do Product
            $product = Product::retrieve($price->product);

            // Calcular valores
            $amount = $price->unit_amount / 100; // Stripe retorna em centavos
            $currency = mb_strtoupper($price->currency);
            $interval = $price->recurring->interval ?? 'month';
            $intervalLabel = $this->getIntervalLabel($interval);

            return [
                'product_name' => $product->name,
                'product_description' => $product->description ?? '',
                'price_amount' => $amount,
                'price_currency' => $currency,
                'price_formatted' => number_format($amount, 2, ',', '.'),
                'interval' => $interval,
                'interval_label' => $intervalLabel,
            ];
        } catch (Exception $e) {
            // Fallback para valores padrão caso falhe
            return [
                'product_name' => 'Plano Profissional',
                'product_description' => 'Sistema completo para gestão',
                'price_amount' => 47,
                'price_currency' => 'BRL',
                'price_formatted' => '47,00',
                'interval' => 'month',
                'interval_label' => 'mês',
            ];
        }
    }

    private function getIntervalLabel(string $interval): string
    {
        return match ($interval) {
            'day' => 'dia',
            'week' => 'semana',
            'month' => 'mês',
            'year' => 'ano',
            default => 'mês',
        };
    }
}
