<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\Complaint;
use App\Models\AgentBNA;
use App\Models\Note;
use App\Models\Response;
use App\Models\Agence;
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
        $agent = $user->agentBNA;
        
        // Vérifier que l'agent a une agence
        if (!$agent->agence) {
            abort(403, 'Agent non assigné à une agence.');
        }
        
        $agence = $agent->agence;

        // Statistiques filtrées par agence
        $stats = [
            'total_complaints' => Complaint::whereHas('agriculteur', function($query) use ($agence) {
                $query->where('agence_id', $agence->id);
            })->count(),
            
            'open_complaints' => Complaint::where('status', 'open')
                ->whereHas('agriculteur', function($query) use ($agence) {
                    $query->where('agence_id', $agence->id);
                })->count(),
                
            'total_loan_requests' => LoanRequest::where('agence_id', $agence->id)->count(),
            
            'pending_loan_requests' => LoanRequest::where('status', 'submitted')
                ->where('agence_id', $agence->id)->count(),
        ];

        // Réclamations récentes de l'agence
        $recentComplaints = Complaint::with(['agriculteur.user'])
            ->whereHas('agriculteur', function($query) use ($agence) {
                $query->where('agence_id', $agence->id);
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Demandes de prêt récentes de l'agence
        $recentLoanRequests = LoanRequest::with(['agriculteur.user'])
            ->where('agence_id', $agence->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.agent', compact('stats', 'recentComplaints', 'recentLoanRequests', 'agence'));
    }

    public function viewAllLoanRequests(Request $request)
    {
        $user = Auth::user();
        $agent = $user->agentBNA;
        
        if (!$agent->agence) {
            abort(403, 'Agent non assigné à une agence.');
        }
        
        $agence = $agent->agence;
        $status = $request->get('status', 'all');
        
        $query = LoanRequest::with(['agriculteur.user', 'documents'])
            ->where('agence_id', $agence->id);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $loanRequests = $query->orderBy('submissionDate', 'desc')->paginate(10);

        return view('loanrequests.agent.index', compact('loanRequests', 'status', 'agence'));
    }

    public function viewAllComplaints(Request $request)
    {
        $user = Auth::user();
        $agent = $user->agentBNA;
        
        if (!$agent->agence) {
            abort(403, 'Agent non assigné à une agence.');
        }
        
        $agence = $agent->agence;
        $status = $request->get('status', 'all');
        
        $query = Complaint::with(['agriculteur.user', 'responses'])
            ->whereHas('agriculteur', function($query) use ($agence) {
                $query->where('agence_id', $agence->id);
            });

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $complaints = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('complaints.agent.index', compact('complaints', 'status', 'agence'));
    }

    public function showComplaint($id)
    {
        $user = Auth::user();
        $agent = $user->agentBNA;
        
        if (!$agent->agence) {
            abort(403, 'Agent non assigné à une agence.');
        }
        
        $complaint = Complaint::with(['agriculteur.user', 'responses.agentBNA.user'])
            ->findOrFail($id);
            
        // Vérifier que la réclamation appartient à l'agence de l'agent
        if ($complaint->agriculteur->agence_id !== $agent->agence_id) {
            abort(403, 'Accès non autorisé à cette réclamation.');
        }

        return view('complaints.agent.show', compact('complaint'));
    }

    public function respondToComplaint(Request $request, $id)
    {
        $user = Auth::user();
        $agent = $user->agentBNA;
        
        if (!$agent->agence) {
            abort(403, 'Agent non assigné à une agence.');
        }
        
        $request->validate([
            'message' => 'required|string|min:10',
        ]);

        $complaint = Complaint::findOrFail($id);
        
        // Vérifier que la réclamation appartient à l'agence de l'agent
        if ($complaint->agriculteur->agence_id !== $agent->agence_id) {
            abort(403, 'Accès non autorisé à cette réclamation.');
        }

        // Créer la réponse
        $response = Response::create([
            'complaint_id' => $id,
            'agent_bna_id' => $agent->id,
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
        $user = Auth::user();
        $agent = $user->agentBNA;
        
        if (!$agent->agence) {
            abort(403, 'Agent non assigné à une agence.');
        }
        
        $complaint = Complaint::findOrFail($id);
        
        // Vérifier que la réclamation appartient à l'agence de l'agent
        if ($complaint->agriculteur->agence_id !== $agent->agence_id) {
            abort(403, 'Accès non autorisé à cette réclamation.');
        }
        
        $complaint->update(['status' => 'resolved']);

        return redirect()->back()
            ->with('success', 'Réclamation marquée comme résolue!');
    }

    public function openLoanRequest($id)
    {
        $user = Auth::user();
        $agent = $user->agentBNA;
        
        if (!$agent->agence) {
            abort(403, 'Agent non assigné à une agence.');
        }
        
        $loanRequest = LoanRequest::with([
            'agriculteur.user', 
            'documents', 
            'notes'
        ])->findOrFail($id);
        
        // Vérifier que la demande appartient à l'agence de l'agent
        if ($loanRequest->agence_id !== $agent->agence_id) {
            abort(403, 'Accès non autorisé à cette demande de prêt.');
        }

        return view('loanrequests.agent.show', compact('loanRequest'));
    }

    public function changeLoanStatus(Request $request, $id)
    {
        $user = Auth::user();
        $agent = $user->agentBNA;
        
        if (!$agent->agence) {
            abort(403, 'Agent non assigné à une agence.');
        }
        
        $request->validate([
            'status' => 'required|in:submitted,pending,approved,rejected,under_review',
            'comment' => 'required|string|min:10',
        ]);

        $loanRequest = LoanRequest::findOrFail($id);
        
        // Vérifier que la demande appartient à l'agence de l'agent
        if ($loanRequest->agence_id !== $agent->agence_id) {
            abort(403, 'Accès non autorisé à cette demande de prêt.');
        }

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
        $user = Auth::user();
        $agent = $user->agentBNA;
        
        if (!$agent->agence) {
            abort(403, 'Agent non assigné à une agence.');
        }
        
        $request->validate([
            'message' => 'required|string|min:10',
            'requested_documents' => 'required|array',
            'requested_documents.*' => 'string',
        ]);

        $loanRequest = LoanRequest::findOrFail($id);
        
        // Vérifier que la demande appartient à l'agence de l'agent
        if ($loanRequest->agence_id !== $agent->agence_id) {
            abort(403, 'Accès non autorisé à cette demande de prêt.');
        }

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
        $user = Auth::user();
        $agent = $user->agentBNA;
        
        if (!$agent->agence) {
            abort(403, 'Agent non assigné à une agence.');
        }
        
        $request->validate([
            'content' => 'required|string|min:10',
        ]);

        $loanRequest = LoanRequest::findOrFail($id);
        
        // Vérifier que la demande appartient à l'agence de l'agent
        if ($loanRequest->agence_id !== $agent->agence_id) {
            abort(403, 'Accès non autorisé à cette demande de prêt.');
        }

        $note = $loanRequest->notes()->create([
            'content' => $request->content,
        ]);

        return redirect()->back()
            ->with('success', 'Note ajoutée avec succès!');
    }
}