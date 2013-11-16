<?php

Route::post('api/users', array('before' => 'public', 'uses' => 'UsersController@store'));

Route::group(array('before' => 'auth'), function()
{
    Route::post('api/benefits/{id}/vote', 'BenefitsController@vote');
    Route::post('api/benefits/{id}/ignore', 'BenefitsController@ignore');
    Route::get('api/benefits/search', 'BenefitsController@search');
    Route::resource('api/benefits', 'BenefitsController');

    Route::post('api/events/{id}/vote', 'EventsController@vote');
    Route::post('api/events/{id}/ignore', 'EventsController@ignore');
    Route::resource('api/events', 'EventsController');

    Route::resource('api/categories', 'CategoriesController');

    Route::get('api/users/profile', 'UsersController@profile');
    Route::resource('api/users', 'UsersController');
});
