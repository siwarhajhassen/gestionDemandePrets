@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Formulaire de demande de prêt et réclamation</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('agriculteurs.submitRequest') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h4>Informations personnelles</h4>
        <div class="form-group">
            <label for="fullName">Nom complet</label>
            <input type="text" name="fullName" id="fullName" class="form-control" value="{{ old('fullName') }}" required>
        </div>

        <div class="form-group">
            <label for="nationalId">Identifiant national</label>
            <input type="text" name="nationalId" id="nationalId" class="form-control" value="{{ old('nationalId') }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>

        <h4>Informations sur la ferme</h4>
        <div class="form-group">
            <label for="farmAddress">Adresse de la ferme</label>
            <textarea name="farmAddress" id="farmAddress" class="form-control" required>{{ old('farmAddress') }}</textarea>
        </div>

        <div class="form-group">
            <label for="farmType">Type d’exploitation</label>
            <select name="farmType" id="farmType" class="form-control" required>
                <option value="">-- Sélectionner --</option>
                <option value="culture" {{ old('farmType') == 'culture' ? 'selected' : '' }}>Culture</option>
                <option value="elevage" {{ old('farmType') == 'elevage' ? 'selected' : '' }}>Élevage</option>
                <option value="mixte" {{ old('farmType') == 'mixte' ? 'selected' : '' }}>Mixte</option>
            </select>
        </div>

        <h4>Demande de prêt</h4>
        <div class="form-group">
            <label for="amountRequested">Montant demandé (en CFA)</label>
            <input type="number" name="amountRequested" id="amountRequested" class="form-control" value="{{ old('amountRequested') }}" required min="1">
        </div>

        <div class="form-group">
            <label for="purpose">Objet du prêt</label>
            <input type="text" name="purpose" id="purpose" class="form-control" value="{{ old('purpose') }}" placeholder="Ex: équipement, semences..." required>
        </div>

        <div class="form-group">
            <label for="documents">Documents à télécharger (ID, relevé bancaire...)</label>
            <input type="file" name="documents[]" id="documents" class="form-control" multiple required>
        </div>

        <h4>Réclamation (optionnel)</h4>
        <div class="form-group">
            <label for="complaintSubject">Objet de la réclamation</label>
            <input type="text" name="complaintSubject" id="complaintSubject" class="form-control" value="{{ old('complaintSubject') }}">
        </div>
        <div class="form-group">
            <label for="complaintMessage">Message</label>
            <textarea name="complaintMessage" id="complaintMessage" class="form-control">{{ old('complaintMessage') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Envoyer la demande</button>
    </form>
</div>
@endsection
