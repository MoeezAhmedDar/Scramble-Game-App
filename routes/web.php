<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('members', MemberController::class);

// Route::get('/members-edit/{member}', [MemberController::class, 'edit'])->name('members.edit');
// Route::put('/members-update/{member}', [MemberController::class, 'update'])->name('members.update');
