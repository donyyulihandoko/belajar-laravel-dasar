<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;

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
    return view('welcome');
});

Route::get('/pzn', function () {
    return "Hello Programmer Zaman Now";
});

Route::redirect('/youtube', '/pzn');

Route::fallback(function () {
    return '404 by Programmer Zaman Now';
});

Route::view('/hello', 'hello', [
    'name' => 'Dony'
]);

Route::get('/hello-again', function () {
    return view('hello', [
        'name' => 'Dony'
    ]);
});

Route::get('/hello-world', function () {
    return view('Hello.world', [
        'name' => 'Dony'
    ]);
});

Route::get('/products/{id}', function ($id) {
    return "Product $id";
})->name('product.detail');

Route::get('/products/{id}/items/{name}', function ($productId, $itemName) {
    return "Product $productId, Item $itemName";
});

// regex route
Route::get('/categories/{id}', function ($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+');

// route parameter optional
Route::get('/users/{id?}', function ($userId = 404) {
    return "User $userId";
});

// route conflict

Route::get('/conflict/dony', function () {
    return "Conflict dony yuli handoko";
});

Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});

// Route::get('/')


// routing dengan controller
Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);

// routing dengan request
Route::get('/request/hello', [InputController::class, 'hello']);
Route::post('/request/hello', [InputController::class, 'hello']);
Route::post('/request/nested', [InputController::class, 'inputNested'])->name('input.nested');

Route::post('/input/hello/all', [InputController::class, 'allInput'])->name('input.all');

Route::post('/input/array', [InputController::class, 'inputArray'])->name('input.array');

// input type
Route::post('/input/hello/type', [InputController::class, 'inputType'])->name('input.type');
// input only dan except
Route::post('/input/hello/only', [InputController::class, 'inputOnly'])->name('input.only');
Route::post('/input/hello/except', [InputController::class, 'inputExcept'])->name('input.except');

// input merge
Route::post('/input/hello/merge', [InputController::class, 'inputMerge'])->name('input.merge');

// input file
Route::post('/file/upload', [FileController::class, 'uploadFile'])->name('upload.file');

// route response
Route::post('/response/hello', [ResponseController::class, 'response']);

// routing response header
Route::post('/response/header', [ResponseController::class, 'header']);
