<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\Agriculteur;
use Illuminate\Http\Request;

class LoanRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Charger les demandes avec les données de l'agriculteur
        $loanrequests = LoanRequest::with('agriculteur')->latest()->get();
        return view('loanrequests.index', compact('loanrequests'));
    }

    public function create()
    {
        $agriculteurs = Agriculteur::all();
        return view('loanrequests.create', compact('agriculteurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'applicant_id' => 'required|exists:agriculteurs,id',
            'amountRequested' => 'required|numeric|min:100',
            'purpose' => 'required|string|max:255',
            'submissionDate' => 'required|date',
        ]);

        LoanRequest::create($validated);

        return redirect()->route('loanrequests.index')
            ->with('success', 'Demande enregistrée avec succès.');
    }

    public function show(LoanRequest $loanrequest)
    {
        return view('loanrequests.show', compact('loanrequest'));
    }

    public function edit(LoanRequest $loanrequest)
    {
        $agriculteurs = Agriculteur::all();
        return view('loanrequests.edit', compact('loanrequest', 'agriculteurs'));
    }

    public function update(Request $request, LoanRequest $loanrequest)
    {
        $validated = $request->validate([
            'applicant_id' => 'required|exists:agriculteurs,id',
            'amountRequested' => 'required|numeric|min:100',
            'purpose' => 'required|string|max:255',
            'submissionDate' => 'required|date',
        ]);

        $loanrequest->update($validated);

        return redirect()->route('loanrequests.index')
            ->with('success', 'Demande mise à jour avec succès.');
    }

    public function destroy(LoanRequest $loanrequest)
    {
        $loanrequest->delete();
        return redirect()->route('loanrequests.index')
            ->with('success', 'Demande supprimée avec succès.');
    }

    public function validateLoan(LoanRequest $loanrequest)
    {
        $loanrequest->status = 'validé';
        $loanrequest->save();

        return redirect()->route('loanrequests.index')
            ->with('success', 'La demande de prêt a été validée avec succès.');
    }
}
