@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            <?= link_to(action('AdminZonesController@index'), 'Zonas'); ?> &raquo; <?= $zone->nombre; ?>
        </h3>
        <ul>
            <li>
                <?= link_to(action('AdminZonesController@edit', $zone->id), 'Editar'); ?>
            </li>
            <li>
                <a href="#">Desactivar</a>
            </li>
            <li>
                <?= link_to(action('AdminZonesController@create'), 'Crear Nueva'); ?>
            </li>
        </ul>
    </header>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <section class="entel-item">
                <header>{{ 'Información' }}</header>
                <div class="entel-item-content">
                    <dl>
                        <dt>{{ 'Nombre' }}</dt>
                        <dd>
                            {{ $zone->nombre }}
                        </dd>
                        <dt>{{ 'URL' }}</dt>
                        <dd>
                            {{ $zone->url }}
                        </dd>
                        <dt>{{ 'Imágen' }}</dt>
                        <dd>
                            <img src="{{ asset($zone->imagen) }}" alt="{{ $zone->imagen }}"/>
                            <br/>
                            <small>
                                {{ $zone->imagen }}
                            </small>
                        </dd>
                    </dl>
                </div>
            </section>
        </div>
    </div>

</section>
@stop