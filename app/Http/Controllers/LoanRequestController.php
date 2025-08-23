<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\Document;
use App\Models\Agriculteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LoanRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->agriculteur) {
            $loanRequests = $user->agriculteur->loanRequests()->with('documents')->get();
            return view('loanrequests.index', compact('loanRequests'));
        }
        
        return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
    }

    public function create()
    {
        return view('loanrequests.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->agriculteur) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $validated = $request->validate([
            'amount_requested' => 'required|numeric|min:0',
            'purpose' => 'required|string|max:500',
        ]);

        $loanRequest = $user->agriculteur->loanRequests()->create([
            'amount_requested' => $validated['amount_requested'],
            'purpose' => $validated['purpose'],
            'loan_status' => 'draft',
            'submission_date' => now(),
            'last_updated' => now(),
        ]);

        return redirect()->route('loanrequests.show', $loanRequest->id)
            ->with('success', 'Loan request created successfully!');
    }

    public function show($id)
    {
        $loanRequest = LoanRequest::with(['documents', 'notes'])->findOrFail($id);
        $user = Auth::user();
        
        // Check authorization
        if ($user->agriculteur && $loanRequest->agriculteur_id !== $user->agriculteur->id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        return view('loanrequests.show', compact('loanRequest'));
    }

    public function edit($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        $user = Auth::user();
        
        // Check authorization
        if ($user->agriculteur && $loanRequest->agriculteur_id !== $user->agriculteur->id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        return view('loanrequests.edit', compact('loanRequest'));
    }

    public function update(Request $request, $id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        $user = Auth::user();
        
        // Check authorization
        if ($user->agriculteur && $loanRequest->agriculteur_id !== $user->agriculteur->id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $validated = $request->validate([
            'amount_requested' => 'sometimes|numeric|min:0',
            'purpose' => 'sometimes|string|max:500',
        ]);

        $loanRequest->update($validated);
        $loanRequest->update(['last_updated' => now()]);

        return redirect()->route('loanrequests.show', $loanRequest->id)
            ->with('success', 'Loan request updated successfully!');
    }

    public function submit($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        $user = Auth::user();
        
        // Check authorization
        if ($user->agriculteur && $loanRequest->agriculteur_id !== $user->agriculteur->id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $loanRequest->update([
            'loan_status' => 'submitted',
            'submission_date' => now(),
            'last_updated' => now(),
        ]);

        return redirect()->route('loanrequests.show', $loanRequest->id)
            ->with('success', 'Loan request submitted successfully!');
    }

    public function addDocument(Request $request, $loanRequestId)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'type' => 'required|string',
        ]);

        $loanRequest = LoanRequest::findOrFail($loanRequestId);
        $user = Auth::user();
        
        // Check authorization
        if ($user->agriculteur && $loanRequest->agriculteur_id !== $user->agriculteur->id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $file = $request->file('file');
        $path = $file->store('documents');

        $document = $loanRequest->documents()->create([
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getClientMimeType(),
            'storage_path' => $path,
            'document_type' => $request->type,
            'uploaded_at' => now(),
        ]);

        return redirect()->route('loanrequests.show', $loanRequestId)
            ->with('success', 'Document uploaded successfully!');
    }
}