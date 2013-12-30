<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
    <title>Zona Entel Admin Interface</title>
    <link rel="stylesheet" href="<?= asset('css/app.css'); ?>">
    <link rel="stylesheet" href="<?= asset('js/vendor/mapbox.js/theme/style.css'); ?>"/>
    <link href="<?= asset('css/vendor/font-awesome.css'); ?>" rel="stylesheet">
    <style>
        #app-content {
            width: 30%;
            margin: 0 auto;
            float: none;
        }
        #login-form {
            border: 1px solid #333333;
        }
        #login-form-header {
            margin: 0;
            padding: 20px;
            padding-bottom: 5px;
            padding-top: 10px;
            background-color: #333333;
            color: #FFFFFF;
        }
        #login-form-header h3 {
            color: #FFFFFF;
            margin: 0;
        }
        #login-form-content {
            padding: 20px;
            margin: 0;
        }
        #login-form-content .button {
            margin-bottom: 0;
        }
        @media (max-width: 800px) {
            #app-content {
                width: 80%;
            }
        }
        @media (max-width: 600px) {
            #app-content {
                width: 100%;
            }
        }
    </style>
</head>

<body>
<nav class="top-bar">

    <ul class="title-area">
        <li class="name">
            <h1>
                {{ link_to(action('SuperAdminUsersController@login_form'), 'Zona Entel') }}
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

<section id="content">
    <div class="large-12 medium-12 small-12 columns" id="app-content">
        @yield('content')
    </div>

</section>

<footer class="item">
    <div class="entel-item-content">
        <div class="text-center">
            <a href="#">Entel</a> | <a href="#">Soporte</a>
        </div>
    </div>
</footer>

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