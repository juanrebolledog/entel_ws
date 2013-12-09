<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
    <title>Zona Entel Admin Interface</title>
    <link rel="stylesheet" href="<?= asset('css/app.css'); ?>">
    <link rel="stylesheet" href="<?= asset('js/vendor/mapbox.js/theme/style.css'); ?>"/>
    <link href="<?= asset('css/vendor/font-awesome.css'); ?>" rel="stylesheet">
</head>

<body>
<nav class="top-bar">

    <ul class="title-area">
        <li class="name">
            <h1><a href="#">Zona Entel</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">

        <ul class="right hide-for-large">
            <li class="divider"></li>
            <li><a href="index.html">Home</a></li>
            <li class="divider"></li>
            <li>
                <?= link_to('admin/benefits', 'Beneficios'); ?>
            </li>
            <li class="divider"></li>
            <li><a href="benefit_comments.html">Comentarios</a></li>
            <li class="divider"></li>
            <li>
                <?= link_to('admin/events', 'Eventos'); ?>
            </li>
            <li class="divider"></li>
            <li><a href="zones.html">Zonas</a></li>
            <li class="divider"></li>
            <li><a href="categories.html">Categor&iacute;as</a></li>
            <li class="divider"></li>
            <li><a href="benefit_ratings.html">Notas</a></li>
            <li class="divider"></li>
            <li class="divider"></li>
            <li><a href="configuration.html">Configuraci&oacute;n</a></li>
            <li class="divider"></li>
            <li><a href="users.html">Usuarios</a></li>
        </ul>

        <ul class="right">
            <li class="divider"></li>
            <li><a href="#">Perfil (admin)</a></li>
            <li class="divider"></li>
            <li><a href="#">Salir</a></li>
            <li class="divider"></li>
        </ul>

    </section>

</nav>

<section id="content">
    <div class="large-2 hide-for-medium hide-for-small columns" id="app-sidebar">
        <ul class="entel-side-nav">
            <li class="<?= $data['current'] == 'home' ? 'active':''; ?>">
                <a href="#/home">Home&nbsp;<span class="fa fa-home"></span></a>
            </li>
            <li class="<?= $data['current'] == 'benefits' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link('admin/benefits', 'Beneficios&nbsp;<span class="fa fa-gift"></span>', array('escape' => false))); ?>
            </li>
            <li class="<?= $data['current'] == 'comments' ? 'active':''; ?>">
                <a href="#/comments">Comentarios&nbsp;<span class="fa fa-comments"></span></a>
            </li>
            <li class="<?= $data['current'] == 'events' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link('admin/events', 'Eventos&nbsp;<span class="fa fa-calendar"></span>', array('escape' => false))); ?>
            </li>
            <li class="<?= $data['current'] == 'zones' ? 'active':''; ?>">
                <a href="#/zones">Zonas&nbsp;<span class="fa fa-location-arrow"></span></a>
            </li>
            <li class="<?= $data['current'] == 'categories' ? 'active':''; ?>">
                <a href="#/categories">Categor&iacute;as&nbsp;<span class="fa fa-tag"></span></a>
            </li>
            <li class="<?= $data['current'] == 'ratings' ? 'active':''; ?>">
                <a href="#/ratings">Notas&nbsp;<span class="fa fa-star"></span></a>
            </li>
            <li class="divider"></li>
            <li class="<?= $data['current'] == 'configuration' ? 'active':''; ?>">
                <a href="#/configuration">Configuraci&oacute;n&nbsp;<span class="fa fa-cogs"></span></a>
            </li>
            <li class="<?= $data['current'] == 'stats' ? 'active':''; ?>">
                <a href="#/stats">Estad&iacute;sticas&nbsp;<span class="fa fa-bar-chart-o"></span></a>
            </li>
            <li class="<?= $data['current'] == 'status' ? 'active':''; ?>">
                <a href="#/status">Estado del Servicio&nbsp;<span class="fa fa-power-off"></span></a>
            </li>
            <li class="<?= $data['current'] == 'users' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link('admin/users', 'Usuarios&nbsp;<span class="fa fa-users"></span>', array('escape' => false))); ?>
            </li>
        </ul>
        <section class="entel-item">
            <header><span class="fa fa-question-circle"></span>&nbsp;¿Necesitas Ayuda?</header>
            <div class="entel-item-content">
                <ul>
                    <li>
                        <a href="#">Wiki del Sitio</a>
                    </li>
                    <li>
                        <a href="#">Soporte</a>
                    </li>
                </ul>
            </div>
        </section>
    </div>

    <div class="large-10 medium-12 small-12 columns" id="app-content">
        @yield('content')
    </div>
    <div class="large-12 medium-12 small-12 columns" style="padding: 0; margin: 0;">
        <footer class="item">
            <div class="entel-item-content">
                <div class="text-center">
                    <a href="#">Entel</a> | <a href="#">Wiki</a> | <a href="#">Soporte</a>
                </div>
            </div>
        </footer>
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