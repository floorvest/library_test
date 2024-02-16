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

// pretest route
Route::get('pretest', function() {

    foreach(range(1, 100) as $i) {
        $d = $i;
        if ($i % 3 == 0 && $i % 5 == 0) {
            $d = "TigaLima";
        } else if ($i % 5 == 0) {
            $d = "Lima";
        } else if ($i % 3 == 0) {
            $d = "Tiga";
        }

        echo $d. '<br/>';
    }

});