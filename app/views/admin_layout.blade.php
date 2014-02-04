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
            <li>
	            {{ link_to(action('AdminHomeController@index'), 'Home') }}
            </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminBenefitsController@index'), 'Beneficios') }}
	        </li>
            <li class="divider"></li>
            <li>
	            {{ link_to(action('AdminBenefitCategoriesController@index'), 'Categorías de Beneficios') }}
            </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminBenefitSubCategoriesController@index'), 'Sub Categorías de Beneficios') }}
	        </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminBenefitCommentsController@index'), 'Comentarios') }}
	        </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminBenefitVotesController@index'), 'Notas') }}
	        </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminEventsController@index'), 'Eventos') }}
	        </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminEventCategoriesController@index'), 'Categorías Eventos') }}
	        </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminZonesController@index'), 'Puntos Zona') }}
	        </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminZoneCategoriesController@index'), 'Categorías Puntos Zona') }}
	        </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminSummersController@index'), 'Veranos') }}
	        </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminSummerCategoriesController@index'), 'Categorías Veranos') }}
	        </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminContestsController@index'), 'Concursos') }}
	        </li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminSocialGalleriesController@index'), 'Galerías Sociales') }}
	        </li>
            <li class="divider"></li>
            <li class="divider"></li>
            <li><a href="configuration.html">Configuraci&oacute;n</a></li>
	        <li class="divider"></li>
	        <li>
		        {{ link_to(action('AdminUsersController@index'), 'Usuarios WS') }}
	        </li>
            <li class="divider"></li>
            <li>
	            {{ link_to(action('SuperAdminUsersController@index'), 'Usuarios Admin') }}
            </li>
        </ul>

        <ul class="right">
            <li class="divider"></li>
            <li>
                {{ link_to(action('SuperAdminUsersController@show', Auth::getUser()->id), Auth::getUser()->email) }}
            </li>
            <li class="divider"></li>
            <li>
                <!--{{ link_to(action('SuperAdminUsersController@logout'), 'Salir', array('class' => 'logout-button')) }}-->
	            <form class="logout-form" action="{{ action('SuperAdminUsersController@logout') }}" method="post">
		            {{ Form::submit('Logout') }}
	            </form>
            </li>
            <li class="divider"></li>
        </ul>

    </section>

</nav>

