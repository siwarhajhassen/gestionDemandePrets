<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\AgentBNAController;
use App\Http\Controllers\ComplaintController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// Simple test route without middleware
Route::get('/test', function () {
    return 'Test page - no auth required';
});
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
    
    // Agent BNA routes
    Route::middleware(['agent.bna'])->prefix('agent')->name('agent.')->group(function () {
        Route::get('/dashboard', [AgentBNAController::class, 'dashboard'])->name('dashboard');
        Route::get('/loan-requests', [AgentBNAController::class, 'viewAllLoanRequests'])->name('loan-requests.index');
        Route::get('/loan-requests/{id}', [AgentBNAController::class, 'openLoanRequest'])->name('loan-requests.show');
        Route::post('/loan-requests/{loanRequestId}/notes', [AgentBNAController::class, 'addNoteToFile'])->name('loan-requests.add-note');
        Route::post('/loan-requests/{loanRequestId}/change-status', [AgentBNAController::class, 'changeLoanStatus'])->name('loan-requests.change-status');
        Route::post('/loan-requests/{loanRequestId}/request-documents', [AgentBNAController::class, 'requestMissingDocuments'])->name('loan-requests.request-documents');
        
        Route::get('/complaints', [AgentBNAController::class, 'viewAllComplaints'])->name('complaints.index');
        Route::get('/complaints/{id}', function ($id) {
            $complaint = \App\Models\Complaint::with(['agriculteur.user', 'responses'])->findOrFail($id);
            return view('agent.complaints.show', compact('complaint'));
        })->name('complaints.show');
        Route::post('/complaints/{complaintId}/respond', [AgentBNAController::class, 'respondToComplaint'])->name('complaints.respond');
    });
});