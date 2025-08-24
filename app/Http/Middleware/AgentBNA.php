<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentBNA
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->agentBNA) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Accès réservé aux agents BNA.');
    }
}