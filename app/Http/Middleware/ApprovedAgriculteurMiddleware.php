<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApprovedAgriculteurMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isAgriculteur()) {
            $agriculteur = Auth::user()->agriculteur;
            
            if ($agriculteur->status === 'pending') {
                return redirect()->route('account.pending');
            }
            
            if ($agriculteur->status === 'rejected') {
                return redirect()->route('account.rejected');
            }
        }

        return $next($request);
    }
}