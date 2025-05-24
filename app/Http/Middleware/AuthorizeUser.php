<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user_role = $request->user()->getRole();

        if (in_array($user_role, $roles)) {
            return $next($request);
        }

        // Jika request adalah AJAX (XHR)
        if (!$request->ajax()) {
             // Jika bukan AJAX, langsung abort 403 dengan pesan custom
            abort(403, 'Forbidden. Kamu tidak punya akses ke halaman ini');
        } else {
            return response('', 403);
        }
    }
}

