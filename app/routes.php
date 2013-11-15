<?php

Route::post('api/benefits/{id}/vote', 'BenefitsController@vote');
Route::post('api/benefits/{id}/ignore', 'BenefitsController@ignore');
Route::resource('api/benefits', 'BenefitsController');

Route::resource('api/events', 'EventsController');
