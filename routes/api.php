<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        "message" => "API reached successfully.",
        "code" => 1,
        "status" => "success"
    ]);
});

Route::apiResource('employees', EmployeeController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
