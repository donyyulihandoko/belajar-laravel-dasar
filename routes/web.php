<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Middleware\VerifyCsrfToken;
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
Route::post('/file/upload', [FileController::class, 'uploadFile'])->name('upload.file')->withoutMiddleware(VerifyCsrfToken::class);

// route response
Route::get('/response/hello', [ResponseController::class, 'response']);

// routing response header
Route::get('/response/header', [ResponseController::class, 'header']);

Route::prefix('/response/type')->group(function () {
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/donwload', [ResponseController::class, 'responseDonwload']);
});



Route::controller(CookieController::class)->group(function () {
    Route::get('/cookie/set',  'createCookie');
    Route::get('/cookie/get',  'getCookie');
    Route::get('/cookie/clear',  'clearCookie');
});


Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);
Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);
Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [RedirectController::class, 'redirectHello'])->name('redirect.hello');
Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);
Route::get('/redirect/away', [RedirectController::class, 'redirectAway']);

Route::middleware(['contoh:PZN,401'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return 'OK';
    });

    Route::get('/group', function () {
        return 'GROUP';
    });
});


Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'postForm']);
