@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ 'Notas' }}
        </h3>
    </header>

    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <div class="element-search">
                <form action="#" method="post">
                    <input type="text" placeholder="{{ 'Búsqueda' }}"/>
                </form>
            </div>
            <table class="entel-table">
                <thead>
                <tr>
                    <th width="50">
                        <input type="checkbox">
                    </th>
                    <th width="200">{{ 'Usuario' }}</th>
                    <th width="400" class="hide-for-small">{{ 'Votación' }}</th>
                    <th width="100">{{ 'Beneficio' }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($votes as $vote)
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td>
                        {{ link_to(action('AdminUsersController@show', $vote->usuario_id), $vote->user->nombres); }}
                    </td>
                    <td class="hide-for-small">
                        {{ $vote->votacion }}
                    </td>
                    <td>
                        {{ link_to(action('AdminBenefitsController@show', $vote->beneficio_id), $vote->benefit->nombre); }}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@stop