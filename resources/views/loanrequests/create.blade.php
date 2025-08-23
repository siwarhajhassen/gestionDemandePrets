@extends('layouts.app')

@section('title', 'Nouvelle demande de prêt agricole')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="text-center">Nouvelle demande de prêt agricole</h3>
                <p class="text-center mb-0">Veuillez remplir tous les champs obligatoires et joindre les documents nécessaires</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('loan-requests.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Basic Information Section -->
                    <div class="border-bottom pb-3 mb-4">
                        <h4 class="text-success">
                            <i class="fas fa-info-circle"></i> Informations de base
                        </h4>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount_requested" class="form-label">Montant demandé (€) *</label>
                                    <input type="number" step="0.01" min="1000" class="form-control @error('amount_requested') is-invalid @enderror" 
                                           id="amount_requested" name="amount_requested" value="{{ old('amount_requested') }}" required
                                           placeholder="Ex: 15000.00">
                                    @error('amount_requested')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="loan_duration" class="form-label">Durée du prêt (mois) *</label>
                                    <select class="form-select @error('loan_duration') is-invalid @enderror" 
                                            id="loan_duration" name="loan_duration" required>
                                        <option value="">Sélectionner la durée</option>
                                        <option value="12">12 mois</option>
                                        <option value="24">24 mois</option>
                                        <option value="36">36 mois</option>
                                        <option value="48">48 mois</option>
                                        <option value="60">60 mois</option>
                                    </select>
                                    @error('loan_duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="purpose" class="form-label">Objectif du prêt *</label>
                            <textarea class="form-control @error('purpose') is-invalid @enderror" 
                                      id="purpose" name="purpose" rows="4" required
                                      placeholder="Décrivez en détail l'utilisation prévue du prêt (équipement, semences, bétail, irrigation, etc.)">{{ old('purpose') }}</textarea>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Project Details Section -->
                    <div class="border-bottom pb-3 mb-4">
                        <h4 class="text-success">
                            <i class="fas fa-seedling"></i> Détails du projet agricole
                        </h4>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="farm_type" class="form-label">Type d'agriculture *</label>
                                    <select class="form-select @error('farm_type') is-invalid @enderror" 
                                            id="farm_type" name="farm_type" required>
                                        <option value="">Sélectionner le type</option>
                                        <option value="cereals">Céréales</option>
                                        <option value="vegetables">Légumes</option>
                                        <option value="fruits">Fruits</option>
                                        <option value="livestock">Élevage</option>
                                        <option value="dairy">Laitier</option>
                                        <option value="poultry">Volaille</option>
                                        <option value="fishing">Pêche</option>
                                        <option value="other">Autre</option>
                                    </select>
                                    @error('farm_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="land_size" class="form-label">Superficie de la terre (hectares) *</label>
                                    <input type="number" step="0.01" class="form-control @error('land_size') is-invalid @enderror" 
                                           id="land_size" name="land_size" value="{{ old('land_size') }}" required
                                           placeholder="Ex: 5.5">
                                    @error('land_size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="project_description" class="form-label">Description détaillée du projet *</label>
                            <textarea class="form-control @error('project_description') is-invalid @enderror" 
                                      id="project_description" name="project_description" rows="3" required
                                      placeholder="Décrivez votre projet agricole en détail">{{ old('project_description') }}</textarea>
                            @error('project_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Documents Upload Section -->
                    <div class="border-bottom pb-3 mb-4">
                        <h4 class="text-success">
                            <i class="fas fa-file-upload"></i> Documents requis
                        </h4>
                        <p class="text-muted">Veuillez télécharger les documents suivants (PDF, JPG, PNG - Max 5MB chacun)</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="land_documents" class="form-label">Titre de propriété / Bail *</label>
                                    <input type="file" class="form-control @error('land_documents') is-invalid @enderror" 
                                           id="land_documents" name="land_documents" accept=".pdf,.jpg,.jpeg,.png" required>
                                    <small class="form-text text-muted">Documents prouvant la propriété ou location des terres</small>
                                    @error('land_documents')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="identity_documents" class="form-label">Carte d'identité *</label>
                                    <input type="file" class="form-control @error('identity_documents') is-invalid @enderror" 
                                           id="identity_documents" name="identity_documents" accept=".pdf,.jpg,.jpeg,.png" required>
                                    <small class="form-text text-muted">Copie recto-verso de la CIN</small>
                                    @error('identity_documents')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="financial_documents" class="form-label">Relevés bancaires *</label>
                                    <input type="file" class="form-control @error('financial_documents') is-invalid @enderror" 
                                           id="financial_documents" name="financial_documents" accept=".pdf,.jpg,.jpeg,.png" required>
                                    <small class="form-text text-muted">3 derniers mois de relevés bancaires</small>
                                    @error('financial_documents')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="farming_plan" class="form-label">Plan de culture/élevage *</label>
                                    <input type="file" class="form-control @error('farming_plan') is-invalid @enderror" 
                                           id="farming_plan" name="farming_plan" accept=".pdf,.jpg,.jpeg,.png" required>
                                    <small class="form-text text-muted">Plan détaillé de votre activité agricole</small>
                                    @error('farming_plan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="additional_documents" class="form-label">Documents supplémentaires (optionnel)</label>
                            <input type="file" class="form-control @error('additional_documents') is-invalid @enderror" 
                                   id="additional_documents" name="additional_documents[]" accept=".pdf,.jpg,.jpeg,.png" multiple>
                            <small class="form-text text-muted">Autres documents pertinents (photos de la terre, contrats, etc.)</small>
                            @error('additional_documents')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="mb-4">
                        <h4 class="text-success">
                            <i class="fas fa-calendar-alt"></i> Informations supplémentaires
                        </h4>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expected_start_date" class="form-label">Date de début prévue du projet *</label>
                                    <input type="date" class="form-control @error('expected_start_date') is-invalid @enderror" 
                                           id="expected_start_date" name="expected_start_date" value="{{ old('expected_start_date') }}" required
                                           min="{{ date('Y-m-d') }}">
                                    @error('expected_start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expected_completion_date" class="form-label">Date d'achèvement prévue *</label>
                                    <input type="date" class="form-control @error('expected_completion_date') is-invalid @enderror" 
                                           id="expected_completion_date" name="expected_completion_date" value="{{ old('expected_completion_date') }}" required>
                                    @error('expected_completion_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="additional_notes" class="form-label">Notes supplémentaires</label>
                            <textarea class="form-control @error('additional_notes') is-invalid @enderror" 
                                      id="additional_notes" name="additional_notes" rows="2"
                                      placeholder="Informations complémentaires que vous souhaitez ajouter">{{ old('additional_notes') }}</textarea>
                            @error('additional_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Important:</strong> Tous les champs marqués d'un * sont obligatoires. 
                        Votre demande sera traitée dans les 5-7 jours ouvrables après soumission complète de tous les documents.
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('loan-requests.index') }}" class="btn btn-secondary me-md-2">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-paper-plane"></i> Soumettre la demande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Set minimum completion date based on start date
    document.getElementById('expected_start_date').addEventListener('change', function() {
        const startDate = new Date(this.value);
        const minCompletionDate = new Date(startDate);
        minCompletionDate.setMonth(startDate.getMonth() + 1);
        
        document.getElementById('expected_completion_date').min = minCompletionDate.toISOString().split('T')[0];
    });

    // File size validation
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file && file.size > 5 * 1024 * 1024) { // 5MB
                alert('Le fichier ne doit pas dépasser 5MB');
                this.value = '';
            }
        });
    });
</script>
@endsection