<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FiltreController;

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

Route::get('/', function () {
    return view('contacts.home');
});

Route::get('/contacts', function () {
    return view('contacts.list');
})->name('contacts');

Route::get('/list',[ContactController::class,'fetchAllContacts'])->name('list-contacts');
Route::get('/ajout', [ContactController::class, "addContact"])->name('add-contact');
Route::post('/ajout', [ContactController::class, "addContact"])->name('send-contact');
Route::get('/edit/{id}', [ContactController::class, "editContact"])->name('get-edit-contact')->whereNumber('id');
Route::post('/edit/{id}', [ContactController::class, "editContact"])->name('edit-contact')->whereNumber('id');
Route::get('/detail/{id}', [ContactController::class, "detailContact"])->name('detail-contact')->whereNumber('id');
Route::get('/{membre}',[FiltreController::class,'filtreContact'])->name('filtre-contact');
Route::get('/supprimer/{id}',[ContactController::class,'deleteContact'])->name('delete-contact');

