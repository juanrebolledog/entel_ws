<?php

Route::post('api/users', array('before' => 'public', 'uses' => 'UsersController@store'));

Route::group(array('before' => 'auth'), function()
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

    Route::resource('api/categories', 'CategoriesController');

    Route::get('api/users/profile', 'UsersController@profile');
    Route::resource('api/users', 'UsersController');
});
