<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WelcomeController;

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


Route::get('/', WelcomeController::class);

Route::get('/login' , function()
{
return view('auth.login');
})->name('showlogin');

Route::post('/login' , [AuthController::class , 'login'])->name('login');


// Route::get('/register' , function()
// {
// return view('register');
// })->name('register');

Route::resource('/contacts' , ContactController::class);
Route::delete('/contacts/{contact}/restore', [ContactController::class, 'restore'])->withTrashed()->name('contacts.restore');
Route::delete('/contacts/{contact}/force-delete', [ContactController::class, 'forceDelete'])->withTrashed()->name('contacts.force-delete');

// Route::controller(ContactController::class)->group(function(){


    
//     Route::get('/contacts',   'index')->name('contacts.index');
//     Route::get('/contacts/create',  'create')->name('contacts.create');
//     Route::get('/contacts/{id}',  'show' )->name('contacts.show');
//     Route::post('/contacts'   , 'store')->name('contacts.store');
//     Route::get('/contacts/{id}/edit' , 'edit')->name('contacts.edit');
//     Route::put('/contacts/{id}' , 'update')->name('contacts.update');
//     Route::delete('/contacts/{id}', 'destroy')->name('contacts.destroy');
// });





Route::fallback(function() {

return "  <h1>404! Page Not Found</h1>   ";


});










