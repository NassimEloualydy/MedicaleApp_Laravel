<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RdvController;
use App\Http\Controllers\VisiteController;
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

Route::get('/', function () {
    session(['id'=>""]);
    session(['nom'=>""]);
    session(['prenom'=>""]);    
    session(['login'=>""]);    
    session(['pw'=>""]);    
    session(['path'=>""]);    
    return view('login');
});
Route::post('/login',[AdminController::class,'login'])->name('login');
Route::post('/inscrire',[AdminController::class,'inscrire'])->name('inscrire');
Route::get('/index',function(){
    $data=["nom"=>session()->get('nom'),"prenom"=>session()->get('prenom'),"login"=>session()->get('login'),"pw"=>session()->get('pw'),"path"=>session()->get('path')];
    if(session()->get('id')==""){
        return view('404_page');
    }
    return view('index',$data);
});
Route::post('/MAJ_admin',[AdminController::class,'MAJ_admin'])->name('MAJ_admin');
Route::get('/charger_admin',[AdminController::class,'charger_admin'])->name('charger_admin');
Route::post('/Ajouter_patient',[PatientController::class,'Ajouter_patient'])->name('Ajouter_patient');
Route::get('/get_all_patient',[PatientController::class,'get_all_patient'])->name('get_all_patient');
Route::post('/delete_patient',[PatientController::class,'delete_patient'])->name('delete_patient');
Route::post('/charger_patient',[PatientController::class,'charger_patient'])->name('charger_patient');
Route::post('/MAJ_patient',[PatientController::class,'MAJ_patient'])->name('MAJ_patient');
Route::post('/chercher_patient',[PatientController::class,'chercher_patient'])->name('chercher_patient');
Route::post('/detail_patient',[PatientController::class,'detail_patient'])->name('detail_patient');
Route::controller(RdvController::class)->group(function(){
    Route::post('/insert_RDV','insert_RDV')->name('insert_RDV');
    Route::get('/get_all_rdv','get_all_rdv')->name('get_all_rdv');
    Route::post('/delete_rdv','delete_rdv')->name('delete_rdv');
    Route::post('/charger_rdv','charger_rdv')->name('charger_rdv');
    Route::post('/MAJ_RDV','MAJ_RDV')->name('MAJ_RDV');
    Route::post('/chercher_rdv','chercher_rdv')->name('chercher_rdv');
});
Route::controller(VisiteController::class)->group(function(){
 Route::post('/insert_visite','insert_visite')->name('insert_visite');
 Route::get('/get_all_visits','get_all_visits')->name('get_all_visits');
 Route::post('/delete_visite','delete_visite')->name('delete_visite');
 Route::post('/charger_visite','charger_visite')->name('charger_visite');
 Route::post('/update_visite','update_visite')->name('update_visite');
 Route::post('/detail_visite','detail_visite')->name('detail_visite');
 Route::post('/search_visite','search_visite')->name('c');
});
Route::controller(MedicamentController::class)->group(function(){
  Route::post('/insert_medicament','insert_medicament')->name('insert_medicament');
  Route::get('/get_all_medicament','get_all_medicament')->name('get_all_medicament');
  Route::post('/delete_medicament','delete_medicament')->name('delete_medicament');
  Route::post('/charger_medicament','charger_medicament')->name('update_medicament');
  Route::post('/update_medicament','update_medicament')->name('update_medicament');
  Route::post('/chercher_medicament','chercher_medicament')->name('chercher_medicament');
  Route::post('/detail_medicament','detail_medicament')->name('detail_medicament');
//   Route::get('/get_medicament_ordonnance','get_medicament_ordonnance')->name('get_medicament_ordonnance');
});
Route::controller(OrdonnanceController::class)->group(function(){
 Route::get('/get_medicament_ordonnance','get_medicament_ordonnance')->name('get_medicament_ordonnance');
  Route::post('/get_medicament','get_medicament')->name('get_medicament');
  Route::post('/add_ordonnance','add_ordonnance')->name('add_ordonnance');
  Route::get('/get_ordonnance','get_ordonnance')->name('get_ordonnance');
  Route::post('/delete_ordonnance','delete_ordonnance')->name('delete_ordonnance');
  Route::post('/charger_ordonnance','charger_ordonnance')->name('charger_ordonnance');
  Route::post('/update_ordonnance','update_ordonnance')->name('update_ordonnance');
});