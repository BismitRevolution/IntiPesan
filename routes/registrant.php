<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('registrant')->user();

    //dd($users);

    return view('registrant.home');
    // return redirect()->route('registrant.feedbacks.index');
})->name('home');
