<?php
namespace App\Http\Controllers;

use App\Models\AgentBNA;
use App\Models\User;
use Illuminate\Http\Request;

class AgentBNAController extends Controller
{
    public function index()
    {
        $agents = AgentBNA::with('user')->paginate(15);
        return view('agents.index', compact('agents'));
    }

    public function create()
    {
        $users = User::all();
        return view('agents.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:agents_bna,user_id',
            'employeeId' => 'required|string|unique:agents_bna,employeeId',
            'branch' => 'required|string|max:100',
        ]);

        AgentBNA::create($data);

        return redirect()->route('agents.index')->with('success', 'Agent BNA créé.');
    }

    public function show(AgentBNA $agent)
    {
        $agent->load('user');
        return view('agents.show', compact('agent'));
    }

    public function edit(AgentBNA $agent)
    {
        $users = User::all();
        return view('agents.edit', compact('agent', 'users'));
    }

    public function update(Request $request, AgentBNA $agent)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:agents_bna,user_id,' . $agent->id,
            'employeeId' => 'required|string|unique:agents_bna,employeeId,' . $agent->id,
            'branch' => 'required|string|max:100',
        ]);

        $agent->update($data);

        return redirect()->route('agents.index')->with('success', 'Agent BNA mis à jour.');
    }

    public function destroy(AgentBNA $agent)
    {
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'Agent BNA supprimé.');
    }
}
