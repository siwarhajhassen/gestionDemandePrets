<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgriculteurController;
use App\Http\Controllers\AgentBNAController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ActionLogController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('agriculteurs', AgriculteurController::class);
    Route::apiResource('agents', AgentBNAController::class);
    Route::apiResource('loan-requests', LoanRequestController::class);
    Route::apiResource('documents', DocumentController::class);
    Route::apiResource('complaints', ComplaintController::class);
    Route::apiResource('notes', NoteController::class);
    Route::apiResource('actionlogs', ActionLogController::class);
});
