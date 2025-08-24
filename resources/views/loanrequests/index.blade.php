@extends('layouts.app')

@section('title', 'Mes demandes de prêt')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Mes demandes de prêt</h1>
    <a href="{{ route('loan-requests.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nouvelle demande
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($loanRequests->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Montant</th>
                            <th>Objectif</th>
                            <th>Statut</th>
                            <th>Date de soumission</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loanRequests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ number_format($request->amountRequested, 2) }} €</td>
                                <td>{{ Str::limit($request->purpose, 50) }}</td>
                                <td>
                                    <span class="badge bg-{{ $request->status == 'approved' ? 'success' : ($request->status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ $request->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($request->submissionDate)
                                        {{ $request->submissionDate->format('d/m/Y H:i') }}
                                    @else
                                        Non soumis
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('loan-requests.show', $request->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($request->status == 'draft')
                                        <a href="{{ route('loan-requests.edit', $request->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('loan-requests.submit', $request->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir soumettre cette demande ?')">
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Aucune demande de prêt pour le moment.</p>
        @endif
    </div>
</div>
@endsection