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

Route::get('/threads', 'ThreadController@index');
Route::get('/replies/{id}', 'ReplyController@show');


Route::get('/login/{provider}', 'SocialAuthController@redirect');
Route::get('/login/{provider}/callback', 'SocialAuthController@callback');

Route::middleware(['auth'])->group(function () {

    //Routes of Threads
    Route::post('/threads', 'ThreadController@store');
    Route::get('/threads/pin/{thread}', 'ThreadController@pin');
    Route::get('/threads/close/{thread}', 'ThreadController@close');
    Route::put('/threads/{thread}', 'ThreadController@update');
    Route::get('/threads/{thread}/edit', function (\App\Thread $thread) {
            return view('thread.edit', compact('thread'));
    });

    //Routes of Replies
    Route::post('/replies', 'ReplyController@store');
    Route::get('/replies/highlite/{id}', 'ReplyController@highlite');

    //Routes of Profile
    Route::get('/profile', 'ProfileController@edit');
    Route::post('/profile', 'ProfileController@update');

});

Auth::routes();
