<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    $consignas=DB::table('consignas')
    ->join('residencia','consignas.id_residencia','residencia.id_residencia')
        
        ->orderby('id_consigna', 'desc')->paginate(5);
        $residentes=DB::table('residente')
        ->join('persona','residente.id_persona','persona.id_persona')
       ->paginate(5);
        $residencias=DB::table('residencia')->get();
        return view("Administracion.index",['consignas'=>$consignas,
        'residencias'=>$residencias,'residentes'=>$residentes]);


})->name('dashboard');
Route::get('/consigna', 'App\Http\Controllers\ConsignaController@index')->name('consigna.index');
Route::post('/consigna/store', 'App\Http\Controllers\ConsignaController@store')->name('consigna.store');
Route::post('/consigna/update', 'App\Http\Controllers\ConsignaController@update')->name('consigna.update');

Route::get('/residente', 'App\Http\Controllers\ResidentesController@index')->name('residente.index');
Route::post('/residente/store', 'App\Http\Controllers\ResidentesController@store')->name('residente.store');
Route::post('/residente/update', 'App\Http\Controllers\ResidentesController@update')->name('residente.update');
Route::post('/residente/upload', 'App\Http\Controllers\ResidentesController@upload')->name('residente.upload');
