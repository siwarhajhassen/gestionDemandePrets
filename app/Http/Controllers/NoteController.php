<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\LoanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index($loanRequestId)
    {
        $loanRequest = LoanRequest::findOrFail($loanRequestId);
        $user = Auth::user();
        
        // Check authorization
        if ($user->agriculteur && $loanRequest->agriculteur_id !== $user->agriculteur->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($loanRequest->notes);
    }

    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);
        $loanRequest = $note->loanRequest;
        $user = Auth::user();
        
        // Check authorization - only agent BNA can edit notes
        if (!$user->agentBNA) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $note->edit($validated['content']);

        return response()->json($note);
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $user = Auth::user();
        
        // Check authorization - only agent BNA can delete notes
        if (!$user->agentBNA) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $note->delete();

        return response()->json(['message' => 'Note deleted successfully']);
    }
}