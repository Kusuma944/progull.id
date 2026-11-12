<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Pemakaian di route: ->middleware(['auth', 'role:admin'])
     * Bisa lebih dari satu role: role:admin,customer
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // akun yang diblokir saat sedang login langsung dikeluarkan
        if ($user && ! $user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->withErrors(['email' => 'Akun kamu diblokir. Hubungi admin.']);
        }

        if (! $user || ! in_array($user->role, $roles, true)) {
            abort(403, 'Kamu tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}
