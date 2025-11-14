<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class EnsureTenantOne
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Filament::auth()->user();

        // Se não estiver autenticado, deixa o middleware de autenticação lidar
        if (! $user) {
            return $next($request);
        }

        // Verifica se o usuário pertence ao tenant com ID 1
        $belongsToTenantOne = $user->tenants()
            ->where('tenants.id', 1)
            ->exists();

        if (! $belongsToTenantOne) {
            abort(403, 'Acesso negado. Esta área é restrita a administradores do sistema.');
        }

        return $next($request);
    }
}
