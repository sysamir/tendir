<?php
Route::group([
    'namespace' => 'Front',
], function ()
{
    Route::get('/', function(){
        return view('front.home');
    });

    // require 'auth.php'; //add it you need

});