<section id="content">
    <div class="large-2 hide-for-medium hide-for-small columns" id="app-sidebar">
        <ul class="entel-side-nav">
            <li class="<?= $data['current'] == 'home' ? 'active':''; ?>">
	            <?php echo HTML::decode(HTML::link(action('AdminHomeController@index'), 'Home&nbsp;<span class="fa fa-home"></span>', array('escape' => false))); ?>
            </li>
            <li class="<?= $data['current'] == 'benefits' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link(action('AdminBenefitsController@index'), 'Beneficios&nbsp;<span class="fa fa-gift"></span>', array('escape' => false))); ?>
            </li>
            <li class="<?= $data['current'] == 'benefit_categories' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link(action('AdminBenefitCategoriesController@index'), 'Categorías Beneficios&nbsp;<span class="fa fa-tag"></span>', array('escape' => false))); ?>
            </li>
            <li class="<?= $data['current'] == 'benefit_sub_categories' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link(action('AdminBenefitSubCategoriesController@index'), 'Sub Categorías Beneficios&nbsp;<span class="fa fa-tag"></span>', array('escape' => false))); ?>
            </li>
            <li class="<?= $data['current'] == 'comments' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link(action('AdminBenefitCommentsController@index'), 'Comentarios Beneficios&nbsp;<span class="fa fa-comments"></span>', array('escape' => false))); ?>
            </li>
	        <li class="<?= $data['current'] == 'ratings' ? 'active':''; ?>">
		        <?php echo HTML::decode(HTML::link(action('AdminBenefitVotesController@index'), 'Notas&nbsp;<span class="fa fa-star"></span>', array('escape' => false))); ?>
	        </li>
            <li class="<?= $data['current'] == 'events' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link(action('AdminEventsController@index'), 'Eventos&nbsp;<span class="fa fa-calendar"></span>', array('escape' => false))); ?>
            </li>
            <li class="<?= $data['current'] == 'event_categories' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link(action('AdminEventCategoriesController@index'), 'Categorías Eventos&nbsp;<span class="fa fa-tag"></span>', array('escape' => false))); ?>
            </li>
            <li class="<?= $data['current'] == 'zones' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link(action('AdminZonesController@index'), 'Puntos Zona&nbsp;<span class="fa fa-location-arrow"></span>', array('escape' => false))); ?>
            </li>
	        <li class="<?= $data['current'] == 'zone_categories' ? 'active':''; ?>">
		        <?php echo HTML::decode(HTML::link(action('AdminZoneCategoriesController@index'), 'Categorías Puntos Zona&nbsp;<span class="fa fa-tag"></span>', array('escape' => false))); ?>
	        </li>
	        <li class="<?= $data['current'] == 'summers' ? 'active':''; ?>">
		        <?php echo HTML::decode(HTML::link(action('AdminSummersController@index'), 'Veranos&nbsp;<span class="fa fa-sun-o"></span>', array('escape' => false))); ?>
	        </li>
	        <li class="<?= $data['current'] == 'summer_categories' ? 'active':''; ?>">
		        <?php echo HTML::decode(HTML::link(action('AdminSummerCategoriesController@index'), 'Categorías Veranos&nbsp;<span class="fa fa-tag"></span>', array('escape' => false))); ?>
	        </li>
	        <li class="<?= $data['current'] == 'contests' ? 'active':''; ?>">
		        <?php echo HTML::decode(HTML::link(action('AdminContestsController@index'), 'Concursos&nbsp;<span class="fa fa-trophy"></span>', array('escape' => false))); ?>
	        </li>
	        <li class="<?= $data['current'] == 'galleries' ? 'active':''; ?>">
		        <?php echo HTML::decode(HTML::link(action('AdminSocialGalleriesController@index'), 'Galerías Sociales&nbsp;<span class="fa fa-camera-retro"></span>', array('escape' => false))); ?>
	        </li>

            <li class="divider"></li>
            <li class="<?= $data['current'] == 'stats' ? 'active':''; ?>">
                <a href="#/stats">Estad&iacute;sticas&nbsp;<span class="fa fa-bar-chart-o"></span></a>
            </li>
            <li class="<?= $data['current'] == 'users' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link(action('AdminUsersController@index'), 'Usuarios WS&nbsp;<span class="fa fa-users"></span>', array('escape' => false))); ?>
            </li>
            <li class="<?= $data['current'] == 'super_users' ? 'active':''; ?>">
                <?php echo HTML::decode(HTML::link(action('SuperAdminUsersController@index'), 'Usuarios Admin&nbsp;<span class="fa fa-users"></span>', array('escape' => false))); ?>
            </li>
        </ul>
        <section class="entel-item">
            <header><span class="fa fa-question-circle right"></span>&nbsp;¿Necesitas Ayuda?</header>
            <div class="entel-item-content">
                <ul>
                    <li>
                        <a href="#">Soporte</a>
                    </li>
                </ul>
            </div>
        </section>
    </div>

    <div class="large-10 medium-12 small-12 columns" id="app-content">
	    @if (Session::has('flash_error') || Session::has('flash_message'))
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
	    @endif
        @yield('content')
    </div>

</section>

<!--
<footer class="item">
    <div class="entel-item-content">
        <div class="text-center">
            <a href="#">Entel</a> | <a href="#">Soporte</a>
        </div>
    </div>
</footer>
-->

<script src="<?= asset('js/vendor/jquery.js'); ?>"></script>
<script src="<?= asset('js/vendor/underscore.js'); ?>"></script>
<script src="<?= asset('js/vendor/foundation/foundation.js'); ?>"></script>
<script src="<?= asset('js/vendor/foundation/foundation.topbar.js'); ?>"></script>
<!-- Other JS plugins can be included here -->

<script>
    $(document).foundation();
    var logging_out = false;
	$('.logout-form').on('submit', function(e) {
		if (!logging_out) {
			e.preventDefault();
			var $e = $(e.currentTarget);
			if (confirm('¿Estás seguro que quieres salir?')) {
				logging_out = true;
				$e.submit();
			}
		}
	});
</script>
@yield('scripts')

</body>
</html>