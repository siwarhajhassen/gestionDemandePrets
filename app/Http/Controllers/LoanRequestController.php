<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\Document;
use App\Models\Agriculteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        // Validate the request
        $validated = $request->validate([
            'amount_requested' => 'required|numeric|min:1000',
            'loan_duration' => 'required|in:12,24,36,48,60',
            'purpose' => 'required|string|max:2000',
            'farm_type' => 'required|string|max:255',
            'land_size' => 'required|numeric|min:0.01',
            'project_description' => 'required|string|max:2000',
            'expected_start_date' => 'required|date|after:today',
            'expected_completion_date' => 'required|date|after:expected_start_date',
            'additional_notes' => 'nullable|string|max:1000',
            
            // File validations
            'land_documents' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'identity_documents' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'financial_documents' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'farming_plan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'additional_documents' => 'nullable|array',
            'additional_documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        try {
            // Create the loan request avec les bons noms de colonnes
            $loanRequest = $user->agriculteur->loanRequests()->create([
                'amountRequested' => $validated['amount_requested'], // amountRequested au lieu de amount_requested
                'purpose' => $validated['purpose'],
                'status' => 'submitted', // status au lieu de loan_status
                'submissionDate' => now(), // submissionDate au lieu de submission_date
                'lastUpdated' => now(), // lastUpdated au lieu de last_updated
                'loan_duration' => $validated['loan_duration'],
                'farm_type' => $validated['farm_type'],
                'land_size' => $validated['land_size'],
                'project_description' => $validated['project_description'],
                'expected_start_date' => $validated['expected_start_date'],
                'expected_completion_date' => $validated['expected_completion_date'],
                'additional_notes' => $validated['additional_notes'] ?? null,
            ]);

            // Create directory for this loan request's documents
            $loanRequestDirectory = 'loan_documents/' . $loanRequest->id;
            
            // Store required documents
            $this->storeDocument($request->file('land_documents'), 'land_documents', $loanRequest, $loanRequestDirectory);
            $this->storeDocument($request->file('identity_documents'), 'identity_documents', $loanRequest, $loanRequestDirectory);
            $this->storeDocument($request->file('financial_documents'), 'financial_documents', $loanRequest, $loanRequestDirectory);
            $this->storeDocument($request->file('farming_plan'), 'farming_plan', $loanRequest, $loanRequestDirectory);

            // Store additional documents if any
            if ($request->hasFile('additional_documents')) {
                foreach ($request->file('additional_documents') as $index => $file) {
                    $this->storeDocument($file, 'additional_document_' . ($index + 1), $loanRequest, $loanRequestDirectory);
                }
            }

            return redirect()->route('loanrequests.show', $loanRequest->id)
                ->with('success', 'Votre demande de prêt a été soumise avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la soumission de votre demande: ' . $e->getMessage());
        }
    }

    /**
     * Store a document in filesystem and create database record
     */
    private function storeDocument($file, $documentType, $loanRequest, $directory)
    {
        if (!$file) {
            return null;
        }

        // Generate unique filename
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '_' . time() . '.' . $extension;
        
        // Store file in filesystem
        $path = $file->storeAs($directory, $filename);

        // Create document record in database
        return Document::create([
            'loan_request_id' => $loanRequest->id,
            'file_name' => $originalName,
            'file_type' => $file->getClientMimeType(),
            'storage_path' => $path,
            'document_type' => $documentType,
            'uploaded_at' => now(),
        ]);
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
        
        // Create directory for documents
        $directory = 'documents/' . $loanRequestId;
        
        // Generate unique filename
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '_' . time() . '.' . $extension;
        
        // Store file in filesystem
        $path = $file->storeAs($directory, $filename);

        // Create document record in database
        $document = Document::create([
            'loan_request_id' => $loanRequestId,
            'file_name' => $originalName,
            'file_type' => $file->getClientMimeType(),
            'storage_path' => $path,
            'document_type' => $request->type,
            'uploaded_at' => now(),
        ]);

        return redirect()->route('loanrequests.show', $loanRequestId)
            ->with('success', 'Document uploaded successfully!');
    }

    public function downloadDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        $user = Auth::user();
        
        // Check authorization
        if ($user->agriculteur && $document->loanRequest->agriculteur_id !== $user->agriculteur->id) {
            abort(403, 'Unauthorized');
        }

        // Check if file exists
        if (!Storage::exists($document->storage_path)) {
            abort(404, 'File not found');
        }

        return Storage::download($document->storage_path, $document->file_name);
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

}