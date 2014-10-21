<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'front', function()
{
    if (Auth::check()) {
        return Redirect::route('names');
    }

    return View::make('hello');
}));

Route::get('/login', array('as' => 'login', function()
{
    if (Auth::check()) {
        return Redirect::route('names');
    }

    return View::make('hello');
}));

Route::post('/login', array('as' => 'login.post', function()
{
    if (Auth::attempt(array('name' => 'dad', 'password' => Input::get('password')))) {
        return Redirect::route('names');
    }

    return Redirect::route('login')
        ->with('err', 'Your password seems to be wrong');
}));

Route::get('/logout', array('as' => 'login.logout', function() {
    Auth::logout();
    return Redirect::route('login');
}));

Route::group(array('before' => 'auth'), function() {
    Route::controller('names', 'NamesController', array(
        'getIndex'  => 'names',
        'getList'   => 'names.list',
        'postIndex' => 'names.add',
    ));
});
