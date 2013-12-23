<?php

Route::group(array('prefix' => 'api', 'before' => 'auth'), function()
{
    Route::group(array('prefix' => 'benefits'), function()
    {
        Route::get('', 'BenefitsController@index');
        Route::get('categories', 'BenefitCategoriesController@index');
        Route::get('categories/{id}', 'BenefitCategoriesController@show');
        Route::post('comments/{id}/share', 'BenefitCommentsController@share');
        Route::get('ranking', 'BenefitsController@ranking');
        Route::get('search', 'BenefitsController@search');
        Route::get('sub_categories', 'BenefitSubCategoriesController@index');
        Route::get('sub_categories/{id}', 'BenefitSubCategoriesController@show');
        Route::get('{id}', 'BenefitsController@show');
        Route::get('{id}/category', 'BenefitsController@category');
        Route::get('{id}/comments', 'BenefitCommentsController@show');
        Route::post('{id}/comments', 'BenefitCommentsController@store');
        Route::post('{id}/ignore', 'BenefitsController@ignore');
        Route::post('{id}/redeem', 'BenefitsController@redeem');
        Route::get('{id}/sub_category', 'BenefitsController@sub_category');
        Route::post('{id}/vote', 'BenefitsController@vote');
    });
    
    Route::group(array('prefix' => 'events'), function()
    {
        Route::get('', 'EventsController@index');
        Route::get('search', 'EventsController@search');
        Route::get('category', 'EventsSubCategoriesController@index');
        Route::get('{id}', 'EventsController@show');
        Route::get('{id}/comments', 'EventCommentsController@show');
        Route::post('{id}/comments', 'EventCommentsController@store');
    });

    Route::group(array('prefix' => 'zones'), function()
    {
        Route::get('', 'ZonesController@index');
        Route::get('{id}', 'ZonesController@show');
    });

    Route::get('users/level', 'UsersController@level');
    Route::get('user_levels', 'UserLevelsController@index');
    Route::get('user_levels/{id}', 'UserLevelsController@show');
    Route::get('puntos_zona', 'ZoneElementsController@index');
    Route::get('tests', 'TestsController@get');
    Route::post('tests', 'TestsController@post');
});

Route::group(array('prefix' => 'api', 'before' => 'public'), function()
{
    Route::post('users', 'UsersController@store');
});

Route::group(array('prefix' => 'tests'), function()
{
    Route::get('RESTClient', 'TestsController@restClient');
});

Route::group(array('prefix' => 'admin'), function()
{
    Route::group(array('prefix' => 'benefits'), function()
    {
        Route::group(array('prefix' => 'categories'), function()
        {
            Route::group(array('prefix' => 'children'), function()
            {
                Route::get('', 'AdminBenefitSubCategoriesController@index');
                Route::get('create', 'AdminBenefitSubCategoriesController@create');
                Route::post('store', 'AdminBenefitSubCategoriesController@store');
                Route::get('{id}', 'AdminBenefitSubCategoriesController@show');
                Route::get('{id}/edit', 'AdminBenefitSubCategoriesController@edit');
                Route::put('{id}/update', 'AdminBenefitSubCategoriesController@update');
            });

            Route::get('', 'AdminBenefitCategoriesController@index');
            Route::get('create', 'AdminBenefitCategoriesController@create');
            Route::post('store', 'AdminBenefitCategoriesController@store');
            Route::get('{id}', 'AdminBenefitCategoriesController@show');
            Route::get('{id}/edit', 'AdminBenefitCategoriesController@edit');
            Route::put('{id}/update', 'AdminBenefitCategoriesController@update');
        });

        Route::get('create', 'AdminBenefitsController@create');
        Route::post('store', 'AdminBenefitsController@store');
        Route::get('votes', 'AdminBenefitVotesController@index');

        Route::get('comments', 'AdminBenefitCommentsController@index');
        Route::get('comments/{id}', 'AdminBenefitCommentsController@show');
        Route::get('', 'AdminBenefitsController@index');
        Route::get('{id}', 'AdminBenefitsController@show');
        Route::get('{id}/edit', 'AdminBenefitsController@edit');
        Route::get('{id}/votes', 'AdminBenefitVotesController@show');
        Route::put('{id}/update', 'AdminBenefitsController@update');
    });
    
    Route::group(array('prefix' => 'events'), function()
    {
        Route::get('create', 'AdminEventsController@create');
        Route::get('', 'AdminEventsController@index');
        Route::get('{id}', 'AdminEventsController@show');
        Route::get('{id}/edit', 'AdminEventsController@edit');
        Route::put('{id}/update', 'AdminEventsController@update');
        Route::post('store', 'AdminEventsController@store');
    });

    Route::group(array('prefix' => 'users'), function()
    {
        Route::get('', 'AdminUsersController@index');
        Route::get('{id}', 'AdminUsersController@show');
    });

    Route::group(array('prefix' => 'zones'), function()
    {
        Route::get('create', 'AdminZonesController@create');
        Route::get('', 'AdminZonesController@index');
        Route::get('{id}', 'AdminZonesController@show');
        Route::get('{id}/edit', 'AdminZonesController@edit');
        Route::put('{id}/update', 'AdminZonesController@update');
        //Route::delete('{id}/delete', 'AdminZonesController@delete');
        Route::post('store', 'AdminZonesController@store');
    });
});
