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

Route::get('/hash', function() {
    return Hash::make('kito');
});

Route::get('/', array('as' => 'front', function()
{
    if (Auth::check()) {
        return Redirect::route('list');
    }

    return View::make('hello');
}));

Route::get('/login', array('as' => 'login', function()
{
    if (Auth::check()) {
        return Redirect::route('list');
    }

    return View::make('hello');
}));

Route::post('/login', array('as' => 'login.post', function()
{
    //if (Input::get('password') != 'kito') {
    //if (!Hash::check(Input::get('password'), '$2y$10$0enCID84Pax2bKeSBOC6XOlkweOgVSm.iiQaWrjchRlduPghtRFmK')) {
    if (Auth::attempt(array('name' => 'dad', 'password' => Input::get('password')))) {
        return Redirect::route('list');
    }

    return 'wrong';
}));

Route::get('/list/{letter?}', array('as' => 'list', 'before' => 'auth', function($letter = '')
{
    $letter = strtolower($letter);

    if (empty($letter) === true) {
        $letter = 'a';
    }

    preg_match('/^[a-z]{1}$/', $letter, $matches);

    if (empty($matches) === true) {
        return Redirect::route('list', 'a');
    }

    $names = DB::table('the_names')
        ->where('name', 'like', $letter.'%')
        ->orderBy('name')
        ->get();

    return View::make('list')
        ->with('letter', $letter)
        ->with('names', $names)
        ->with('highlight', Session::get('new-name', ''));
}));

Route::post('/add', array('as' => 'name.add', 'before' => 'auth', function()
{
    $newName = Input::get('new-name');

    DB::table('the_names')
        ->insert(
            array('id' => DB::raw('NULL'), 'name' => $newName, 'date_added' => DB::raw('NOW()'))
        );

    Session::flash('new-name', $newName);

    return Redirect::route('list');
}));
