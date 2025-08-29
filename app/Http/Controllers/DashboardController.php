<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        if ($user->agentBNA) {
            return redirect()->route('agent.dashboard');
        }
        
        if ($user->agriculteur) {
            $loanRequests = $user->agriculteur->loanRequests()->latest()->take(5)->get();
            $complaints = $user->agriculteur->complaints()->latest()->take(5)->get();
            
            return view('dashboard.agriculteur', compact('loanRequests', 'complaints'));
        }
        
        return view('dashboard');
    }
}