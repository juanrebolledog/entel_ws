<?php

Route::group(array('before' => 'public'), function()
{
    Route::post('api/benefits/{id}/vote', 'BenefitsController@vote');
    Route::post('api/benefits/{id}/ignore', 'BenefitsController@ignore');
    Route::get('api/benefits/search', 'BenefitsController@search');
    Route::get('api/benefits/ranking', 'BenefitsController@ranking');
    Route::resource('api/benefits', 'BenefitsController');

    Route::get('api/benefits/{id}/comments', 'BenefitCommentsController@show');
    Route::post('api/benefits/{id}/comments', 'BenefitCommentsController@store');

    Route::post('api/events/{id}/vote', 'EventsController@vote');
    Route::post('api/events/{id}/ignore', 'EventsController@ignore');
    Route::get('api/events/search', 'EventsController@search');
    Route::resource('api/events', 'EventsController');

    Route::get('api/events/{id}/comments', 'EventCommentsController@show');
    Route::post('api/events/{id}/comments', 'EventCommentsController@store');

    Route::resource('api/categories', 'CategoriesController');

    Route::get('api/users/profile', 'UsersController@profile');
    Route::post('api/users', 'UsersController@store');
    Route::resource('api/users', 'UsersController');
});

// API Test

Route::get('api/tests', 'TestsController@get');
Route::post('api/tests', 'TestsController@post');

Route::get('admin/benefits/create', 'AdminBenefitsController@create');
Route::get('admin/benefits', 'AdminBenefitsController@index');
Route::get('admin/benefits/{id}', 'AdminBenefitsController@show');
Route::get('admin/benefits/{id}/edit', 'AdminBenefitsController@edit');
Route::put('admin/benefits/{id}/update', 'AdminBenefitsController@update');
Route::post('admin/benefits/store', 'AdminBenefitsController@store');

Route::get('admin/events/create', 'AdminEventsController@create');
Route::get('admin/events', 'AdminEventsController@index');
Route::get('admin/events/{id}', 'AdminEventsController@show');
Route::get('admin/events/{id}/edit', 'AdminEventsController@edit');
Route::put('admin/events/{id}/update', 'AdminEventsController@update');
Route::post('admin/events/store', 'AdminEventsController@store');
