<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    // ... tes autres méthodes

    /**
     * Changer le statut d'une réclamation.
     */
    public function changeStatus(Request $request, Complaint $complaint)
    {
        // Validation simple pour le statut
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $complaint->status = $request->status;
        $complaint->save();

        return redirect()->route('complaints.index')
            ->with('success', 'Le statut de la réclamation a été mis à jour.');
    }
}

