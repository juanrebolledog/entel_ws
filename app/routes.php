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
        Route::post('comments/{id}/share', 'EventCommentsController@share');
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
});

Route::group(array('prefix' => 'api', 'before' => 'public'), function()
{
    Route::post('users', 'UsersController@store');
});

Route::group(array('prefix' => 'admin', 'before' => 'admin_auth'), function()
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
        Route::group(array('prefix' => 'categories'), function()
        {
            Route::get('edit', 'AdminEventCategoriesController@edit');
            Route::put('update', 'AdminEventCategoriesController@update');
            Route::get('sub/create', 'AdminEventCategoriesController@create_sub');
            Route::get('', 'AdminEventCategoriesController@index');
            Route::get('sub/{id}', 'AdminEventCategoriesController@show_sub');
            Route::get('sub/{id}/edit', 'AdminEventCategoriesController@edit_sub');
            Route::put('sub/{id}/update', 'AdminEventCategoriesController@update_sub');
            Route::post('sub/store', 'AdminEventCategoriesController@store_sub');
        });
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

    Route::group(array('prefix' => 'super_users'), function()
    {
        Route::get('profile', 'SuperAdminUsersController@profile');
        Route::get('create', 'SuperAdminUsersController@create');
        Route::post('store', 'SuperAdminUsersController@store');
        Route::get('', 'SuperAdminUsersController@index');
        Route::get('{id}', 'SuperAdminUsersController@show');
        Route::get('{id}/edit', 'SuperAdminUsersController@edit');
        Route::put('{id}/update', 'SuperAdminUsersController@update');
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

Route::group(array('before' => 'guest', 'prefix' => 'admin'), function()
{
    Route::get('login', 'SuperAdminUsersController@login_form');
    Route::post('login', 'SuperAdminUsersController@login');

    // GET for now. Must be changed to POST ASAP.
    Route::get('logout', 'SuperAdminUsersController@logout');
});

