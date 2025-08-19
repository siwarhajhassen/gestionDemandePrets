@extends('layouts.app')

@section('title', 'Documents')

@section('content')
    <h2>Documents</h2>
    <a href="{{ route('documents.create') }}" class="btn btn-success mb-3">Ajouter un document</a>

    @if($documents->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Taille</th>
                    <th>Prêt lié</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $doc)
                    <tr>
                        <td>{{ $doc->fileName }}</td>
                        <td>{{ $doc->fileType }}</td>
                        <td>{{ $doc->size }} Ko</td>
                        <td>{{ $doc->loanRequest->id ?? '-' }}</td>
                        <td>
                            <a href="{{ route('documents.show', $doc->id) }}" class="btn btn-sm btn-outline-success">Voir</a>
                            <a href="{{ route('documents.edit', $doc->id) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun document trouvé.</p>
    @endif
@endsection
