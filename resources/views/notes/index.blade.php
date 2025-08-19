@extends('layouts.app')

@section('title', 'Notes internes')

@section('content')
    <h2>Notes internes</h2>
    <a href="{{ route('notes.create') }}" class="btn btn-success mb-3">Nouvelle note</a>

    @if($notes->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Agent</th>
                    <th>Contenu</th>
                    <th>Visibilité</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notes as $note)
                    <tr>
                        <td>{{ $note->author->fullName ?? '-' }}</td>
                        <td>{{ Str::limit($note->content, 50) }}</td>
                        <td>{{ $note->visibility }}</td>
                        <td>{{ $note->created_at }}</td>
                        <td>
                            <a href="{{ route('notes.show', $note->id) }}" class="btn btn-sm btn-outline-success">Voir</a>
                            <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucune note disponible.</p>
    @endif
@endsection
