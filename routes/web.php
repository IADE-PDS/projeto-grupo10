<?php

use App\Livewire\Service\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::fallback(function () {
    return redirect()->route('dashboard');
});

Route::redirect('/', '/login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('service/{id}', Show::class)
    ->middleware(['auth'])
    ->name('service');

Route::get('myservices', function () {
    return view('myservices');
})
    ->middleware(['auth', 'only-worker'])
    ->name('myservices');

Route::get('chat/{service_id}', function (Request $request) {
        return view('chats', ['service_id' => $request->service_id]);
    })
    ->middleware(['auth', 'chat-auth'])
    ->name('chat');

require __DIR__.'/auth.php';
