<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\AgentBNAController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AgriculteurController;


Route::permanentRedirect('/', '/login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Loan request routes
    Route::resource('loan-requests', LoanRequestController::class);
    Route::post('loan-requests/{id}/submit', [LoanRequestController::class, 'submit'])->name('loan-requests.submit');
    Route::post('loan-requests/{loanRequestId}/documents', [LoanRequestController::class, 'addDocument'])->name('loan-requests.add-document');

    // Complaint routes
    Route::resource('complaints', ComplaintController::class);

    // Agriculteur routes (tes ajouts)
    Route::get('/agriculteurs/demande', [AgriculteurController::class, 'create'])->name('agriculteurs.create');
    Route::post('/agriculteurs/demande', [AgriculteurController::class, 'store'])->name('agriculteurs.store');

    // Agent BNA routes
     Route::prefix('agent')->name('agent.')->middleware(['auth', 'agent.bna'])->group(function () {
        Route::get('/dashboard', [AgentBNAController::class, 'dashboard'])->name('dashboard');
        
        // Réclamations
        Route::get('/complaints', [AgentBNAController::class, 'viewAllComplaints'])->name('complaints');
        Route::get('/complaints/{id}', [AgentBNAController::class, 'showComplaint'])->name('complaints.show');
        Route::post('/complaints/{id}/respond', [AgentBNAController::class, 'respondToComplaint'])->name('complaints.respond');
        Route::post('/complaints/{id}/close', [AgentBNAController::class, 'closeComplaint'])->name('complaints.close');
        
        // Demandes de prêt
        Route::get('/loan-requests', [AgentBNAController::class, 'viewAllLoanRequests'])->name('loan-requests');
        Route::get('/loan-requests/{id}', [AgentBNAController::class, 'openLoanRequest'])->name('loan-requests.show');
        Route::post('/loan-requests/{id}/update-status', [AgentBNAController::class, 'changeLoanStatus'])->name('loan-requests.update-status');
        Route::post('/loan-requests/{id}/request-documents', [AgentBNAController::class, 'requestMissingDocuments'])->name('loan-requests.request-documents');
        Route::post('/loan-requests/{id}/add-note', [AgentBNAController::class, 'addNoteToFile'])->name('loan-requests.add-note');
        Route::get('/loan-requests/document/{document}/download', [LoanRequestController::class, 'downloadDocument'])
         ->name('loan-requests.download-document');
    }); 
    
});


// Routes agriculteur en attente
Route::middleware(['auth', 'agriculteur'])->group(function () {
    Route::get('/account/pending', function () {
        return view('auth.pending-approval');
    })->name('account.pending');
    
    Route::get('/account/rejected', function () {
        $reason = auth()->user()->agriculteur->rejection_reason;
        return view('auth.rejected', compact('reason'));
    })->name('account.rejected');
});

// Routes administrateur
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Gestion des agriculteurs
    Route::get('/agriculteurs/pending', [AdminController::class, 'pendingAgriculteurs'])->name('admin.agriculteurs.pending');
    Route::post('/agriculteurs/{id}/approve', [AdminController::class, 'approveAgriculteur'])->name('admin.agriculteurs.approve');
    Route::post('/agriculteurs/{id}/reject', [AdminController::class, 'rejectAgriculteur'])->name('admin.agriculteurs.reject');
    
    // Gestion des agents
    Route::get('/agents', [AdminController::class, 'agentsIndex'])->name('admin.agents.index');
    Route::get('/agents/create', [AdminController::class, 'createAgent'])->name('admin.agents.create');
    Route::post('/agents', [AdminController::class, 'storeAgent'])->name('admin.agents.store');
    Route::delete('/agents/{id}', [AdminController::class, 'destroyAgent'])->name('admin.agents.destroy');
    
    // Gestion des agences
    Route::get('/agences', [AdminController::class, 'agencesIndex'])->name('admin.agences.index');
    Route::get('/agences/create', [AdminController::class, 'createAgence'])->name('admin.agences.create');
    Route::post('/agences', [AdminController::class, 'storeAgence'])->name('admin.agences.store');
    Route::delete('/agences/{id}', [AdminController::class, 'destroyAgence'])->name('admin.agences.destroy');
});
    
