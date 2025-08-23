<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AgentBNA
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if user is an agent BNA
        if (!Auth::user()->agentBNA) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized. Agent BNA access required.');
        }

        return $next($request);
    }
}