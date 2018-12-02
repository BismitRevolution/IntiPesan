<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('registrant')->user();

    //dd($users);

    return view('registrant.home');
})->name('home');

