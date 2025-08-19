<?php
namespace App\Http\Controllers;

use App\Models\Agriculteur;
use App\Models\User;
use Illuminate\Http\Request;

class AgriculteurController extends Controller
{
    public function index()
    {
        $agriculteurs = Agriculteur::with('user')->paginate(15);
        return view('agriculteurs.index', compact('agriculteurs'));
    }

    public function create()
    {
        $users = User::all(); // liste des users pour associer
        return view('agriculteurs.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:agriculteurs,user_id',
            'nationalId' => 'required|string|unique:agriculteurs,nationalId',
            'farmAddress' => 'required|string|max:255',
            'farmType' => 'required|string|max:100',
        ]);

        Agriculteur::create($data);

        return redirect()->route('agriculteurs.index')->with('success', 'Agriculteur créé.');
    }

    public function show(Agriculteur $agriculteur)
    {
        $agriculteur->load('user');
        return view('agriculteurs.show', compact('agriculteur'));
    }

    public function edit(Agriculteur $agriculteur)
    {
        $users = User::all();
        return view('agriculteurs.edit', compact('agriculteur', 'users'));
    }

    public function update(Request $request, Agriculteur $agriculteur)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:agriculteurs,user_id,' . $agriculteur->id,
            'nationalId' => 'required|string|unique:agriculteurs,nationalId,' . $agriculteur->id,
            'farmAddress' => 'required|string|max:255',
            'farmType' => 'required|string|max:100',
        ]);

        $agriculteur->update($data);

        return redirect()->route('agriculteurs.index')->with('success', 'Agriculteur mis à jour.');
    }

    public function destroy(Agriculteur $agriculteur)
    {
        $agriculteur->delete();
        return redirect()->route('agriculteurs.index')->with('success', 'Agriculteur supprimé.');
    }
}
