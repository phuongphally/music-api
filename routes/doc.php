<?php

// ========= Route Api for mobile ==================
Route::group(['prefix' => 'v1', 'middleware' => 'doc'], function(){

    Route::get("/",function(){
        return '';
    });
});