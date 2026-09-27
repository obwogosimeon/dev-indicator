<?php

use Illuminate\Http\Request;


Route::get('v1/dev/rusers', 'API\APIController@registeruser');
Route::put('v1/update/{id}', 'API\APIController@updateruser');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
