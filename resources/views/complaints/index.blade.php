@extends('layouts.app')

@section('title', 'Mes réclamations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Mes réclamations</h1>
    <a href="{{ route('complaints.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nouvelle réclamation
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($complaints->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sujet</th>
                            <th>Message</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($complaints as $complaint)
                            <tr>
                                <td>{{ $complaint->subject }}</td>
                                <td>{{ Str::limit($complaint->message, 50) }}</td>
                                <td>
                                    <span class="badge bg-{{ $complaint->status == 'resolved' ? 'success' : 'warning' }}">
                                        {{ $complaint->status }}
                                    </span>
                                </td>
                                <td>{{ $complaint->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('complaints.show', $complaint->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Aucune réclamation pour le moment.</p>
        @endif
    </div>
</div>
@endsection