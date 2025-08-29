<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agriculteur;
use App\Models\AgentBNA;
use App\Models\Agence;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        $agences = Agence::all();
        return view('auth.register', compact('agences'));
    }

    public function register(Request $request)
    {
        // Validation pour agriculteur seulement
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'num_tel' => 'required|string|max:20',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'agence_id' => 'required|exists:agences,id',
            'cin' => 'required|string|max:255',
            'farm_address' => 'required|string',
            'farm_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Créer l'utilisateur
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'num_tel' => $request->num_tel,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // Créer le profil agriculteur avec statut "pending"
        $user->agriculteur()->create([
            'agence_id' => $request->agence_id,
            'CIN' => $request->cin,
            'farm_address' => $request->farm_address,
            'farm_type' => $request->farm_type,
            'status' => 'pending',
        ]);

        // Connecter l'utilisateur
        Auth::login($user);

        return redirect()->route('account.pending')
            ->with('success', 'Votre inscription a été enregistrée. Elle est en attente de validation administrative.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            // Vérifier le statut de l'agriculteur
            if (Auth::user()->isAgriculteur()) {
                $agriculteur = Auth::user()->agriculteur;
                
                if ($agriculteur->status === 'pending') {
                    return redirect()->route('account.pending')
                        ->with('info', 'Votre compte est en attente de validation.');
                }
                
                if ($agriculteur->status === 'rejected') {
                    return redirect()->route('account.rejected')
                        ->with('error', 'Votre compte a été rejeté.');
                }
            }
            
            // Redirection basée sur le type d'utilisateur
            if (Auth::user()->isAdmin()) {
                return redirect()->route('dashboard.admin'); // ← Redirection vers le dashboard admin
            }
            
            if (Auth::user()->isAgent()) {
                return redirect()->route('agent.dashboard'); // ← Redirection vers le dashboard agent
            }
            
            // Par défaut, rediriger vers le dashboard général
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Méthodes pour les pages d'attente et rejet
    public function showPendingPage()
    {
        if (!Auth::check() || !Auth::user()->isAgriculteur()) {
            return redirect()->route('login');
        }
        
        return view('auth.pending');
    }

    public function showRejectedPage()
    {
        if (!Auth::check() || !Auth::user()->isAgriculteur()) {
            return redirect()->route('login');
        }
        
        $reason = Auth::user()->agriculteur->rejection_reason;
        return view('auth.rejected', compact('reason'));
    }
}