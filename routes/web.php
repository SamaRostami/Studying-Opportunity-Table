<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('import', function () {
//   \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\TeacherImport(),  __DIR__ . '/../public/teachers-temp.xlsx');
//    return redirect('/')->with('success', 'All good!');
//});
