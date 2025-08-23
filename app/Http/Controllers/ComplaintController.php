<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Agriculteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->agriculteur) {
            $complaints = $user->agriculteur->complaints()->with('responses')->get();
            return view('complaints.index', compact('complaints'));
        }
        
        return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->agriculteur) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $complaint = $user->agriculteur->complaints()->create([
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'open',
            'created_at' => now(),
        ]);

        return redirect()->route('complaints.show', $complaint->id)
            ->with('success', 'Complaint submitted successfully!');
    }

    public function show($id)
    {
        $complaint = Complaint::with('responses')->findOrFail($id);
        $user = Auth::user();
        
        // Check authorization
        if ($user->agriculteur && $complaint->agriculteur_id !== $user->agriculteur->id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        return view('complaints.show', compact('complaint'));
    }
}