<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\Complaint;
use App\Models\AgentBNA;
use App\Models\Note;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentBNAController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('agent.bna');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $agencyId = $user->agentBNA->agency_id;

        // Statistiques
        $stats = [
            'total_complaints' => Complaint::count(),
            'open_complaints' => Complaint::where('status', 'open')->count(),
            'total_loan_requests' => LoanRequest::count(),
            'pending_loan_requests' => LoanRequest::where('status', 'submitted')->count(),
        ];

        // Réclamations récentes
        $recentComplaints = Complaint::with(['agriculteur.user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Demandes de prêt récentes
        $recentLoanRequests = LoanRequest::with(['agriculteur.user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.agent', compact('stats', 'recentComplaints', 'recentLoanRequests'));
    }

    public function viewAllLoanRequests(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = LoanRequest::with(['agriculteur.user', 'documents']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $loanRequests = $query->orderBy('submissionDate', 'desc')->paginate(10);

        return view('loanrequests.agent.index', compact('loanRequests', 'status'));
    }

    public function viewAllComplaints(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = Complaint::with(['agriculteur.user', 'responses']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $complaints = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('complaints.agent.index', compact('complaints', 'status'));
    }

    public function showComplaint($id)
    {
        $complaint = Complaint::with(['agriculteur.user', 'responses.agentBNA.user'])
            ->findOrFail($id);

        return view('complaints.agent.show', compact('complaint'));
    }

    public function respondToComplaint(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|min:10',
        ]);

        $complaint = Complaint::findOrFail($id);
        $user = Auth::user();

        // Créer la réponse
        $response = Response::create([
            'complaint_id' => $id,
            'agent_bna_id' => $user->agentBNA->id,
            'message' => $request->message,
        ]);

        // Mettre à jour le statut de la réclamation
        $complaint->update([
            'status' => 'in_progress'
        ]);

        return redirect()->back()
            ->with('success', 'Réponse envoyée avec succès!');
    }

    public function closeComplaint($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->update(['status' => 'resolved']);

        return redirect()->back()
            ->with('success', 'Réclamation marquée comme résolue!');
    }

    public function openLoanRequest($id)
    {
        $loanRequest = LoanRequest::with([
            'agriculteur.user', 
            'documents', 
            'notes'
        ])->findOrFail($id);

        return view('loanrequests.agent.show', compact('loanRequest'));
    }

    public function changeLoanStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:submitted,pending,approved,rejected,under_review',
            'comment' => 'required|string|min:10',
        ]);

        $loanRequest = LoanRequest::findOrFail($id);

        $loanRequest->update([
            'status' => $request->status,
            'lastUpdated' => now(),
        ]);

        // Ajouter une note
        $loanRequest->notes()->create([
            'content' => "Statut changé à {$request->status}: {$request->comment}",
        ]);

        return redirect()->back()
            ->with('success', 'Statut de la demande mis à jour avec succès!');
    }

    public function requestMissingDocuments(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|min:10',
            'requested_documents' => 'required|array',
            'requested_documents.*' => 'string',
        ]);

        $loanRequest = LoanRequest::findOrFail($id);

        // Ajouter une note pour demander des documents
        $documentsList = implode(', ', $request->requested_documents);
        $loanRequest->notes()->create([
            'content' => "Documents demandés: {$documentsList}. Message: {$request->message}",
        ]);

        // Changer le statut
        $loanRequest->update([
            'status' => 'under_review',
            'lastUpdated' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Demande de documents envoyée avec succès!');
    }

    public function addNoteToFile(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|min:10',
        ]);

        $loanRequest = LoanRequest::findOrFail($id);

        $note = $loanRequest->notes()->create([
            'content' => $request->content,
        ]);

        return redirect()->back()
            ->with('success', 'Note ajoutée avec succès!');
    }
}