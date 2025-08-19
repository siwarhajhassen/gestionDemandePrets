<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Http\Request;

class ActionLogController extends Controller
{
    public function index()
    {
        $logs = ActionLog::all();
        return view('actionlogs.index', compact('logs'));
    }

    public function create()
    {
        return view('actionlogs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // 'action_type' => 'required|string',
            // autres validations
        ]);

        ActionLog::create($data);
        return redirect()->route('actionlogs.index');
    }

    public function show(ActionLog $actionLog)
    {
        return view('actionlogs.show', compact('actionLog'));
    }

    public function edit(ActionLog $actionLog)
    {
        return view('actionlogs.edit', compact('actionLog'));
    }

    public function update(Request $request, ActionLog $actionLog)
    {
        $data = $request->validate([
            // mêmes règles que dans store()
        ]);

        $actionLog->update($data);
        return redirect()->route('actionlogs.index')->with('success', 'Journal d\'action mis à jour.');
    }

    public function destroy(ActionLog $actionLog)
    {
        $actionLog->delete();
        return redirect()->route('actionlogs.index')->with('success', 'Journal supprimé.');
    }
}
