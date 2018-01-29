<?php

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
    return view('thread.index');
})->name('inicio');


Route::get('/threads/{id}', function ($id) {
    $result = \App\Thread::findOrFail($id);
    return view('thread.view', compact('result'));
});

Route::get('/locale/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return back();
});

Route::middleware(['auth'])->group(function () {
    Route::get('/threads', 'ThreadController@index');
    Route::post('/threads', 'ThreadController@store');
    Route::put('/threads/{thread}', 'ThreadController@update');
    Route::get('/threads/{thread}/edit', function (\App\Thread $thread) {
        if (\Auth::user()->can('update', $thread)):
            return view('thread.edit', compact('thread'));
        else:
            return redirect()->back();
        endif;
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
