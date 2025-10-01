@extends('layouts.app')

@section('title', 'Gestion des Agences')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-building"></i> Liste des Agences
                        </h5>
                        <a href="{{ route('admin.agences.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus"></i> Nouvelle Agence
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($agences->isEmpty())
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> Aucune agence n'a été créée pour le moment.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Code</th>
                                        <th>Ville</th>
                                        <th>Téléphone</th>
                                        <th>Adresse</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agences as $agence)
                                        <tr>
                                            <td>{{ $agence->id }}</td>
                                            <td>{{ $agence->name }}</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $agence->code }}</span>
                                            </td>
                                            <td>{{ $agence->city }}</td>
                                            <td>{{ $agence->phone }}</td>
                                            <td>{{ Str::limit($agence->address, 30) }}</td>
                                            <td>
                                                <div class="btn-group" role="group">

                                                    <form action="{{ route('admin.agences.destroy', $agence->id) }}"
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Supprimer"
                                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $agences->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Script pour la confirmation de suppression
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection
