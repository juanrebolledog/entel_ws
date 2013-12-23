@extends('admin_layout')

@section('content')
<section>
    <header>
        <h3>
            {{ link_to(action('AdminBenefitsController@show', $benefit->id), $benefit->nombre) }} &raquo; {{ 'Notas' }}
        </h3>
    </header>
    <div class="row">
        <div class="large-12 medium-12 small-12 columns">
            <table class="entel-table">
                <thead>
                <tr>
                    <th>{{ 'Usuario' }}</th>
                    <th>{{ 'Nota' }}</th>
                    <th>{{ 'Fecha' }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($votes as $vote)
                <tr>
                    <td>{{ link_to(action('AdminUsersController@show', $vote->usuario_id), $vote->user->nombres)
                        }}
                    </td>
                    <td>{{ $vote->votacion }}</td>
                    <td>{{ $vote->created_at }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@stop