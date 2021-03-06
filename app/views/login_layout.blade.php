<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
    <title>Zona Entel Admin Interface</title>
    <link rel="stylesheet" href="<?= asset('css/app.css'); ?>">
    <link rel="stylesheet" href="<?= asset('css/login.css'); ?>">
    <link rel="stylesheet" href="<?= asset('js/vendor/mapbox.js/theme/style.css'); ?>"/>
    <link href="<?= asset('css/vendor/font-awesome.css'); ?>" rel="stylesheet">
</head>

<body>
<nav class="top-bar">

    <ul class="title-area">
        <li class="name">
            <h1>
                {{ link_to(action('SuperAdminUsersController@login_form'), 'Zona Entel Admin') }}
            </h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">

        <ul class="right hide-for-large">
            <li>
                {{ link_to(action('SuperAdminUsersController@login_form'), 'Login') }}
            </li>
        </ul>

        <ul class="right">
            <li class="divider"></li>
            <li>
                {{ link_to(action('SuperAdminUsersController@login_form'), 'Login') }}
            </li>
            <li class="divider"></li>
        </ul>

    </section>

</nav>

<section id="messages">
	@if (Session::has('flash_error'))
	<div class="columns large-12 flash-message">
		<div class="panel callout radius">
			{{ Session::get('flash_error') }}
		</div>
	</div>
	@endif

	@if (Session::has('flash_message'))
	<div class="columns large-12 flash-message">
		<div class="panel callout radius">
			{{ Session::get('flash_message') }}
		</div>
	</div>
	@endif
</section>

<section id="content">
    <div class="columns large-12" id="app-content">
        @yield('content')
    </div>
</section>

<script src="<?= asset('js/vendor/jquery.js'); ?>"></script>
<script src="<?= asset('js/vendor/foundation/foundation.js'); ?>"></script>
<script src="<?= asset('js/vendor/foundation/foundation.topbar.js'); ?>"></script>
<!-- Other JS plugins can be included here -->

<script>
    $(document).foundation();
</script>
@yield('scripts')

</body>
</html>