<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    //
});


App::after(function($request, $response)
{
    //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
    $access_key = Request::header('ENTEL-ACCESS-KEY');
    $api_key = Request::header('ENTEL-API-KEY');

    if ($access_key)
    {
        $access_keys = Config::get('app.access_keys');
        if (!in_array($access_key, array_values($access_keys)))
        {
            return Response::make(array('message' => 'You are not authorized to access this resource.'), 403);
        }
        if ($api_key)
        {
            $user = User::where('api_key', $api_key)->first();
            if ($user)
            {
                /*
                $password = hash('sha256', $api_key);
                if ($password !== $user->password || $api_key !== $user->api_key)
                {
                    return Response::make(array('message' => 'You are not authorized to access this resource.'), 403);
                }
                */
                Auth::login($user);
            }
        }
        else
        {
            return Response::make(array('message' => 'You are not authorized to access this resource.'), 403);
        }
    }
    else
    {
        return Response::make(array('message' => 'You are not authorized to access this resource.'), 403);
    }

});

Route::filter('public', function()
{
    $access_key = Request::header('ENTEL-ACCESS-KEY');
    $access_keys = Config::get('app.access_keys');
    if (!in_array($access_key, array_values($access_keys)))
    {
        return Response::make(array('message' => 'You are not authorized to access this resource.'), 403);
    }
});

Route::filter('admin_auth', function()
{
    if (Auth::guest())
        return Redirect::route('login')
            ->with('flash_error', 'You must be logged in to view this page!');
});


Route::filter('auth.basic', function()
{
    return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
    if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});