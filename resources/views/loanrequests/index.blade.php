@extends('layouts.app')

@section('title', 'Demandes de prêt')

@section('content')
<h2>Demandes de prêt</h2>
<a href="{{ route('loanrequests.create') }}" class="btn btn-success mb-3">Nouvelle demande</a>

@if($loanrequests->count())
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Agriculteur</th>
                <th>Montant</th>
                <th>Objet</th>
                <th>Statut</th>
                <th>Soumise le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loanrequests as $loan)
                <tr>
                    <td>{{ $loan->agriculteur->fullName ?? '-' }}</td>
                    <td>{{ number_format($loan->amountRequested, 2, ',', ' ') }} DZD</td>
                    <td>{{ $loan->purpose }}</td>
                    <td>
                        <span class="badge 
                            {{ $loan->status == 'validé' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($loan->submissionDate)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('loanrequests.show', $loan->id) }}" class="btn btn-sm btn-outline-success">Voir</a>
                        <a href="{{ route('loanrequests.edit', $loan->id) }}" class="btn btn-sm btn-outline-primary">Modifier</a>

                        @if($loan->status !== 'validé')
                        <form action="{{ route('loanrequests.validate', $loan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Valider cette demande ?')">Valider</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Aucune demande enregistrée.</p>
@endif
@endsection
