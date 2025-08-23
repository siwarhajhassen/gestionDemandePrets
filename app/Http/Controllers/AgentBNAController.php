<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\Complaint;
use App\Models\AgentBNA;
use App\Models\Note;
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
        $loanRequests = LoanRequest::with(['agriculteur.user', 'documents'])
            ->orderBy('submission_date', 'desc')
            ->paginate(10);
            
        $complaints = Complaint::with(['agriculteur.user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('agent.dashboard', compact('loanRequests', 'complaints'));
    }

    public function viewAllLoanRequests(Request $request)
    {
        $status = $request->get('status');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $query = LoanRequest::with(['agriculteur.user', 'documents']);

        if ($status) {
            $query->where('loan_status', $status);
        }

        if ($dateFrom && $dateTo) {
            $query->whereBetween('submission_date', [$dateFrom, $dateTo]);
        }

        $loanRequests = $query->orderBy('submission_date', 'desc')->paginate(10);

        return view('agent.loan-requests.index', compact('loanRequests'));
    }

    public function viewAllComplaints()
    {
        $complaints = Complaint::with(['agriculteur.user', 'responses'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('agent.complaints.index', compact('complaints'));
    }

    public function respondToComplaint(Request $request, $complaintId)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $complaint = Complaint::findOrFail($complaintId);
        $user = Auth::user();

        $response = $complaint->responses()->create([
            'agent_bna_id' => $user->agentBNA->id,
            'message' => $validated['message'],
            'created_at' => now(),
        ]);

        return redirect()->route('agent.complaints.show', $complaintId)
            ->with('success', 'Response sent successfully!');
    }

    public function requestMissingDocuments(Request $request, $loanRequestId)
    {
        $validated = $request->validate([
            'requested_documents' => 'required|array',
            'requested_documents.*' => 'string',
        ]);

        // Implementation for requesting missing documents
        // This could involve sending notifications, updating status, etc.

        return redirect()->route('agent.loan-requests.show', $loanRequestId)
            ->with('success', 'Documents requested successfully!');
    }

    public function openLoanRequest($id)
    {
        $loanRequest = LoanRequest::with(['agriculteur.user', 'documents', 'notes'])
            ->findOrFail($id);

        return view('agent.loan-requests.show', compact('loanRequest'));
    }

    public function addNoteToFile(Request $request, $loanRequestId)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $note = Note::create([
            'loan_request_id' => $loanRequestId,
            'content' => $validated['content'],
            'created_at' => now(),
        ]);

        return redirect()->route('agent.loan-requests.show', $loanRequestId)
            ->with('success', 'Note added successfully!');
    }

    public function changeLoanStatus(Request $request, $loanRequestId)
    {
        $validated = $request->validate([
            'new_status' => 'required|in:pending,approved,rejected,under_review',
            'comment' => 'required|string',
        ]);

        $loanRequest = LoanRequest::findOrFail($loanRequestId);
        $user = Auth::user();
        
        $loanRequest->update([
            'loan_status' => $validated['new_status'],
            'last_updated' => now(),
        ]);

        // Add a note about the status change
        Note::create([
            'loan_request_id' => $loanRequestId,
            'content' => "Status changed to {$validated['new_status']}: {$validated['comment']}",
            'created_at' => now(),
        ]);

        return redirect()->route('agent.loan-requests.show', $loanRequestId)
            ->with('success', 'Loan status updated successfully!');
    }
}