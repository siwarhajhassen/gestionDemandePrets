<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agriculteur;
use App\Models\AgentBNA;
use App\Models\User;
use App\Models\Agence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\LoanRequest;

class AdminController extends Controller
{
     public function dashboard()
    {
        $pendingAgriculteurs = Agriculteur::with(['user', 'agence'])
            ->where('status', 'pending')
            ->count();

        $totalAgents = AgentBNA::count();
        $totalAgences = Agence::count();
        $totalLoanRequests = \App\Models\LoanRequest::count();

        return view('dashboard.admin', compact(
            'pendingAgriculteurs',
            'totalAgents',
            'totalAgences',
        'totalLoanRequests'
        ));
    }

    public function pendingAgriculteurs()
    {
        $agriculteurs = Agriculteur::with(['user', 'agence'])
            ->where('status', 'pending')
            ->paginate(10);

        return view('admin.agriculteurs.pending', compact('agriculteurs'));
    }

    public function approveAgriculteur($id)
    {
        $agriculteur = Agriculteur::findOrFail($id);
        $agriculteur->update(['status' => 'approved']);

        return redirect()->back()
            ->with('success', 'Compte agriculteur approuvé avec succès.');
    }

    public function rejectAgriculteur(Request $request, $id)
    {
        $request->validate(['reason' => 'required|string|max:500']);

        $agriculteur = Agriculteur::findOrFail($id);
        $agriculteur->update([
            'status' => 'rejected',
            'rejection_reason' => $request->reason
        ]);

        return redirect()->back()
            ->with('success', 'Compte agriculteur rejeté avec succès.');
    }

    public function agentsIndex()
    {
        $agents = AgentBNA::with(['user', 'agence'])->paginate(10);
        return view('admin.agents.index', compact('agents'));
    }

    public function createAgent()
    {
        $agences = Agence::all();
        return view('admin.agents.create', compact('agences'));
    }

    public function storeAgent(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'num_tel' => 'required|string|max:20|unique:users,num_tel', // ← Validation pour num_tel
            'username' => 'required|string|max:255|unique:users,username', // ← Validation pour username
            'employee_id' => 'required|string|max:255|unique:agent_bna,employee_id',
            'agence_id' => 'required|exists:agences,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'num_tel' => $request->num_tel, // ← Ajout de num_tel
            'username' => $request->username, // ← Ajout de username (au lieu de l'email)
            'password' => Hash::make($request->password),
        ]);

        AgentBNA::create([
            'user_id' => $user->id,
            'agence_id' => $request->agence_id,
            'employee_id' => $request->employee_id,
        ]);

        return redirect()->route('admin.agents.index')
            ->with('success', 'Agent créé avec succès.');
    }

    public function destroyAgent($id)
    {
        $agent = AgentBNA::findOrFail($id);
        $userId = $agent->user_id;
        
        $agent->delete();
        User::find($userId)->delete();

        return redirect()->back()
            ->with('success', 'Agent supprimé avec succès.');
    }

    public function agencesIndex()
    {
        $agences = Agence::paginate(10);
        return view('admin.agences.index', compact('agences'));
    }

    public function createAgence()
    {
        return view('admin.agences.create');
    }

    public function storeAgence(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:agences,code',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        Agence::create($request->all());

        return redirect()->route('admin.agences.index')
            ->with('success', 'Agence créée avec succès.');
    }

    public function destroyAgence($id)
    {
        $agence = Agence::findOrFail($id);
        
        // Vérifier si l'agence est utilisée
        if ($agence->agriculteurs()->exists() || $agence->agents()->exists()) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer cette agence car elle est utilisée.');
        }

        $agence->delete();

        return redirect()->back()
            ->with('success', 'Agence supprimée avec succès.');
    }
}
