<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/projects/{projectId}/issues/open', [IssueController::class, 'projectOpenIssues']);
Route::get('/projects/{projectId}/report', [IssueController::class, 'projectReport']);
Route::get('/projects/{projectId}/open-urgent', [IssueController::class, 'projectOpenUrgent']);
Route::get('/issues/stats/closed-per-user', [IssueController::class, 'closedStatsPerUser']);
Route::apiResource('issues', IssueController::class);

Route::apiResource('projects', ProjectController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('labels', LabelController::class);
Route::apiResource('Users', UserController::class);