<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admins')->check(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/login-admin');
        }
        if (Auth::guard('admins')->check(['email' => $request->email, 'password' => $request->password])) {
            config(['session.lifetime' => 120]);
        }


        return $next($request);
    }
}
